<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>SISTA - Edit Peserta Sidang TA</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />
</head>
<body class="d-flex flex-column min-vh-100">
    @include('layouts.navbar-kaprodi')

    <div class="container mt-5 mb-5">

        <h2 class="mb-4">Edit Peserta Sidang TA</h2>

        <form action="{{ route('kaprodi.datapesertasidang.update', $datapesertasidang->id) }}" method="POST" class="needs-validation" novalidate>
            @csrf
            @method('PUT')

            <!-- Pilih Mahasiswa -->
           <label for="user_id">Nama Mahasiswa</label>
            <select name="user_id" id="user_id" class="form-control">
                @foreach ($users as $user)
                    <option value="{{ $user->id }}" {{ ($datapesertasidang->user_id == $user->id) ? 'selected' : '' }}>
                        {{ $user->username }}
                    </option>
                @endforeach
            </select>


            <!-- NIM -->
            <div class="mb-3">
                <label for="nim" class="form-label">NIM</label>
                <input type="text" class="form-control" id="nim" name="nim" value="{{ old('nim', $datapesertasidang->nim) }}" required>
                <div class="invalid-feedback">Silakan masukkan NIM.</div>
            </div>

            <!-- Judul TA -->
            <div class="mb-3">
                <label for="judul" class="form-label">Judul TA</label>
                <input type="text" class="form-control" id="judul" name="judul" value="{{ old('nim', $datapesertasidang->judul) }}" required>
                <div class="invalid-feedback">Silakan masukkan judul.</div>
            </div>

            <!-- Dosen Pembimbing 1 -->
            <label for="dosbing1_id">Dosen Pembimbing1</label>
            <select name="dosbing1_id" id="dosbing1_id" class="form-control">
                @foreach ($users as $user)
                    <option value="{{ $user->id }}" {{ ($datapesertasidang->dosbing1_id == $user->id) ? 'selected' : '' }}>
                        {{ $user->username }}
                    </option>
                @endforeach
            </select>
            <br>

            <!-- Dosen Pembimbing 2 -->
            <label for="dosbing2_id">Dosen Pembimbing1</label>
            <select name="dosbing2_id" id="dosbing2_id" class="form-control">
                @foreach ($users as $user)
                    <option value="{{ $user->id }}" {{ ($datapesertasidang->dosbing2_id == $user->id) ? 'selected' : '' }}>
                        {{ $user->username }}
                    </option>
                @endforeach
            </select>
               <br>

            <!-- Ketua Penguji -->
            <label for="ketua_penguji_id">Ketua Penguji</label>
            <select name="ketua_penguji_id" id="ketua_penguji_id" class="form-control">
                @foreach ($users as $user)
                    <option value="{{ $user->id }}" {{ ($datapesertasidang->ketua_penguji_id == $user->id) ? 'selected' : '' }}>
                        {{ $user->username }}
                    </option>
                @endforeach
            </select>
               <br>

            <!-- Penguji 1 -->
            <label for="penguji1_id">Penguji 1 </label>
            <select name="penguji1_id" id="penguji1_id" class="form-control">
                @foreach ($users as $user)
                    <option value="{{ $user->id }}" {{ ($datapesertasidang->penguji1_id == $user->id) ? 'selected' : '' }}>
                        {{ $user->username }}
                    </option>
                @endforeach
            </select>
               <br>

            <!-- Penguji 2 -->
             <label for="penguji2_id">Penguji 2 </label>
            <select name="penguji2_id" id="penguji2_id" class="form-control">
                @foreach ($users as $user)
                    <option value="{{ $user->id }}" {{ ($datapesertasidang->penguji2_id == $user->id) ? 'selected' : '' }}>
                        {{ $user->username }}
                    </option>
                @endforeach
            </select>
               <br>

            <!-- Tombol Aksi -->
            <div class="text-end">
                <a href="{{ route('kaprodi.pesertasidang') }}" class="btn btn-secondary me-2">
                    <i class="bi bi-arrow-left-circle"></i> Kembali
                </a>
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-pencil-square"></i> Update Peserta TA
                </button>
            </div>
        </form>
    </div>

    @include('layouts.footer')

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
