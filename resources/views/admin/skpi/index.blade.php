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
                <button id="exportCsvBtn" class="btn btn-success mb-3">Ekspor ke CSV</button>
                <table class="table table-striped table-bordered" id="daftar1" >
                <thead class="table-primary">
                    <tr>
                        <th>Nama Mahasiswa</th>
                        <th>Jumlah Nilai</th>
                        <th>Action</th>

                    </tr>
                </thead>
                <tbody>
                    @forelse($daftartabel as $item)
                        <tr>
                            <td>{{ $item->user->username ?? $item->user->name ?? '-' }}</td>
                             <td>
                                    {{
                                        $item->nilai_sertifikat1 +
                                        $item->nilai_sertifikat2 +
                                        $item->nilai_sertifikat3 +
                                        $item->nilai_sertifikat4 +
                                        $item->nilai_sertifikat5 +
                                        $item->nilai_sertifikat6 +
                                        $item->nilai_sertifikat7 +
                                        $item->nilai_sertifikat8 +
                                        $item->nilai_sertifikat9 +
                                        $item->nilai_sertifikat10
                                    }}
                             </td>
                            <td>
                                <a href="{{ route('admin.skpi.edit', $item) }}"
                                   class="btn btn-sm btn-warning">
                                   Lihat & Nilai
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted p-4">Belum ada SKPI</td>
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

    rows.forEach(row => {
        let cols = row.querySelectorAll('th, td');
        let rowData = [];
        cols.forEach(col => {
            // Escape quotes in values
            let text = col.innerText.replace(/"/g, '""');
            rowData.push(`"${text}"`);
        });
        csvContent += rowData.join(',') + '\n';
    });

    // Membuat file CSV dan memicu download
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

</body>
</html>
