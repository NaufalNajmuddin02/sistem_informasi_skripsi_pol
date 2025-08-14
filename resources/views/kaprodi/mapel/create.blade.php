<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SISTA - Tambah Dosen Mapel Proposal Skripsi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body class="d-flex flex-column min-vh-100">
    @include('layouts.navbar-kaprodi')

    <!-- Main Content -->
    <div class="container mt-4">
        <div class="card">
            <div class="card-body">
                <h2 class="card-title mb-4">Tambah Dosen Mapel Proposal Skripsi</h2>

                <!-- Notifikasi Sukses -->
                @if(session('success'))
                    <div class="alert alert-success">
                        <i class="bi bi-check-circle-fill"></i> {{ session('success') }}
                    </div>
                @endif

                <!-- Menampilkan Error Validasi -->
                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                                <li><i class="bi bi-exclamation-triangle-fill"></i> {{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Form Tambah Mata Kuliah -->
                <form action="{{ route('mapel.store') }}" method="POST" class="needs-validation" novalidate>
                    @csrf

                    <!-- Dropdown Pilihan Dosen -->
                    <div class="mb-3">
                        <label for="dosen_id" class="form-label">Pilih Dosen</label>
                        <select name="dosen_id" id="dosen_id" class="form-select" required>
                            <option value="">-- Pilih Dosen --</option>
                            @foreach($dosenList as $dosen)
                                <option value="{{ $dosen->id }}">{{ $dosen->username }}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback">Silakan pilih dosen.</div>
                    </div>

                    <!-- Dropdown Nama Mata Kuliah -->
                    <div class="mb-3">
                        <label for="nama_mapel" class="form-label">Nama Mata Kuliah</label>
                        <select name="nama_mapel" id="nama_mapel" class="form-select" required>
                            <option value="">-- Pilih Mata Kuliah --</option>
                            <option value="Proposal skripsi">Proposal Skripsi</option>
                        </select>
                        <div class="invalid-feedback">Silakan pilih mata kuliah.</div>
                    </div>

                    <!-- Dropdown Pilihan Kelas -->
                    <div class="mb-3">
                        <label for="kelas" class="form-label">Pilih Kelas</label>
                        <select name="kelas" id="kelas" class="form-select" required>
                            <option value="">-- Pilih Kelas --</option>
                            <option value="A">A</option>
                            <option value="B">B</option>
                            <option value="C">C</option>
                            <option value="D">D</option>
                            <option value="E">E</option>
                        </select>
                        <div class="invalid-feedback">Silakan pilih kelas.</div>
                    </div>
                    <!-- Tahun Akademik (Tampilan) -->
                    <div class="mb-3">
                        <label class="form-label">Tahun Akademik</label>
                        <input type="text" class="form-control" value="{{ $tahunAkademik }}" readonly>
                    </div>

                    <!-- Tahun Akademik (Kirim Data) -->
                    <input type="hidden" name="tahun_akademik" value="{{ $tahunAkademik }}">


                    <!-- Tombol Aksi -->
                    <div class="text-end">
                        <a href="{{ route('mapel.index') }}" class="btn btn-secondary me-2">
                            <i class="bi bi-arrow-left-circle"></i> Kembali
                        </a>
                        <button type="submit" class="btn btn-success">
                            <i class="bi bi-plus-circle"></i> Tambah Mata Kuliah
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @include('layouts.footer')

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Validasi Form -->
    <script>
        (function () {
            'use strict'
            var forms = document.querySelectorAll('.needs-validation')

            Array.prototype.slice.call(forms).forEach(function (form) {
                form.addEventListener('submit', function (event) {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }
                    form.classList.add('was-validated')
                }, false)
            })
        })();
    </script>
</body>
</html>
