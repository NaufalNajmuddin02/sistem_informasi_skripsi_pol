<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Berkas Tugas Akhir</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="d-flex flex-column min-vh-100">

@include('layouts.navbar-admin')

    <div class="container mt-4">
        <h2>Daftar SKPI</h2>
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between mb-3">
                    <input type="text" id="searchInput" class="form-control w-50" placeholder="Cari nama mahasiswa...">
                    <button id="exportCsvBtn" class="btn btn-success ms-2">Ekspor ke CSV</button>
                </div>
                <table class="table table-striped table-bordered" id="daftar1">
                    <thead class="table-primary">
                        <tr>
                            <th>Nama Mahasiswa</th>
                            <th>Narasi</th>
                            <th>Jumlah Nilai</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($daftartabel as $item)
                            <tr>
                                <td>{{ $item->user->username ?? $item->user->name ?? '-' }}</td>
                                <td>{{ $item->narasi ?? '-' }}</td>
                                <td>{{ $item->total_nilai }}</td>
                               <td class="d-flex gap-2">
    <!-- Tombol Edit -->
    <a href="{{ route('admin.skpi.edit', $item) }}"
       class="btn btn-sm btn-warning">
       Lihat & Nilai
    </a>

    <!-- Tombol Hapus -->
    <form action="{{ route('admin.skpi.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data ini?');">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
    </form>
</td>

                            </tr>
                        @empty
                            <tr>
                                
                                <td colspan="4" class="text-center text-muted p-4">Belum ada SKPI</td>
                                
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
document.getElementById('exportCsvBtn').addEventListener('click', function () {
    let table = document.getElementById('daftar1');
    let rows = table.querySelectorAll('tr');
    let csvContent = '';

    rows.forEach((row, rowIndex) => {
        let cols = row.querySelectorAll('th, td');
        let rowData = [];
        cols.forEach((col, colIndex) => {
            // Abaikan kolom Action (kolom terakhir)
            if (colIndex === cols.length - 1) return;

            // Escape quotes + trim spasi
            let text = col.innerText.replace(/"/g, '""').trim();
            rowData.push(`"${text}"`);
        });

        csvContent += rowData.join(',') + '\n';
    });

    // Buat blob file CSV
    let blob = new Blob([csvContent], { type: 'text/csv;charset=utf-8;' });
    let link = document.createElement('a');
    link.href = URL.createObjectURL(blob);
    link.download = 'daftar_skpi.csv';
    link.style.display = 'none';

    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
});
</script>

<script>
document.getElementById('searchInput').addEventListener('keyup', function() {
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
