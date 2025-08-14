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
    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <h2>Upload Berkas Skripsi</h2>
    <form action="{{ route('berkas.skripsistore') }}" method="POST" enctype="multipart/form-data">
        @csrf

       <div class="mb-3">
            <label class="form-label">NIM</label>
            <input type="text" class="form-control" value="{{ Auth::user()->nim }}" readonly name="nim" />
        </div>

        <div class="mb-3">
            <label class="form-label">Nama</label>
            <input type="text" class="form-control" value="{{ Auth::user()->username }}" readonly name="nama" />
        </div>
        <div class="mb-3">
            <label class="form-label" for="judul_skripsi">Judul Skripsi</label>
            <input type="text" class="form-control" id="judul_skripsi" name="judul_skripsi" />
        </div>
        <div class="mb-3">
            <label class="form-label" for="email">Email</label>
            <input type="text" class="form-control" id="email" name="email" />
        </div>
        <div class="mb-3">
            <label class="form-label" for="nomor_wa">Nomor WA</label>
            <input type="text" class="form-control" id="nomor_wa" name="no_wa" />
        </div>    
        <!-- Upload File -->
        <div class="mb-3">
            <label class="form-label">Naskah</label>
            <input type="file" name="file_skripsi" class="form-control" required>
        </div>
        <div class="d-flex justify-content-end mb-5">
        <button type="submit" class="btn btn-primary">Simpan</button>
    </div>
    </form>
</div>

@include('layouts.footer')

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
