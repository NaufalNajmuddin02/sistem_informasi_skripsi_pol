<!DOCTYPE html>
<html>
<head>
    <title>Edit Informasi Terbaru</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body class="d-flex flex-column min-vh-100">
    @include('layouts.navbar-admin')

    <div class="container mt-4">
        <h3 class="mb-3">Edit Informasi</h3>
        <hr>

        <div class="card shadow-sm">
            <div class="card-body">
                <form action="{{ route('infoTerbaru.update', $info->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="judul" class="form-label">Judul</label>
                        <input type="text" class="form-control" id="judul" name="judul" value="{{ $info->judul }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="konten" class="form-label">Isi Informasi</label>
                        <textarea class="form-control" id="konten" name="konten" rows="5" required>{{ $info->konten }}</textarea>
                    </div>
                    <div class="d-flex justify-content-end">
                        <a href="{{ route('infoTerbaru.index') }}" class="btn btn-secondary me-2">
                            <i class="bi bi-arrow-left-circle"></i> Kembali
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-save2"></i> Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @include('layouts.footer')

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
