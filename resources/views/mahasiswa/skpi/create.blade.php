<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload SKPI</title>
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
        <div class="alert alert-info d-flex justify-content-between align-items-center">
            <h4 class="mb-0">Kamu telah mengisi form ini.</h4>
            <a href="{{ route('mahasiswa.skpi.edit', $skpi->id) }}" class="btn btn-warning btn-sm ms-3">
                <i class="bi bi-pencil-square"></i> Edit
            </a>
        </div>
    @else


      
        <p>Penulisan nama sertifikat harus jelas dan sesuai dengan sertifikat yang diunggah. Pastikan file yang diunggah dalam format PDF, JPG, atau PNG dan tidak melebihi ukuran 2MB.</p>
        <p><b>Contoh penulisan nama sertifiat : </b>1_Nama Sertifikat_NIM_Sertifikat Pelatihan/Workshop/Kompetensi</p>
        <form action="{{ route('mahasiswa.skpi.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <table class="table table-bordered align-middle">
                <h2 class="mb-4">Aktifitas Bidang Penalaran dan Keilmuan</h2>
                <thead class="table-light">
                    <tr>
                        <th style="width: 50%">Nama Sertifikat</th>
                        <th style="width: 50%">Upload File</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><input type="text" name="nama_sertifikat1" class="form-control" placeholder="Masukkan nama sertifikat 1" ></td>
                        <td><input type="file" name="file_sertifikat1" class="form-control" ></td>
                    </tr>
                    <tr>
                        <td><input type="text" name="nama_sertifikat2" class="form-control" placeholder="Masukkan nama sertifikat 2" ></td>
                        <td><input type="file" name="file_sertifikat2" class="form-control" ></td>
                    </tr>
                    <tr>
                        <td><input type="text" name="nama_sertifikat3" class="form-control" placeholder="Masukkan nama sertifikat 3" ></td>
                        <td><input type="file" name="file_sertifikat3" class="form-control" ></td>
                    </tr>
                    <tr>
                        <td><input type="text" name="nama_sertifikat4" class="form-control" placeholder="Masukkan nama sertifikat 4" ></td>
                        <td><input type="file" name="file_sertifikat4" class="form-control" ></td>
                    </tr>
                    <tr>
                        <td><input type="text" name="nama_sertifikat5" class="form-control" placeholder="Masukkan nama sertifikat 5" ></td>
                        <td><input type="file" name="file_sertifikat5" class="form-control" ></td>
                    </tr>
                </tbody>
            </table>

            <table class="table table-bordered align-middle">
                <h2 class="mb-4">Aktifitas Bidang Minat dan Penalaran</h2>
                <thead class="table-light">
                    <tr>
                        <th style="width: 50%">Nama Sertifikat</th>
                        <th style="width: 50%">Upload File</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><input type="text" name="nama_sertifikat6" class="form-control" placeholder="Masukkan nama sertifikat 6" ></td>
                        <td><input type="file" name="file_sertifikat6" class="form-control" ></td>
                    </tr>
                    <tr>
                        <td><input type="text" name="nama_sertifikat7" class="form-control" placeholder="Masukkan nama sertifikat 2" ></td>
                        <td><input type="file" name="file_sertifikat7" class="form-control" ></td>
                    </tr>
                    <tr>
                        <td><input type="text" name="nama_sertifikat8" class="form-control" placeholder="Masukkan nama sertifikat 3" ></td>
                        <td><input type="file" name="file_sertifikat8" class="form-control" ></td>
                    </tr>
                    <tr>
                        <td><input type="text" name="nama_sertifikat9" class="form-control" placeholder="Masukkan nama sertifikat 4" ></td>
                        <td><input type="file" name="file_sertifikat9" class="form-control" ></td>
                    </tr>
                    <tr>
                        <td><input type="text" name="nama_sertifikat10" class="form-control" placeholder="Masukkan nama sertifikat 5" ></td>
                        <td><input type="file" name="file_sertifikat10" class="form-control" ></td>
                    </tr>
                </tbody>
            </table>

            <table class="table table-bordered align-middle">
                <h2 class="mb-4">Aktifitas Bidang Kepemimpinan dan Organisasi</h2>
                <thead class="table-light">
                    <tr>
                        <th style="width: 50%">Nama Sertifikat</th>
                        <th style="width: 50%">Upload File</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><input type="text" name="nama_sertifikat11" class="form-control" placeholder="Masukkan nama sertifikat 1" ></td>
                        <td><input type="file" name="file_sertifikat11" class="form-control" ></td>
                    </tr>
                    <tr>
                        <td><input type="text" name="nama_sertifikat12" class="form-control" placeholder="Masukkan nama sertifikat 2" ></td>
                        <td><input type="file" name="file_sertifikat12" class="form-control" ></td>
                    </tr>
                    <tr>
                        <td><input type="text" name="nama_sertifikat13" class="form-control" placeholder="Masukkan nama sertifikat 3" ></td>
                        <td><input type="file" name="file_sertifikat13" class="form-control" ></td>
                    </tr>
                    <tr>
                        <td><input type="text" name="nama_sertifikat14" class="form-control" placeholder="Masukkan nama sertifikat 4" ></td>
                        <td><input type="file" name="file_sertifikat14" class="form-control" ></td>
                    </tr>
                    <tr>
                        <td><input type="text" name="nama_sertifikat15" class="form-control" placeholder="Masukkan nama sertifikat 5" ></td>
                        <td><input type="file" name="file_sertifikat15" class="form-control" ></td>
                    </tr>
                </tbody>
            </table>

            <table class="table table-bordered align-middle">
                <h2 class="mb-4"> Aktifitas Lain-Lain</h2>
                <thead class="table-light">
                    <tr>
                        <th style="width: 50%">Nama Sertifikat</th>
                        <th style="width: 50%">Upload File</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><input type="text" name="nama_sertifikat16" class="form-control" placeholder="Masukkan nama sertifikat 1" ></td>
                        <td><input type="file" name="file_sertifikat16" class="form-control" ></td>
                    </tr>
                    <tr>
                        <td><input type="text" name="nama_sertifikat17" class="form-control" placeholder="Masukkan nama sertifikat 2" ></td>
                        <td><input type="file" name="file_sertifikat17" class="form-control" ></td>
                    </tr>
                    <tr>
                        <td><input type="text" name="nama_sertifikat18" class="form-control" placeholder="Masukkan nama sertifikat 3" ></td>
                        <td><input type="file" name="file_sertifikat18" class="form-control" ></td>
                    </tr>
                    <tr>
                        <td><input type="text" name="nama_sertifikat19" class="form-control" placeholder="Masukkan nama sertifikat 4" ></td>
                        <td><input type="file" name="file_sertifikat19" class="form-control" ></td>
                    </tr>
                    <tr>
                        <td><input type="text" name="nama_sertifikat20" class="form-control" placeholder="Masukkan nama sertifikat 5" ></td>
                        <td><input type="file" name="file_sertifikat20" class="form-control" ></td>
                    </tr>
                </tbody>
            </table>

            <div class="d-flex justify-content-end mt-4 mb-5">
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
