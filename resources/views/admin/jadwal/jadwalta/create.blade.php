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

   <form action="{{ route('jadwal.sidangta.store') }}" method="POST" class="needs-validation" novalidate>
    @csrf

    <!-- Pilih Mahasiswa -->
     <div class="d-flex justify-content-between align-items-center mb-3">
                <h2 class="card-title mb-0">Form Jadwal Peserta Sidang TA</h2>
               
            </div>

    <div class="mb-3">
        <label for="user_id" class="form-label">Mahasiswa</label>
        <select name="user_id" id="user_id" class="form-select" required>
            <option value="">-- Pilih Mahasiswa --</option>
            @foreach($mahasiswaList as $mhs)
                <option value="{{ $mhs->id }}">{{ $mhs->username }}</option>
            @endforeach
        </select>
        <div class="invalid-feedback">Silakan pilih mahasiswa.</div>
    </div>

    <!-- NIM -->
    <div class="mb-3">
        <label for="nim" class="form-label">NIM</label>
        <input type="text" class="form-control" id="nim" name="nim" required>
        <div class="invalid-feedback">Silakan masukkan NIM.</div>
    </div>

    <!-- Judul TA -->
    <div class="mb-3">
        <label for="judul" class="form-label">Judul TA</label>
        <input type="text" class="form-control" id="judul" name="judul" required>
        <div class="invalid-feedback">Silakan masukkan judul.</div>
    </div>

    <div class="mb-3">
        <label for="dosbing1_id" class="form-label">Dosen Pembimbing 1</label>
        <input type="text" id="dosbing1_id" name="dosbing1_id" class="form-control" readonly>
    </div>
    <div class="mb-3">
        <label for="dosbing2_id" class="form-label">Dosen Pembimbing 2</label>
        <input type="text" id="dosbing2_id" name="dosbing2_id" class="form-control" readonly>
    </div>
    <div class="mb-3">
        <label for="ketua_penguji_id" class="form-label">Ketua Penguji </label>
        <input type="text" id="ketua_penguji_id" name="ketua_penguji_id" class="form-control" readonly>
    </div>

    <div class="mb-3">
        <label for="penguji1_id" class="form-label">Penguji 1</label>
        <input type="text" id="penguji1_id" name="penguji1_id" class="form-control" readonly>
    </div>

     <div class="mb-3">
        <label for="penguji2_id" class="form-label">Penguji 2</label>
        <input type="text" id="penguji2_id" name="penguji2_id" class="form-control" readonly>
    </div>

    <!-- <div class="mb-3">
        <label for="dosbing2_id" class="form-label">Dosen Pembimbing 2</label>
        <select name="dosbing2_id" id="dosbing2_id" class="form-select">
            <option value="">-- Pilih Dosen --</option>
            @foreach($dosenList as $dosen)
                <option value="{{ $dosen->id }}" 
                    {{ (isset($peserta) && $peserta->user_id == $user->id) ? 'selected' : '' }}>
                    {{ $dosen->username }}
                </option>
            @endforeach
        </select>
    </div> -->



    <!-- Dosen Pembimbing 2 -->
    <!-- <div class="mb-3">
        <label for="dosbing2_id" class="form-label">Dosen Pembimbing 2</label>
        <select name="dosbing2_id" id="dosbing2_id" class="form-select">
            <option value="">-- Pilih Dosen --</option>
            @foreach($dosenList as $dosen)
                <option value="{{ $dosen->id }}">{{ $dosen->username }}</option>
            @endforeach
        </select>
    </div> -->

    <!-- Ketua Penguji -->
    <!-- <div class="mb-3">
        <label for="ketua_penguji_id" class="form-label">Ketua Penguji</label>
        <select name="ketua_penguji_id" id="ketua_penguji_id" class="form-select" required>
            <option value="">-- Pilih Dosen --</option>
            @foreach($dosenList as $dosen)
                <option value="{{ $dosen->id }}">{{ $dosen->username }}</option>
            @endforeach
        </select>
        <div class="invalid-feedback">Silakan pilih ketua penguji.</div>
    </div> -->

    <!-- Penguji 1 -->
    <!-- <div class="mb-3">
        <label for="penguji1_id" class="form-label">Penguji 1</label>
        <select name="penguji1_id" id="penguji1_id" class="form-select" required>
            <option value="">-- Pilih Dosen --</option>
            @foreach($dosenList as $dosen)
                <option value="{{ $dosen->id }}">{{ $dosen->username }}</option>
            @endforeach
        </select>
        <div class="invalid-feedback">Silakan pilih penguji 1.</div>
    </div> -->

    <!-- Penguji 2 -->
    <!-- <div class="mb-3">
        <label for="penguji2_id" class="form-label">Penguji 2</label>
        <select name="penguji2_id" id="penguji2_id" class="form-select">
            <option value="">-- Pilih Dosen --</option>
            @foreach($dosenList as $dosen)
                <option value="{{ $dosen->id }}">{{ $dosen->username }}</option>
            @endforeach
        </select>
    </div> -->

    <!-- Tanggal Sidang -->
    <div class="mb-3">
        <label for="tanggal" class="form-label">Tanggal Sidang</label>
        <input type="date" class="form-control" id="tanggal" name="tanggal" required>
        <div class="invalid-feedback">Silakan masukkan tanggal sidang.</div>
    </div>

    <!-- Waktu Sidang -->
    <div class="mb-3">
        <label for="waktu" class="form-label">Waktu Sidang</label>
        <input type="time" class="form-control" id="waktu" name="waktu" required>
        <div class="invalid-feedback">Silakan masukkan waktu sidang.</div>
    </div>
    <div class="mb-3">
        <label for="waktu" class="form-label">Waktu Sidang</label>
        <input type="time" class="form-control" id="waktu" name="selesai" required>
        <div class="invalid-feedback">Silakan masukkan waktu selesai sidang.</div>
    </div>

    <!-- Ruangan -->
    <div class="mb-3">
        <label for="ruangan" class="form-label">Ruangan</label>
        <input type="text" class="form-control" id="ruangan" name="ruangan" required>
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
   <script>
    document.getElementById('user_id').addEventListener('change', function () {
        let userId = this.value;
        if (userId) {
            fetch(`/get-peserta-ta/${userId}`)
                .then(response => {
                    if (!response.ok) throw new Error('Data tidak ditemukan');
                    return response.json();
                })
                .then(data => {
                    document.getElementById('nim').value = data.nim || '';
                    document.getElementById('judul').value = data.judul || '';

                    // Menampilkan nama dosen, bukan ID
                    document.getElementById('dosbing1_id').value = data.dosbing1?.username || '';
                    document.getElementById('dosbing2_id').value = data.dosbing2?.username || '';
                    document.getElementById('ketua_penguji_id').value = data.ketua_penguji?.username || '';
                    document.getElementById('penguji1_id').value = data.penguji1?.username || '';
                    document.getElementById('penguji2_id').value = data.penguji2?.username || '';
                })
                .catch(error => {
                    alert('Data mahasiswa belum tersedia atau gagal diambil.');
                    console.error(error);

                    const fields = [
                        'nim', 'judul', 
                        'dosbing1_id', 'dosbing2_id', 
                        'ketua_penguji_id', 'penguji1_id', 'penguji2_id'
                    ];

                    fields.forEach(field => {
                        document.getElementById(field).value = '';
                    });
                });
        }
    });
    </script>



</body>
</html>
