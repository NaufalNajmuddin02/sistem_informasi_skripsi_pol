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
    <h2>Edit Penilaian SKPI</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('admin.skpi.update', $skpi->id) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Identitas Mahasiswa -->
        <div class="mb-3">
            <label class="form-label">Nama Mahasiswa</label>
            <input type="text" class="form-control" value="{{ $skpi->user->username ?? '-' }}" readonly>
        </div>
        <div class="mb-3">
            <label class="form-label">NIM</label>
            <input type="text" class="form-control" value="{{ $skpi->user->nim ?? '-' }}" readonly>
        </div>

        <!-- ================== 1–5 ================== -->
        <h4 class="mt-4">AKTIFITAS BIDANG PENALARAN DAN KEILMUAN</h4>
        <table class="table table-bordered">
            <thead class="table-light">
                <tr>
                    <th>Nama Sertifikat</th>
                    <th>File SKPI</th>
                    <th>Nilai (1–20)</th>
                </tr>
            </thead>
            <tbody>
                @include('admin.skpi.skpi-row', ['i' => 1, 'skpi' => $skpi])
                @include('admin.skpi.skpi-row', ['i' => 2, 'skpi' => $skpi])
                @include('admin.skpi.skpi-row', ['i' => 3, 'skpi' => $skpi])
                @include('admin.skpi.skpi-row', ['i' => 4, 'skpi' => $skpi])
                @include('admin.skpi.skpi-row', ['i' => 5, 'skpi' => $skpi])
            </tbody>
        </table>

        <!-- ================== 6–10 ================== -->
        <h4 class="mt-4">AKTIFITAS BIDANG MINAT-BAKAT DAN KEGEMARAN</h4>
        <table class="table table-bordered">
            <thead class="table-light">
                <tr>
                    <th>Nama Sertifikat</th>
                    <th>File SKPI</th>
                    <th>Nilai (1–20)</th>
                </tr>
            </thead>
            <tbody>
                @include('admin.skpi.skpi-row', ['i' => 6, 'skpi' => $skpi])
                @include('admin.skpi.skpi-row', ['i' => 7, 'skpi' => $skpi])
                @include('admin.skpi.skpi-row', ['i' => 8, 'skpi' => $skpi])
                @include('admin.skpi.skpi-row', ['i' => 9, 'skpi' => $skpi])
                @include('admin.skpi.skpi-row', ['i' => 10, 'skpi' => $skpi])
            </tbody>
        </table>

        <!-- ================== 11–15 ================== -->
        <h4 class="mt-4">AKTIFITAS BIDANG KEPEMIMPINAN DAN ORGANISASI</h4>
        <table class="table table-bordered">
            <thead class="table-light">
                <tr>
                    <th>Nama Sertifikat</th>
                    <th>File SKPI</th>
                    <th>Nilai (1–20)</th>
                </tr>
            </thead>
            <tbody>
                @include('admin.skpi.skpi-row', ['i' => 11, 'skpi' => $skpi])
                @include('admin.skpi.skpi-row', ['i' => 12, 'skpi' => $skpi])
                @include('admin.skpi.skpi-row', ['i' => 13, 'skpi' => $skpi])
                @include('admin.skpi.skpi-row', ['i' => 14, 'skpi' => $skpi])
                @include('admin.skpi.skpi-row', ['i' => 15, 'skpi' => $skpi])
            </tbody>
        </table>

        <!-- ================== 16–20 ================== -->
        <h4 class="mt-4">AKTIFITAS LAIN-LAIN</h4>
        <table class="table table-bordered">
            <thead class="table-light">
                <tr>
                    <th>Nama Sertifikat</th>
                    <th>File SKPI</th>
                    <th>Nilai (1–20)</th>
                </tr>
            </thead>
            <tbody>
                @include('admin.skpi.skpi-row', ['i' => 16, 'skpi' => $skpi])
                @include('admin.skpi.skpi-row', ['i' => 17, 'skpi' => $skpi])
                @include('admin.skpi.skpi-row', ['i' => 18, 'skpi' => $skpi])
                @include('admin.skpi.skpi-row', ['i' => 19, 'skpi' => $skpi])
                @include('admin.skpi.skpi-row', ['i' => 20, 'skpi' => $skpi])
            </tbody>
        </table>

        <!-- ================== Narasi ================== -->
        <div class="mb-4">
            <label class="form-label">Narasi</label>
            <textarea name="narasi" class="form-control" rows="4">{{ old('narasi', $skpi->narasi ?? '') }}</textarea>
        </div>

        <!-- Buttons -->
        <div class="d-flex justify-content-end mb-4">
            <a href="{{ route('admin.skpi.index') }}" class="btn btn-secondary me-2">Kembali</a>
            <button type="submit" class="btn btn-primary">Simpan Nilai</button>
        </div>
    </form>
</div>

@include('layouts.footer')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
