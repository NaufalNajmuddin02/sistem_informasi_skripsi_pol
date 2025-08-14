<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Pengguna Perpustakaan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/user/dashboard.css') }}">
</head>
<body class="d-flex flex-column min-vh-100">

    @include('layouts.navbar-perpus')

    <div class="container mt-4 mb-5">
        <div class="row">
            <!-- Profil Pengguna -->
            <div class="col-md-4 mb-4">
                <div class="card text-white bg-dark shadow-sm">
                    <div class="card-body d-flex align-items-center">
                        <img src="{{ auth()->user()->profile_picture ? asset('storage/' . auth()->user()->profile_picture) : asset('images/no_profile.png') }}" 
                            class="rounded-circle me-3" width="60" height="60">
                        <div>
                            <h5 class="mb-1">{{ auth()->user()->username }}</h5>
                            <small>NIM: {{ auth()->user()->nim }}</small><br>
                            <small>Prodi: {{ auth()->user()->prodi }}</small>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Kalender Akademik -->
            <div class="col-md-8 mb-4">
                <div class="card shadow-sm">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="card-title">Kalender Akademik</h5>
                            <h6 class="text-muted">{{ $tahunAkademik }}</h6>
                            <p class="mb-0">Semester {{ $semester }}</p>
                        </div>
                        <div class="calendar-icon fs-1">
                            📆
                        </div>
                    </div>
                </div>
            </div>

            <!-- Riwayat Peminjaman -->
            <div class="col-12 mb-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title mb-3">Riwayat Peminjaman Buku</h5>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead class="table-dark">
                                    <tr>
                                        <th>Judul Buku</th>
                                        <th>Tanggal Pinjam</th>
                                        <th>Tanggal Kembali</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- Dummy Data --}}
                                    <tr>
                                        <td>Pemrograman Web Lanjut</td>
                                        <td>2025-05-10</td>
                                        <td>2025-06-10</td>
                                        <td><span class="badge bg-success">Dikembalikan</span></td>
                                    </tr>
                                    <tr>
                                        <td>Sistem Informasi Manajemen</td>
                                        <td>2025-06-01</td>
                                        <td>-</td>
                                        <td><span class="badge bg-warning text-dark">Dipinjam</span></td>
                                    </tr>
                                    {{-- Data dinamis bisa di-loop di sini --}}
                                </tbody>
                            </table>
                        </div>
                        <div class="text-end">
                            <a href="#" class="btn btn-outline-primary btn-sm">Lihat Semua</a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    @include('layouts.footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
