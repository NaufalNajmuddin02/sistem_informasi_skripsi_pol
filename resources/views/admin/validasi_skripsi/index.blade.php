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
    <h3 class="mb-4">Daftar Skripsi Mahasiswa yang Telah Disetujui Dosen Pembimbing 1 & 2</h3>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @elseif(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="row">
        @forelse($skripsiList as $item)
            <div class="col-12 mb-3">
                <div class="card w-100 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">{{ $item->judul_skripsi }}</h5>
                        <p><strong>Nama Mahasiswa:</strong> {{ $item->nama }}</p>
                        <p><strong>Kelas:</strong> {{ $item->kelas }}</p>
                        <p><strong>Dosen Pembimbing 1:</strong> {{ $item->dosen_pembimbing_1 }}</p>
                        <p><strong>Dosen Pembimbing 2:</strong> {{ $item->dosen_pembimbing_2 }}</p>

                        <p><strong>Status:</strong>
                            <span class="badge bg-success">Disetujui oleh Dospem 1 & 2</span>
                        </p>

                        <a href="{{ asset('storage/' . $item->file_skripsi) }}" target="_blank" class="btn btn-outline-primary btn-sm">
                            <i class="fas fa-file-alt"></i> Lihat File Skripsi
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info text-center">
                    Belum ada skripsi yang disetujui oleh kedua pembimbing.
                </div>
            </div>
        @endforelse
    </div>
</div>

@include('layouts.footer')

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
