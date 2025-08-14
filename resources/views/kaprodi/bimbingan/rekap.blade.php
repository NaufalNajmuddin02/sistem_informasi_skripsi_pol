<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Rekap Bimbingan Mahasiswa</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        h1 {
            font-weight: 600;
        }
        .table th, .table td {
            vertical-align: middle;
        }
        .badge {
            font-size: 0.9rem;
            padding: 0.5em 0.75em;
        }
    </style>
</head>
<body class="d-flex flex-column min-vh-100">
    @include('layouts.navbar-kaprodi')

    <div class="container mt-5">
        <!-- Judul + Pencarian -->
        <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap">
            <h1 class="mb-3 mb-md-0">Rekap Bimbingan Mahasiswa</h1>

            <!-- Form Search -->
            <form action="{{ route('kaprodi.bimbingan.rekap') }}" method="GET" class="mb-3 mb-md-0">
                <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Cari mahasiswa atau judul..." value="{{ $search }}">
                    <button type="submit" class="btn btn-outline-primary">
                        <i class="bi bi-search"></i> Cari
                    </button>
                </div>
            </form>
        </div>
        <hr>


        <!-- Tabel Rekap -->
        <div class="table-responsive shadow-sm rounded">
            <table class="table table-bordered table-hover align-middle mb-0">
                <thead class="table-info">
                    <tr>
                        <th scope="col" style="width: 60px;">No</th>
                        <th scope="col">Nama Mahasiswa</th>
                        <th scope="col">Judul Skripsi</th>
                        <th scope="col" style="width: 160px;">Total Bimbingan</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($seminars as $index => $seminar)
                        <tr>
                            <td>{{ ($seminars->currentPage() - 1) * $seminars->perPage() + $index + 1 }}</td>
                            <td>{{ $seminar->name }}</td>
                            <td>{{ $seminar->script_title }}</td>
                            <td class="text-center">
                                <span class="badge bg-primary">
                                    {{ $seminar->bimbingan_count }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted py-4">Tidak ada data bimbingan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Paginasi -->
        <div class="d-flex justify-content-center mt-4">
            {{ $seminars->links() }}
        </div>
    </div>

    @include('layouts.footer')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
