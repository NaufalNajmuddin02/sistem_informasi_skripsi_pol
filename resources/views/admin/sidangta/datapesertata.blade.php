<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SISTA - Tambah Dosen Mapel Proposal Skripsi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body class="d-flex flex-column min-vh-100">
    @include('layouts.navbar-admin')

    <!-- Main Content -->
    <div class="container mt-4">
    <div class="card">
        <div class="card-body">
            <h2 class="card-title mb-4">Daftar Peserta Sidang TA</h2>

            @if(session('success'))
                <div class="alert alert-success">
                    <i class="bi bi-check-circle-fill"></i> {{ session('success') }}
                </div>
            @endif

            <table class="table table-bordered table-striped">
                <thead class="table-primary">
                    <tr>
                        <th>No</th>
                        <th>Nama Mahasiswa</th>
                        <th>NIM</th>
                        <th>Judul</th>
                        <th>Dosen Pembimbing 1</th>
                        <th>Dosen Pembimbing 2</th>
                        <th>Ketua Penguji</th>
                        <th>Penguji 1</th>
                        <th>Penguji 2</th>
                        <!-- <th>Aksi</th> -->
                    </tr>
                </thead>
                <tbody>
                    @forelse($pesertaList as $peserta)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $peserta->user->username ?? '-' }}</td>
                            <td>{{ $peserta->nim }}</td>
                            <td>{{ $peserta->judul }}</td>
                            <td>{{ $peserta->dosbing1->username ?? '-' }}</td>
                            <td>{{ $peserta->dosbing2->username ?? '-' }}</td>
                            <td>{{ $peserta->ketuaPenguji->username ?? '-' }}</td>
                            <td>{{ $peserta->penguji1->username ?? '-' }}</td>
                            <td>{{ $peserta->penguji2->username ?? '-' }}</td>
                            <!-- <td>
                                <a href="{{ route('kaprodi.datapesertasidang.edit', $peserta->id) }}" class="btn btn-sm btn-warning">Edit</a>

                                <form action="{{ route('kaprodi.datapesertasidang.destroy', $peserta->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Yakin ingin menghapus data ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                </form>
                            </td> -->

                        </tr>
                    @empty
                        <tr>
                            <td colspan="10" class="text-center">Belum ada peserta.</td>
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
</body>
</html>
