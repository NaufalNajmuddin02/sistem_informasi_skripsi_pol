<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SISTA - Pengajuan Dosen Pembimbing</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="d-flex flex-column min-vh-100">
    @include('layouts.navbar')
    <!-- Main Content -->
    <div class="container mt-4">
        <div class="card">
            <div class="card-body">
                <h2 class="card-title mb-4">Pengajuan Dosen Pembimbing</h2>
                
                <form action="{{ route('bimbingans.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama</label>
                        <input type="text" name="nama" id="nama" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="kelas" class="form-label">Kelas</label>
                        <select name="kelas" id="kelas" class="form-select" required>
                            <option value="">Pilih Kelas</option>
                            <option value="A">A</option>
                            <option value="B">B</option>
                            <option value="C">C</option>
                            <option value="D">D</option>
                            <option value="E">E</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="tanggal_mulai" class="form-label">Tanggal Pengajuan</label>
                        <input type="date" name="tanggal_mulai" id="tanggal_mulai" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="nama_dosen" class="form-label">Nama Dosen</label>
                        <select name="nama_dosen" id="nama_dosen" class="form-select" required>
                            <option value="">Pilih Dosen</option>
                            @foreach($dosens as $dosen)
                                <option value="{{ $dosen->nama_dosen }}">{{ $dosen->nama_dosen }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="periode" class="form-label">Periode</label>
                        <select class="form-select" name="periode" id="periode">
                            <option selected>-- Pilih Periode Mulai --</option>
                            <option>2024/2025</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="file_surat" class="form-label">File Surat Permohonan</label>
                        <div class="input-group">
                            <input type="file" name="file_surat" id="file_surat" class="form-control" required>
                        </div>
                        <div class="form-text">pdf, (maksimal 20mb)</div>
                    </div>

                    <div class="text-end">
                        <button type="button" class="btn btn-danger">Batalkan</button>
                        <button type="submit" class="btn btn-success">Ajukan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @include('layouts.footer')

    <!-- Bootstrap JS and Font Awesome -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
