<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit SKPI</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="d-flex flex-column min-vh-100">

@include('layouts.navbar')

<div class="container mt-5">
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <h2 class="mb-4">Edit SKPI</h2>

    <form action="{{ route('mahasiswa.skpi.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        {{-- ====== Bidang Penalaran dan Keilmuan ====== --}}
        <h4 class="mt-4">Aktifitas Bidang Penalaran dan Keilmuan</h4>
        <table class="table table-bordered align-middle">
            <thead class="table-light">
                <tr>
                    <th style="width: 50%">Nama Sertifikat</th>
                    <th style="width: 50%">Upload File</th>
                </tr>
            </thead>
            <tbody>
                @for ($i = 1; $i <= 5; $i++)
                    <tr>
                        <td>
                            <input type="text" name="nama_sertifikat{{ $i }}" class="form-control"
                                   value="{{ old('nama_sertifikat'.$i, $skpi->{'nama_sertifikat'.$i}) }}">
                        </td>
                        <td>
                            @if($skpi->{'file_sertifikat'.$i})
                                <a href="{{ asset('storage/'.$skpi->{'file_sertifikat'.$i}) }}" target="_blank" class="btn btn-sm btn-info mb-2">Lihat File Lama</a>
                            @endif
                            <input type="file" name="file_sertifikat{{ $i }}" class="form-control">
                        </td>
                    </tr>
                @endfor
            </tbody>
        </table>

        {{-- ====== Bidang Minat dan Bakat ====== --}}
        <h4 class="mt-4">Aktifitas Bidang Minat dan Bakat</h4>
        <table class="table table-bordered align-middle">
            <thead class="table-light">
                <tr>
                    <th style="width: 50%">Nama Sertifikat</th>
                    <th style="width: 50%">Upload File</th>
                </tr>
            </thead>
            <tbody>
                @for ($i = 6; $i <= 10; $i++)
                    <tr>
                        <td>
                            <input type="text" name="nama_sertifikat{{ $i }}" class="form-control"
                                   value="{{ old('nama_sertifikat'.$i, $skpi->{'nama_sertifikat'.$i}) }}">
                        </td>
                        <td>
                            @if($skpi->{'file_sertifikat'.$i})
                                <a href="{{ asset('storage/'.$skpi->{'file_sertifikat'.$i}) }}" target="_blank" class="btn btn-sm btn-info mb-2">Lihat File Lama</a>
                            @endif
                            <input type="file" name="file_sertifikat{{ $i }}" class="form-control">
                        </td>
                    </tr>
                @endfor
            </tbody>
        </table>

        {{-- ====== Bidang Kepemimpinan ====== --}}
        <h4 class="mt-4">Aktifitas Bidang Kepemimpinan dan Organisasi</h4>
        <table class="table table-bordered align-middle">
            <thead class="table-light">
                <tr>
                    <th style="width: 50%">Nama Sertifikat</th>
                    <th style="width: 50%">Upload File</th>
                </tr>
            </thead>
            <tbody>
                @for ($i = 11; $i <= 15; $i++)
                    <tr>
                        <td>
                            <input type="text" name="nama_sertifikat{{ $i }}" class="form-control"
                                   value="{{ old('nama_sertifikat'.$i, $skpi->{'nama_sertifikat'.$i}) }}">
                        </td>
                        <td>
                            @if($skpi->{'file_sertifikat'.$i})
                                <a href="{{ asset('storage/'.$skpi->{'file_sertifikat'.$i}) }}" target="_blank" class="btn btn-sm btn-info mb-2">Lihat File Lama</a>
                            @endif
                            <input type="file" name="file_sertifikat{{ $i }}" class="form-control">
                        </td>
                    </tr>
                @endfor
            </tbody>
        </table>

        {{-- ====== Lain-Lain ====== --}}
        <h4 class="mt-4">Aktifitas Lain-Lain</h4>
        <table class="table table-bordered align-middle">
            <thead class="table-light">
                <tr>
                    <th style="width: 50%">Nama Sertifikat</th>
                    <th style="width: 50%">Upload File</th>
                </tr>
            </thead>
            <tbody>
                @for ($i = 16; $i <= 20; $i++)
                    <tr>
                        <td>
                            <input type="text" name="nama_sertifikat{{ $i }}" class="form-control"
                                   value="{{ old('nama_sertifikat'.$i, $skpi->{'nama_sertifikat'.$i}) }}">
                        </td>
                        <td>
                            @if($skpi->{'file_sertifikat'.$i})
                                <a href="{{ asset('storage/'.$skpi->{'file_sertifikat'.$i}) }}" target="_blank" class="btn btn-sm btn-info mb-2">Lihat File Lama</a>
                            @endif
                            <input type="file" name="file_sertifikat{{ $i }}" class="form-control">
                        </td>
                    </tr>
                @endfor
            </tbody>
        </table>

        <div class="d-flex justify-content-end mt-4 mb-5">
            <a href="{{ route('mahasiswa.skpi') }}" class="btn btn-secondary me-2">Batal</a>
            <button type="submit" class="btn btn-primary">Update</button>
        </div>
    </form>
</div>

@include('layouts.footer')

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
