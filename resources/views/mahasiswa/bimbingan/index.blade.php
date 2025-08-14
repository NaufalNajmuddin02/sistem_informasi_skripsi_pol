<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Bimbingan Saya</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body>
@include('layouts.navbar')

<div class="container mt-5">
    <div class="d-flex align-items-center mb-3">
        <h1 class="me-3 mb-0">AKTIFITAS BIMBINGAN</h1>
        <span class="text-muted">Daftar Catatan Bimbingan</span>
    </div>
    <hr>

    <form method="GET" class="mb-4 d-flex justify-content-between align-items-center">
        <div class="row g-2 flex-grow-1">
            <div class="col-md-4">
                <select name="dosen" class="form-select" onchange="this.form.submit()">
                    <option value="">-- Pilih Pembimbing --</option>
                    @if($dosen1)
                        <option value="{{ $dosen1 }}" {{ $filterDosen == $dosen1 ? 'selected' : '' }}>Pembimbing I - {{ $dosen1 }}</option>
                    @endif
                    @if($dosen2)
                        <option value="{{ $dosen2 }}" {{ $filterDosen == $dosen2 ? 'selected' : '' }}>Pembimbing II - {{ $dosen2 }}</option>
                    @endif
                </select>
            </div>
        </div>

        @if(!$bimbingans->isEmpty())
            <a href="{{ route('bimbingan.exportPdf') }}" class="btn btn-success ms-3">
                <i class="bi bi-download me-1"></i> Unduh Lembar Bimbingan (PDF)
            </a>

        @endif
    </form>

    @if($bimbingans->isEmpty())
        <div class="alert alert-info">
            Belum ada data bimbingan.
        </div>
    @else
        <table class="table table-bordered table-striped table-hover">
            <thead class="table-primary">
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Tanggal Bimbingan</th>
                    <th scope="col">Pemeriksaan</th>
                    <th scope="col">Perbaikan</th>
                </tr>
            </thead>
            <tbody>
                @foreach($bimbingans as $bimbingan)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $bimbingan->tanggal_bimbingan }}</td>
                        <td>{{ $bimbingan->pemeriksaan }}</td>
                        <td>{{ $bimbingan->perbaikan }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

</div>

<!-- Bootstrap JS (opsional, jika pakai komponen seperti modal) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
