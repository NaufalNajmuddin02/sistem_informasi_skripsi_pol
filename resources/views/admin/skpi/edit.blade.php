<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SISTA</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="d-flex flex-column min-vh-100">

@include('layouts.navbar-admin')

    <div class="container mt-4">
        <!-- <h2>Daftar SKPI</h2> -->
        <div class="container mt-4">
    <h2>Edit Penilaian SKPI</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('admin.skpi.update', $skpi->id) }}"
        method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="waktu" class="form-label">Nama Mahasiswa : </label>
            <input type="text" class="form-control" id="waktu" name="name" value="{{ $skpi->user->username ?? $skpi->user->name ?? '-' }}" required readonly>
        <div class="invalid-feedback">Silakan masukkan waktu sidang.</div>
        <div class="mb-3">
            <label for="waktu" class="form-label">NIM Mahasiswa : </label>
            <input type="text" class="form-control" id="waktu" name="name" value="{{ $skpi->user->nim ?? $skpi->user->nim ?? '-' }}" required readonly>
        <div class="invalid-feedback">Silakan masukkan waktu sidang.</div>
        </div>
        <div class="row">
            @for ($i = 1; $i <= 10; $i++)
                @php
                    $fileCol  = "sertifikat$i";
                    $nilaiCol = "nilai_sertifikat$i";
                    $filePath = $skpi->$fileCol;
                @endphp

                <div class="col-md-6 mb-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <h5 class="card-title">Sertifikat {{ $i }}</h5>

                            @if($filePath)
                                <p>
                                    <a href="{{ asset('storage/'.$filePath) }}"
                                       target="_blank" class="btn btn-sm btn-outline-primary">
                                        Lihat / Unduh
                                    </a>
                                </p>
                            @else
                                <p class="text-muted fst-italic">Belum di-upload</p>
                            @endif

                            <div class="mb-2">
                                <label class="form-label">
                                    Nilai (0-15)
                                </label>
                                <input type="number"
                                       name="nilai_sertifikat{{ $i }}"
                                       class="form-control @error("nilai_sertifikat$i") is-invalid @enderror"
                                       value="{{ old("nilai_sertifikat$i", $skpi->$nilaiCol) }}"
                                       min="0" max="100" step="1">
                                @error("nilai_sertifikat$i")
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            @endfor
        </div>

        <div class="d-flex justify-content-end mb-3">
            <a href="{{ route('admin.skpi.index') }}" class="btn btn-secondary me-2">
                Kembali
            </a>
            <button type="submit" class="btn btn-primary">
                Simpan Nilai
            </button>
        </div>
    </form>
</div>
</div>
        

@include('layouts.footer')

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

@include('layouts.footer')
</body>
</html>
