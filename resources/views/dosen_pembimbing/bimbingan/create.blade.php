<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tambah Catatan Bimbingan</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">  <!-- penting untuk responsive -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>
<body class="d-flex flex-column min-vh-100">
    @include('layouts.navbar-pembimbing')
    <div class="container mt-5">
        <div class="d-flex flex-column flex-md-row align-items-start align-items-md-center mb-3">
            <h1 class="me-md-3 mb-2 mb-md-0">Tambah Catatan Bimbingan</h1>
            <span class="text-muted">Membuat aktivitas bimbingan mahasiswa</span>
        </div>
        <hr>

        <form action="{{ route('bimbingan.store') }}" method="POST">
            @csrf
            <input type="hidden" name="seminar_id" value="{{ $seminar->id }}">

            <div class="mb-3">
                <label for="nama_mahasiswa" class="form-label">Nama Mahasiswa</label>
                <input type="text" class="form-control" id="nama_mahasiswa" name="nama_mahasiswa" 
                       value="{{ $seminar->name }}" required readonly>
            </div>

            <div class="mb-3">
                <label for="nama_dosen" class="form-label">Nama Dosen Pembimbing</label>
                <input type="text" class="form-control" id="nama_dosen" name="nama_dosen" 
                       value="{{ $namaDosen }}" required readonly>
            </div>

            <div class="mb-3">
                <label for="tanggal_bimbingan" class="form-label">Tanggal Bimbingan</label>
                <input type="date" class="form-control" id="tanggal_bimbingan" name="tanggal_bimbingan" required>
            </div>

            <div class="mb-3">
                <label for="pemeriksaan" class="form-label">Pemeriksaan</label>
                <textarea class="form-control" id="pemeriksaan" name="pemeriksaan" rows="4" required></textarea>
            </div>

            <div class="mb-3">
                <label for="perbaikan" class="form-label">Perbaikan</label>
                <textarea class="form-control" id="perbaikan" name="perbaikan" rows="4" required></textarea>
            </div>

            <div class="d-flex justify-content-end mt-4 mb-5 gap-2 flex-wrap">
                <a href="{{ route('dosen-pembimbing.bimbingan.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Batalkan
                </a>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Simpan
                </button>
            </div>
        </form>
    </div>

    @include('layouts.footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
