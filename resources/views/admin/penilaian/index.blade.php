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
    @include('layouts.navbar-kaprodi')
    <div class="container mt-4">
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h2 class="card-title mb-0">Nilai Tugas Akhir</h2>
                 <button class="btn btn-success" onclick="exportToExcel('daftar1')">
                    <i class="bi bi-file-earmark-excel-fill"></i> Export ke Excel
                </button>
                
            </div>
            @if(session('success'))
                <div class="alert alert-success">
                    <i class="bi bi-check-circle-fill"></i> {{ session('success') }}
                </div>
            @endif
            
            <table class="table table-striped table-bordered" id="daftar1" >
                <thead class="table-primary">
                    <tr>
                        <th>Nama Mahasiswa</th>
                        <th>Judul</th>
                        <th>Total Nilai</th>
                        <th>Status Sidang</th>
                        <th>Action</th>

                    </tr>
                </thead>
                <tbody>
                    @forelse($daftartabel as $item)
                        <tr>
                            <td>{{ $item->nama_mahasiswa}}</td>
                            <td>{{ $item->judul}}</td>
                            <td>{{ $item->total_score/13.5 }}</td>
                            <td>{{ $item->status_sidang_kp }}</td>
                            <td>
                         
                          
                                <!-- <a href="#" class="btn btn-sm btn-warning">Edit</a> -->

                                <form action="{{ route('admin.destroy-nilai-ta', $item->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Yakin ingin menghapus data ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                </form>
                       
                            </td>


                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted p-4">Belum ada data</td>
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
    <!-- Validasi Form -->
    <script>
        (function () {
            'use strict'
            var forms = document.querySelectorAll('.needs-validation')
            Array.prototype.slice.call(forms).forEach(function (form) {
                form.addEventListener('submit', function (event) {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }
                    form.classList.add('was-validated')
                }, false)
            })
        })();
    </script>
    <script>
    function exportToExcel(tableID, filename = 'nilai_tugas_akhir.xlsx') {
        const table = document.getElementById(tableID);
        const workbook = XLSX.utils.table_to_book(table, { sheet: "Sheet1" });
        XLSX.writeFile(workbook, filename);
    }
</script>
</body>
</html>
