<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Berkas Tugas Akhir</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="d-flex flex-column min-vh-100">

@include('layouts.navbar')

<div class="container mt-5">
   @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('info'))
        <div class="alert alert-info">{{ session('info') }}</div>
    @endif
        @if($alreadyUploaded)
        <div class="alert alert-info">
            <h4>Kamu telah mengisi form ini.</h4>
          
        </div>
    @else
    <h2>Upload SKPI</h2>
       <form action="{{ route('mahasiswa.skpi.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label class="form-label">Sertifikat 1</label>
            <input type="file" name="sertifikat_1" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Sertifikat 2</label>
            <input type="file" name="sertifikat_2" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Sertifikat 3</label>
            <input type="file" name="sertifikat_3" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Sertifikat 4</label>
            <input type="file" name="sertifikat_4" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Sertifikat 5</label>
            <input type="file" name="sertifikat_5" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Sertifikat 6</label>
            <input type="file" name="sertifikat_6" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Sertifikat 7</label>
            <input type="file" name="sertifikat_7" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Sertifikat 8</label>
            <input type="file" name="sertifikat_8" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Sertifikat 9</label>
            <input type="file" name="sertifikat_9" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Sertifikat 10</label>
            <input type="file" name="sertifikat_10" class="form-control" required>
        </div>
         <div class="d-flex justify-content-end mb-5">
            <button type="button" class="btn btn-secondary me-2" onclick="window.history.back();">Batalkan</button>
            <button type="submit" class="btn btn-primary">Kirim</button>
        </div>
    </form>
    @endif

    
</div>

@include('layouts.footer')

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
