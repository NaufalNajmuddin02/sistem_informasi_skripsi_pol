<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profil</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <!-- <link rel="stylesheet" href="{{ asset('css/editprofile/edit-profile-mahasiswa.css') }}"> -->
</head>
<body>
    @include('layouts.navbar-dosen')
    <!-- Main Content -->
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <div class="container mt-4">
        <div class="row">
            <!-- Form Profil -->
            <div class="col-12 col-md-6 col-lg-4">
                <div class="profile-section">
                    <form action="{{ route('update-profile') }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label class="form-label">Username</label>
                            <input type="text" class="form-control" name="username" value="{{ auth()->user()->username }}" readonly>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Nim</label>
                            <input type="text" class="form-control" name="nim" value="{{ auth()->user()->nim }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Prodi</label>
                            <input type="text" class="form-control" name="prodi" value="{{ auth()->user()->prodi }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Semester</label>
                            <input type="text" class="form-control" name="semester" value="{{ auth()->user()->semester }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Kelas</label>
                            <input type="text" class="form-control" name="kelas" value="{{ auth()->user()->kelas }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">No. HP</label>
                            <input type="text" class="form-control" name="no_hp" value="{{ auth()->user()->no_hp }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" name="email" value="{{ auth()->user()->email }}">
                        </div>
                        
                        <button type="submit" class="btn-simpan">Simpan</button>
                    </form>
                </div>
            </div>

            <!-- Form Password -->
            <div class="col-12 col-md-6 col-lg-4">
                <div class="profile-section">
                    <form action="{{ route('update-password') }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label class="form-label">Password Baru</label>
                            <input type="password" class="form-control" name="password" placeholder="Masukkan password baru">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Masukkan Lagi</label>
                            <input type="password" class="form-control" name="password_confirmation" placeholder="Masukkan password baru">
                        </div>

                        <button type="submit" class="btn-simpan">Simpan</button>
                    </form>
                </div>
            </div>

            <!-- Form Gambar -->
            <div class="col-12 col-md-6 col-lg-4">
                <div class="profile-section">
                    <form action="{{ route('update-gambar-profile') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label class="form-label">Foto Profil</label>
                            <div class="mb-3">
                                @if(auth()->user()->profile_picture)
                                    <img src="{{ asset('storage/' . auth()->user()->profile_picture) }}" alt="Profile Picture" class="img-fluid">
                                @endif
                            </div>
                            <input type="file" class="form-control" name="profile_picture">
                            <small class="text-muted">File harus jpg/png, max 2MB.</small>
                        </div>

                        <button type="submit" class="btn-simpan">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap and Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>
</html>