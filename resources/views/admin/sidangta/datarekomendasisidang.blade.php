<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SISTA - Daftar Rekomendasi TA</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body class="d-flex flex-column min-vh-100">
    @include('layouts.navbar-admin')

    <!-- Main Content -->
    <div class="container mt-4">
        <div class="card">
            <div class="card-body">
                <h2 class="card-title mb-4">📋 Daftar Peserta Rekomendasi TA</h2>

                @if(session('success'))
                    <div class="alert alert-success">
                        <i class="bi bi-check-circle-fill"></i> {{ session('success') }}
                    </div>
                @endif

                <!-- Filter dan Search -->
                <div class="row mb-3">
                    <div class="col-md-3">
                        <select id="filterStatus" class="form-select">
                            <option value="all">Semua Status</option>
                            <option value="Sudah Direkomendasi">Sudah Direkomendasi</option>
                            <option value="Belum Direkomendasi">Belum Direkomendasi</option>
                        </select>
                    </div>

                    <!-- 🟢 Tambahkan filter tahun akademik -->
                    <div class="col-md-3">
                        <select id="filterTahun" class="form-select">
                            <option value="all">Semua Tahun Akademik</option>
                            <option value="2024/2025">2024/2025</option>
                            <option value="2025/2026">2025/2026</option>
                            <option value="2026/2027">2026/2027</option>
                            <option value="2028/2029">2028/2029</option>
                        </select>
                    </div>

                    <div class="col-md-3">
                        <input type="text" id="searchInput" class="form-control" placeholder="Cari Nama / NIM...">
                    </div>

                    <div class="col-md-3 text-end">
                        <button id="exportBtn" class="btn btn-success w-100">
                            <i class="bi bi-file-earmark-excel"></i> Export CSV
                        </button>
                    </div>
                </div>

                <!-- Tabel -->
                <table class="table table-bordered table-striped" id="mahasiswaTable">
                    <thead class="table-primary">
                        <tr>
                            <th>No</th>
                            <th>Nama Mahasiswa</th>
                            <th>NIM</th>
                            <th>Judul</th>
                            <th>Tahun Akademik</th>
                            <th>Status Rekomendasi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($mahasiswa as $m)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $m->username }}</td>
                                <td>{{ $m->nim }}</td>
                                <td>{{ $m->judul ?? '-' }}</td>
                                <td>{{ $m->tahun_akademik ?? '-' }}</td>
                                <td>{{ $m->status_rekomendasi }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">Belum ada mahasiswa</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
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
                const statusVal = filterStatus.value.toLowerCase();
                const tahunVal = filterTahun.value.toLowerCase();
                const searchVal = search.value.toLowerCase();

                rows.forEach(row => {
                    const nama = row.cells[1].textContent.toLowerCase();
                    const nim = row.cells[2].textContent.toLowerCase();
                    const tahun = row.cells[4].textContent.toLowerCase();
                    const status = row.cells[5].textContent.toLowerCase();

                    const matchStatus = (statusVal === 'all' || status === statusVal);
                    const matchTahun = (tahunVal === 'all' || tahun === tahunVal);
                    const matchSearch = (nama.includes(searchVal) || nim.includes(searchVal));

                    row.style.display = (matchStatus && matchTahun && matchSearch) ? '' : 'none';
                });
            }

            filterStatus.addEventListener('change', applyFilter);
            filterTahun.addEventListener('change', applyFilter);
            search.addEventListener('keyup', applyFilter);

            // Export CSV
            function exportTableToCSV(filename) {
                const rowsVisible = document.querySelectorAll('#mahasiswaTable tbody tr');
                let csv = [];

                const headers = Array.from(document.querySelectorAll('#mahasiswaTable thead th'))
                    .map(th => `"${th.textContent.trim()}"`);
                csv.push(headers.join(','));

                rowsVisible.forEach(row => {
                    if (row.style.display !== 'none') {
                        const cols = Array.from(row.cells)
                            .map(td => `"${td.textContent.trim()}"`);
                        csv.push(cols.join(','));
                    }
                });

                const csvString = csv.join('\n');
                const blob = new Blob([csvString], { type: 'text/csv;charset=utf-8;' });
                const link = document.createElement("a");
                link.href = URL.createObjectURL(blob);
                link.download = filename;
                link.click();
            }

            exportBtn.addEventListener('click', () => {
                exportTableToCSV("daftar_rekomendasi_ta.csv");
            });
        });
    </script>
</body>
</html>
