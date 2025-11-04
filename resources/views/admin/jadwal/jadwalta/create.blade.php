<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SISTA - Tambah Dosen Mapel Proposal Skripsi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        .alert-danger {
            border-left: 5px solid #dc3545;
        }
    </style>
</head>
<body class="d-flex flex-column min-vh-100">
    @include('layouts.navbar-admin')

    <div class="container mt-5 mb-5">
        <form action="{{ route('jadwal.sidangta.store') }}" method="POST" class="needs-validation" novalidate id="jadwalForm">
            @csrf

            <!-- Pilih Mahasiswa -->
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h2 class="card-title mb-0">Form Jadwal Peserta Sidang TA</h2>
            </div>

            <!-- Tampilkan error dari session -->
            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i>
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <!-- Tampilkan error validasi -->
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="mb-3">
                <label for="user_id" class="form-label">Mahasiswa</label>
                <select name="user_id" id="user_id" class="form-select" required>
                    <option value="">-- Pilih Mahasiswa --</option>
                    @foreach($mahasiswaList as $mhs)
                        <option value="{{ $mhs->id }}" {{ old('user_id') == $mhs->id ? 'selected' : '' }}>
                            {{ $mhs->username }}
                        </option>
                    @endforeach
                </select>
                <div class="invalid-feedback">Silakan pilih mahasiswa.</div>
            </div>

            <!-- NIM -->
            <div class="mb-3">
                <label for="nim" class="form-label">NIM</label>
                <input type="text" class="form-control" id="nim" name="nim" value="{{ old('nim') }}" required readonly>
                <div class="invalid-feedback">Silakan masukkan NIM.</div>
            </div>

            <!-- Judul TA -->
            <div class="mb-3">
                <label for="judul" class="form-label">Judul TA</label>
                <input type="text" class="form-control" id="judul" name="judul" value="{{ old('judul') }}" required>
                <div class="invalid-feedback">Silakan masukkan judul.</div>
            </div>

            <div class="mb-3">
                <label for="dosbing1_id" class="form-label">Dosen Pembimbing 1</label>
                <input type="text" id="dosbing1_id" name="dosbing1_id" class="form-control" value="{{ old('dosbing1_id') }}" readonly>
            </div>
            
            <div class="mb-3">
                <label for="dosbing2_id" class="form-label">Dosen Pembimbing 2</label>
                <input type="text" id="dosbing2_id" name="dosbing2_id" class="form-control" value="{{ old('dosbing2_id') }}" readonly>
            </div>
            
            <div class="mb-3">
                <label for="ketua_penguji_id" class="form-label">Ketua Penguji</label>
                <input type="text" id="ketua_penguji_id" name="ketua_penguji_id" class="form-control" value="{{ old('ketua_penguji_id') }}" readonly>
            </div>

            <div class="mb-3">
                <label for="penguji1_id" class="form-label">Penguji 1</label>
                <input type="text" id="penguji1_id" name="penguji1_id" class="form-control" value="{{ old('penguji1_id') }}" readonly>
            </div>

            <div class="mb-3">
                <label for="penguji2_id" class="form-label">Penguji 2</label>
                <input type="text" id="penguji2_id" name="penguji2_id" class="form-control" value="{{ old('penguji2_id') }}" readonly>
            </div>

            <!-- Tanggal Sidang -->
            <div class="mb-3">
                <label for="tanggal" class="form-label">Tanggal Sidang</label>
                <input type="date" class="form-control" id="tanggal" name="tanggal" value="{{ old('tanggal') }}" required>
                <div class="invalid-feedback">Silakan masukkan tanggal sidang.</div>
            </div>

            <!-- Waktu Mulai Sidang -->
            <div class="mb-3">
                <label for="waktu" class="form-label">Waktu Mulai Sidang</label>
                <input type="time" class="form-control" id="waktu" name="waktu" value="{{ old('waktu') }}" required>
                <div class="invalid-feedback">Silakan masukkan waktu sidang.</div>
            </div>
            
            <!-- Waktu Selesai Sidang -->
            <div class="mb-3">
                <label for="selesai" class="form-label">Waktu Selesai Sidang</label>
                <input type="time" class="form-control" id="selesai" name="selesai" value="{{ old('selesai') }}" required>
                <div class="invalid-feedback">Silakan masukkan waktu selesai sidang.</div>
            </div>

            <!-- Ruangan -->
            <div class="mb-3">
                <label for="ruangan" class="form-label">Ruangan</label>
                <input type="text" class="form-control" id="ruangan" name="ruangan" value="{{ old('ruangan') }}" required>
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

        // Validasi waktu selesai harus setelah waktu mulai
        document.getElementById('jadwalForm').addEventListener('submit', function(e) {
            const waktu = document.getElementById('waktu').value;
            const selesai = document.getElementById('selesai').value;
            
            if (waktu && selesai && waktu >= selesai) {
                e.preventDefault();
                alert('Waktu selesai harus setelah waktu mulai');
            }
        });
    </script>
</body>
</html>