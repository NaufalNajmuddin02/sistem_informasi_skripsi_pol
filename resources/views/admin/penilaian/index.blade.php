<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SISTA</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
</head>
<body class="d-flex flex-column min-vh-100">
    @include('layouts.navbar-admin')

    <div class="container mt-4">
        <div class="card shadow">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h2 class="card-title mb-0">Nilai Tugas Akhir</h2>
                   
                </div>


                <div class="d-flex justify-content-between align-items-center mb-3">
                    

                        <input type="text" id="searchInput" class="form-control me-2" placeholder="Cari nama mahasiswa...">
                        <button class="btn btn-success" onclick="exportToExcel('daftar1')">
                            <i class="bi bi-file-earmark-excel-fill"></i> Export ke Excel
                        </button>
                    
                </div>

                @if(session('success'))
                    <div class="alert alert-success">
                        <i class="bi bi-check-circle-fill"></i> {{ session('success') }}
                    </div>
                @endif

                <div class="table-responsive">
                    <table class="table table-bordered table-striped align-middle text-center" id="daftar1">
                        <thead class="table-primary">
                            <tr>
                                <th>Mahasiswa</th>
                                <th>Judul Skripsi</th>
                                <th>Nama Dosbing1</th>
                                <th>Dosbing 1</th>
                                <th>Nama Dosbing2</th>
                                <th>Dosbing 2</th>
                                <th>Nama Ketua Penguji</th>
                                <th>Ketua Penguji</th>
                                <th>Nama Penguji 1</th>
                                <th>Penguji 1</th>
                                <th>Nama Penguji 2</th>
                                <th>Penguji 2</th>
                                <th>Rata-rata</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($daftartabel as $item)

                            @php
                                $dosbing1 = $item->pembimbing->total_dosbing1/5 ?? 0;
                                $dosbing2 = $item->pembimbing->total_dosbing2/5 ?? 0;
                                $ketua    = $item->total_ketua/5 ?? 0;
                                $penguji1 = $item->total_penguji1/5 ?? 0;
                                $penguji2 = $item->total_penguji2/5 ?? 0;

                                $nilai_dosbing = ($dosbing1 + $dosbing2) / 2;
                                $nilai_penguji = ($ketua + $penguji1 + $penguji2) / 3;
                                $nilai_akhir = ($nilai_dosbing * 0.25) + ($nilai_penguji * 0.75);
                            @endphp

                            <tr>
                                <td>{{ $item->mahasiswa->username ?? '-' }}</td>
                                <td>{{ $item->seminar->script_title ?? '-' }}</td>
                                <td>{{ $item->pembimbing->dosbing1->username ?? '-' }}</td>
                                <td>{{ $item->pembimbing->total_dosbing1/5 ?? '-' }}</td>
                                <td>{{ $item->pembimbing->dosbing2->username ?? '-' }}</td>
                                <td>{{ $item->pembimbing->total_dosbing2/5 ?? '-' }}</td>
                                <td>{{ $item->ketuaPenguji->username ?? '-' }}</td>
                                <td>{{ $item->total_ketua/5 }}</td>
                                <td>{{ $item->penguji1->username ?? '-' }}</td>
                                <td>{{ $item->total_penguji1/5 }}</td>
                                <td>{{ $item->penguji2->username ?? '-' }}</td>
                                <td>{{ $item->total_penguji2/5 }}</td>
                                <td>{{ number_format($nilai_akhir, 2) }}</td>
                                <td>{{ $item->status }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>

    @include('layouts.footer')

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Export ke Excel -->
    <script>
function exportToExcel(tableID, filename = 'nilai_tugas_akhir.xlsx') {
    const table = document.getElementById(tableID);
    if (!table) {
        alert("Tabel tidak ditemukan!");
        return;
    }

    const year = new Date().getFullYear();
    const headers = Array.from(table.querySelectorAll("thead th")).map(th => th.innerText);
    const rows = Array.from(table.querySelectorAll("tbody tr")).map(tr =>
        Array.from(tr.querySelectorAll("td")).map(td => td.innerText)
    );

    const aoa = [
        ["DAFTAR NILAI TUGAS AKHIR TAHUN " + year],
        headers,
        ...rows
    ];

    const ws = XLSX.utils.aoa_to_sheet(aoa);
    ws["!merges"] = [{ s: { r: 0, c: 0 }, e: { r: 0, c: headers.length - 1 } }];
    const wb = XLSX.utils.book_new();
    XLSX.utils.book_append_sheet(wb, ws, "Sheet1");
    XLSX.writeFile(wb, filename);
}
</script>

    <!-- Pencarian Nama -->
    <script>
document.getElementById('searchInput').addEventListener('keyup', function () {
    let filter = this.value.toLowerCase();
    let rows = document.querySelectorAll('#daftar1 tbody tr');

    rows.forEach(row => {
        let namaCell = row.querySelector('td:first-child');
        if (namaCell) {
            let nama = namaCell.textContent.toLowerCase();
            row.style.display = nama.includes(filter) ? '' : 'none';
        }
    });
});
</script>

</body>
</html>
