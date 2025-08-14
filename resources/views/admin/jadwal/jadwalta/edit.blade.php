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
    @include('layouts.navbar-admin')

    <div class="container mt-5 mb-5">

   <form action="{{ route('admin.jadwalta.update', $jadwal->id) }}" method="POST" class="needs-validation" novalidate>
    @csrf
    @method('PUT')

    <!-- Pilih Mahasiswa -->
     <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="card-title mb-0">Edit Jadwal Peserta Sidang TA</h2>
    </div>

    <div class="mb-3">
        <label for="user_id" class="form-label">Mahasiswa</label>
        <input name="mahasiswa_nama" type="text" 
           id="mahasiswa_nama" 
           class="form-control" 
           value="{{ $jadwal->user->username ?? '-' }}" 
           readonly>
        <div class="invalid-feedback">Silakan pilih mahasiswa.</div>
    </div>
    <!-- <p>{{ $jadwal->user_id->username ?? '-' }}</p> -->

    <!-- NIM -->
    <div class="mb-3">
        <label for="nim" class="form-label">NIM</label>
        <input type="text" class="form-control" id="nim" name="nim" value="{{ $jadwal->nim }}" required readonly>
        <div class="invalid-feedback">Silakan masukkan NIM.</div>
    </div>

    <!-- Judul TA -->
    <div class="mb-3">
        <label for="judul" class="form-label">Judul TA</label>
        <input type="text" class="form-control" id="judul" name="judul" value="{{ $jadwal->judul }}" required readonly>
        <div class="invalid-feedback">Silakan masukkan judul.</div>
    </div>

    <!-- Dosen Pembimbing 1 -->
    <div class="mb-3">
    <label for="dosbing2_nama" class="form-label">Dosen Pembimbing 1</label>
    <input name="dosbing1_nama" type="text" 
           id="dosbing1_nama" 
           class="form-control" 
           value="{{ $jadwal->dosbing1->username ?? '-' }}" 
           readonly
           >
    </div>

    <!-- Dosen Pembimbing 2 -->
    <div class="mb-3">
    <label for="dosbing2_nama" class="form-label">Dosen Pembimbing 2</label>
    <input name="dosbing2_nama" type="text" 
           id="dosbing2_nama" 
           class="form-control" 
           value="{{ $jadwal->dosbing2->username ?? '-' }}" 
           readonly
           >
    </div>

    <!-- <p>ID dosbing2: {{ $jadwalTA->dosbing2_id }}</p> -->


    <!-- Input Hidden yang akan dikirim ke server (menyimpan ID dosen) -->
    <input type="hidden" name="dosbing2_id" id="dosbing2_id" value="{{ old('dosbing2_id', $jadwal->dosbing2_id ?? '') }}">





    <!-- Ketua Penguji -->
   <div class="mb-3">
    <label for="ketua_penguji_nama" class="form-label">Ketua Penguji</label>
    <input  name="ketua_penguji_nama"
            type="text" 
           id="ketua_penguji_nama" 
           class="form-control" 
           value="{{ $jadwal->ketuaPenguji->username ?? '-' }}" 
           readonly
           >
    </div>

    <!-- Penguji 1 -->
      <div class="mb-3">
    <label for="penguji1_nama" class="form-label">Penguji 1</label>
    <input name="penguji1_nama" type="text" 
           id="penguji1_nama" 
           class="form-control" 
           value="{{ $jadwal->penguji1->username ?? '-' }}" 
           readonly
           >
    </div>

    <!-- Penguji 2 -->
     <div class="mb-3">
    <label for="penguji2_nama" class="form-label">Penguji 2</label>
    <input name="penguji2_nama" type="text" 
           id="penguji2_nama" 
           class="form-control" 
           value="{{ $jadwal->penguji2->username ?? '-' }}" 
           readonly
           >
    </div>

    <!-- Tanggal Sidang -->
    <div class="mb-3">
        <label for="tanggal" class="form-label">Tanggal Sidang</label>
        <input type="date" class="form-control" id="tanggal" name="tanggal" value="{{ $jadwal->tanggal }}" required>
        <div class="invalid-feedback">Silakan masukkan tanggal sidang.</div>
    </div>

    <!-- Waktu Sidang -->
    <div class="mb-3">
        <label for="waktu" class="form-label">Waktu Sidang</label>
        <input type="time" class="form-control" id="waktu" name="waktu" value="{{ $jadwal->waktu }}" required>
        <div class="invalid-feedback">Silakan masukkan waktu sidang.</div>
    </div>

    <!-- Ruangan -->
    <div class="mb-3">
        <label for="ruangan" class="form-label">Ruangan</label>
        <input type="text" class="form-control" id="ruangan" name="ruangan" value="{{ $jadwal->ruangan }}" required>
        <div class="invalid-feedback">Silakan masukkan nama ruangan.</div>
    </div>

    <!-- Tombol Aksi -->
    <div class="text-end">
        <a href="{{ route('kaprodi.pesertasidang') }}" class="btn btn-secondary me-2">
            <i class="bi bi-arrow-left-circle"></i> Kembali
        </a>
        <button type="submit" class="btn btn-success">
            <i class="bi bi-plus-circle"></i> Simpan Peserta TA
        </button>
    </div>
</form>
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
