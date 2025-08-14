<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tambah Pengguna Baru</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS dan Font Awesome -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .input-group-text {
            cursor: pointer;
        }
    </style>
</head>
<body class="d-flex flex-column min-vh-100">

    @include('layouts.navbar-admin')

    <div class="container mt-5 mb-5">
        <div class="card shadow-sm">
            <div class="card-body">
                <h3 class="card-title mb-4">Tambah Pengguna Baru</h3>
                <form action="{{ route('data.store') }}" method="POST">
                    @csrf

                    <!-- Role -->
                    <div class="mb-3">
                        <label for="role" class="form-label">Role</label>
                        <select name="role" id="role" class="form-select" onchange="toggleRoleFields()">
                            <option value="mahasiswa">Mahasiswa</option>
                            <option value="dosen">Dosen</option>
                        </select>
                    </div>

                    <!-- Umum -->
                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" name="username" class="form-control" required>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="nim" class="form-label" id="labelNim">NIM</label>
                            <input type="text" name="nim" class="form-control" id="inputNim">
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="prodi" class="form-label">Program Studi</label>
                            <input type="text" name="prodi" class="form-control">
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="no_hp" class="form-label">Nomor HP</label>
                            <input type="text" name="no_hp" class="form-control">
                        </div>
                    </div>

                    <!-- Mahasiswa -->
                    <div id="mahasiswaFields">
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="kelas" class="form-label">Kelas</label>
                                <input type="text" name="kelas" class="form-control">
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="semester" class="form-label">Semester</label>
                                <input type="text" name="semester" class="form-control">
                            </div>
                        </div>
                    </div>

                    <!-- Dosen -->
                    <div id="dosenFields" style="display: none;">
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="dosen_prodi" class="form-label">Dosen Prodi</label>
                                <input type="text" name="dosen_prodi" class="form-control">
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="jabfung" class="form-label">Jabatan Fungsional</label>
                                <select name="jabfung" class="form-select">
                                    <option value="lektor_kepala">Lektor Kepala</option>
                                    <option value="lektor">Lektor</option>
                                    <option value="asisten_ahli">Asisten Ahli</option>
                                    <option value="dosen_pengampu">Dosen Pengampu</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Password -->
                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label for="password" class="form-label">Kata Sandi</label>
                            <div class="input-group">
                                <input type="password" name="password" id="password" class="form-control" required>
                                <span class="input-group-text" id="togglePassword">
                                    <i class="fa fa-eye"></i>
                                </span>
                            </div>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="password_confirmation" class="form-label">Konfirmasi Kata Sandi</label>
                            <div class="input-group">
                                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
                                <span class="input-group-text" id="toggleConfirmPassword">
                                    <i class="fa fa-eye"></i>
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Tombol -->
                    <div class="d-flex justify-content-between mt-4">
                        <a href="{{ route('data.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Batal
                        </a>
                        <button type="submit" class="btn btn-success">
                            <i class="fas fa-save"></i> Simpan Pengguna
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @include('layouts.footer')

    <!-- Script toggle field dan show/hide password -->
    <script>
        function toggleRoleFields() {
            const role = document.getElementById('role').value;
            document.getElementById('mahasiswaFields').style.display = role === 'mahasiswa' ? 'block' : 'none';
            document.getElementById('dosenFields').style.display = role === 'dosen' ? 'block' : 'none';

            const labelNim = document.getElementById('labelNim');
            const inputNim = document.getElementById('inputNim');

            if (role === 'dosen') {
                labelNim.textContent = 'NIPY';
                inputNim.placeholder = 'Masukkan NIPY';
            } else {
                labelNim.textContent = 'NIM';
                inputNim.placeholder = 'Masukkan NIM';
            }
        }

        // Toggle password visibility
        document.getElementById('togglePassword').addEventListener('click', function () {
            const passwordInput = document.getElementById('password');
            const icon = this.querySelector('i');
            passwordInput.type = passwordInput.type === 'password' ? 'text' : 'password';
            icon.classList.toggle('fa-eye');
            icon.classList.toggle('fa-eye-slash');
        });

        document.getElementById('toggleConfirmPassword').addEventListener('click', function () {
            const confirmPasswordInput = document.getElementById('password_confirmation');
            const icon = this.querySelector('i');
            confirmPasswordInput.type = confirmPasswordInput.type === 'password' ? 'text' : 'password';
            icon.classList.toggle('fa-eye');
            icon.classList.toggle('fa-eye-slash');
        });

        // Panggil saat halaman pertama kali dimuat
        document.addEventListener('DOMContentLoaded', toggleRoleFields);
    </script>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
