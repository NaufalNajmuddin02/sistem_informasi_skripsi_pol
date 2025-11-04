<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SISTA - Data Kelulusan Sidang TA</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body class="d-flex flex-column min-vh-100">
    @include('layouts.navbar-admin')

    <div class="container mt-4">
        <div class="card shadow">
            <div class="card-body">
                <h2 class="card-title mb-4">🎓 Daftar Kelulusan Sidang TA</h2>

                <!-- Filter & Search & Export -->
                <div class="row mb-3">
                    <div class="col-md-3">
                        <select id="filterTahun" class="form-select">
                            <option value="all">Semua Tahun</option>
                            @foreach($tahunList as $t)
                                <option value="{{ $t }}" {{ ($tahunFilter == $t) ? 'selected' : '' }}>{{ $t }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <select id="filterStatus" class="form-select">
                            <option value="all">Semua Status</option>
                            <option value="Lulus">Lulus</option>
                            <option value="Belum Lulus">Belum Lulus</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <input type="text" id="searchInput" class="form-control" placeholder="Cari Nama / NIM...">
                    </div>
                    <div class="col-md-2 text-end">
                        <button id="exportCsv" class="btn btn-success w-100">
                            <i class="bi bi-file-earmark-spreadsheet"></i> Export CSV
                        </button>
                    </div>
                </div>

                <!-- Tabel -->
                <table class="table table-bordered table-striped align-middle" id="mahasiswaTable">
                    <thead class="table-success text-center">
                        <tr>
                            <th>No</th>
                            <th>Nama Mahasiswa</th>
                            <th>NIM</th>
                            <th>Tahun</th>
                            <th>Status Kelulusan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($mahasiswa as $m)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $m->username }}</td>
                                <td>{{ $m->nim }}</td>
                                <td>{{ $m->tahun ?? '-' }}</td>
                                <td>
                                    @if($m->status_kelulusan === 'Lulus')
                                        <span class="badge bg-success">Lulus</span>
                                    @else
                                        <span class="badge bg-danger">Belum Lulus</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">Belum ada data</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @include('layouts.footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const filterTahun = document.getElementById('filterTahun');
            const filterStatus = document.getElementById('filterStatus');
            const search = document.getElementById('searchInput');
            const rows = document.querySelectorAll('#mahasiswaTable tbody tr');
            const exportBtn = document.getElementById('exportCsv');

            // === Filter & Search ===
            function applyFilter() {
                const tahunVal = filterTahun.value;
                const statusVal = filterStatus.value.toLowerCase();
                const searchVal = search.value.toLowerCase();

                rows.forEach(row => {
                    const nama = row.cells[1].textContent.toLowerCase();
                    const nim = row.cells[2].textContent.toLowerCase();
                    const tahun = row.cells[3].textContent;
                    const status = row.cells[4].textContent.toLowerCase();

                    const matchTahun = (tahunVal === 'all' || tahun === tahunVal);
                    const matchStatus = (statusVal === 'all' || status.includes(statusVal));
                    const matchSearch = (nama.includes(searchVal) || nim.includes(searchVal));

                    row.style.display = (matchTahun && matchStatus && matchSearch) ? '' : 'none';
                });
            }

            filterTahun.addEventListener('change', applyFilter);
            filterStatus.addEventListener('change', applyFilter);
            search.addEventListener('keyup', applyFilter);

            // === Export ke CSV ===
            exportBtn.addEventListener('click', function () {
                let table = document.getElementById('mahasiswaTable');
                let rows = table.querySelectorAll('tr');
                let csv = [];

                rows.forEach(row => {
                    if (row.style.display === 'none') return; // skip baris yg disembunyikan
                    let cols = row.querySelectorAll('th, td');
                    let data = [];
                    cols.forEach(col => {
                        let text = col.innerText.replace(/,/g, ""); // hapus koma agar tidak rusak CSV
                        data.push('"' + text + '"');
                    });
                    csv.push(data.join(","));
                });

                let csvContent = csv.join("\n");
                let blob = new Blob([csvContent], { type: 'text/csv;charset=utf-8;' });
                let link = document.createElement("a");
                link.href = URL.createObjectURL(blob);
                link.download = "data_kelulusan_sidangTA.csv";
                link.click();
            });
        });
    </script>
</body>
</html>
