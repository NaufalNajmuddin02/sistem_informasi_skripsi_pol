<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SISTA - Daftar Pendaftaran Sidang TA</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body class="d-flex flex-column min-vh-100">
    @include('layouts.navbar-admin')

    <div class="container mt-4 mb-5">
        <div class="card shadow-sm">
            <div class="card-body">
                <h2 class="card-title mb-4 text-bold fw-bold">📋 Daftar Pendaftaran Sidang TA</h2>

                <!-- Filter & Search -->
                <div class="row mb-3 g-2 align-items-center">
                    <div class="col-md-3">
                        <select id="filterStatus" class="form-select">
                            <option value="all">Semua Status</option>
                            <option value="sudah mendaftar">Sudah Mendaftar</option>
                            <option value="belum mendaftar">Belum Mendaftar</option>
                        </select>
                    </div>

                    <div class="col-md-3">
                        <select id="filterTahun" class="form-select">
                            <option value="all">Semua Tahun</option>
                            @foreach($tahunList as $tahun)
                                <option value="{{ strtolower($tahun) }}">{{ $tahun }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-4">
                        <input type="text" id="searchInput" class="form-control" placeholder="Cari Nama / NIM...">
                    </div>

                    <div class="col-md-2 text-end">
                        <button id="exportBtn" class="btn btn-success w-100">
                            <i class="bi bi-file-earmark-excel"></i> Export CSV
                        </button>
                    </div>
                </div>

                <!-- Tabel -->
                <div class="table-responsive">
                    <table class="table table-bordered table-striped align-middle" id="mahasiswaTable">
                        <thead class="table-primary text-center">
                            <tr>
                                <th>No</th>
                                <th>Nama Mahasiswa</th>
                                <th>NIM</th>
                                <th>Judul</th>
                                <th>Tahun Pendaftaran</th>
                                <th>Status Pendaftaran</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($mahasiswa as $m)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td>{{ $m->username }}</td>
                                    <td>{{ $m->nim }}</td>
                                    <td>{{ $m->judul ?? '-' }}</td>
                                    <td class="text-center">{{ $m->tahun_pendaftaran ?? '-' }}</td>
                                    <td class="text-center">
                                        @if($m->status_pendaftaran == 'Sudah Mendaftar')
                                            <span class="badge bg-success">{{ $m->status_pendaftaran }}</span>
                                        @else
                                            <span class="badge bg-danger">{{ $m->status_pendaftaran }}</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center text-muted">Belum ada mahasiswa terdaftar</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @include('layouts.footer')

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Filter + Search + Export CSV -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const filterStatus = document.getElementById('filterStatus');
            const filterTahun = document.getElementById('filterTahun');
            const search = document.getElementById('searchInput');
            const rows = document.querySelectorAll('#mahasiswaTable tbody tr');
            const exportBtn = document.getElementById('exportBtn');

            function applyFilter() {
                const statusVal = filterStatus.value.toLowerCase().trim();
                const tahunVal = filterTahun.value.toLowerCase().trim();
                const searchVal = search.value.toLowerCase().trim();

                rows.forEach(row => {
                    const nama = row.cells[1].textContent.toLowerCase().trim();
                    const nim = row.cells[2].textContent.toLowerCase().trim();
                    const tahun = row.cells[4].textContent.toLowerCase().trim();
                    const status = row.cells[5].textContent.toLowerCase().trim();

                    const matchStatus = (statusVal === 'all' || status.includes(statusVal));
                    const matchTahun = (tahunVal === 'all' || tahun.includes(tahunVal));
                    const matchSearch = (nama.includes(searchVal) || nim.includes(searchVal));

                    row.style.display = (matchStatus && matchTahun && matchSearch) ? '' : 'none';
                });
            }

            // Event listener
            filterStatus.addEventListener('change', applyFilter);
            filterTahun.addEventListener('change', applyFilter);
            search.addEventListener('keyup', applyFilter);

            // Export CSV
            function exportTableToCSV(filename) {
                const visibleRows = Array.from(document.querySelectorAll('#mahasiswaTable tbody tr'))
                    .filter(row => row.style.display !== 'none');

                let csv = [];

                // Header
                const headers = Array.from(document.querySelectorAll('#mahasiswaTable thead th'))
                    .map(th => `"${th.textContent.trim()}"`);
                csv.push(headers.join(','));

                // Data
                visibleRows.forEach(row => {
                    const cols = Array.from(row.cells)
                        .map(td => `"${td.textContent.trim()}"`);
                    csv.push(cols.join(','));
                });

                // Download file CSV
                const csvString = csv.join('\n');
                const blob = new Blob([csvString], { type: 'text/csv;charset=utf-8;' });
                const link = document.createElement("a");
                link.href = URL.createObjectURL(blob);
                link.download = filename;
                link.click();
            }

            exportBtn.addEventListener('click', () => {
                exportTableToCSV("pendaftaran_sidang_ta.csv");
            });
        });
    </script>
</body>
</html>
