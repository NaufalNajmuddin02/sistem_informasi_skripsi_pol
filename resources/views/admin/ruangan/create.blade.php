<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ isset($ruangan) ? 'Edit' : 'Tambah' }} Ruangan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>
<body class="d-flex flex-column min-vh-100">
    @include('layouts.navbar-admin')

    <div class="container mt-4">
        <h2>{{ isset($ruangan) ? 'Edit' : 'Tambah' }} Ruangan</h2>
        <hr>

        <form action="{{ isset($ruangan) ? route('data.ruangan.update', $ruangan->id) : route('data.ruangan.store') }}" method="POST">
            @csrf
            @if(isset($ruangan)) @method('PUT') @endif

            <div class="mb-3">
                <label for="nama" class="form-label">Nama Ruangan</label>
                <input type="text" name="nama" class="form-control" value="{{ old('nama', $ruangan->nama ?? '') }}" required>
            </div>

            
            <div class="d-flex justify-content-end gap-2">
                <a href="{{ route('data.ruangan.index') }}" class="btn btn-secondary">
                    Kembali
                </a>
                <button type="submit" class="btn btn-success">
                    <i class="fas fa-save"></i> Simpan
                </button>
            </div>

        </form>
    </div>

    @include('layouts.footer')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
