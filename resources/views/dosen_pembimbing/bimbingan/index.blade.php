<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Daftar Bimbingan Seminar Disetujui</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body class="d-flex flex-column min-vh-100">
    @include('layouts.navbar-pembimbing')

    <div class="container mt-5">
        <div class="d-flex flex-column flex-md-row align-items-start align-items-md-center mb-3">
            <h1 class="me-md-3 mb-2 mb-md-0">Daftar Mahasiswa Bimbingan</h1>
            <span class="text-muted">Membuat aktivitas bimbingan mahasiswa</span>
        </div>
        <hr>

        <!-- Search Card -->
        <div class="card mb-3 shadow-sm">
            <div class="card-body py-2 px-3">
                <form action="{{ route('dosen-pembimbing.bimbingan.index') }}" method="GET" class="row g-2">
                    <div class="col-12 col-md-6">
                        <input
                            type="text"
                            name="search"
                            class="form-control"
                            placeholder="Cari mahasiswa atau judul skripsi..."
                            value="{{ request('search') }}"
                        />
                    </div>
                    <div class="col-12 col-md-2">
                        <button type="submit" class="btn btn-outline-primary w-100">
                            <i class="bi bi-search"></i> Cari
                        </button>
                    </div>
                    <div class="col-12 col-md-2">
                        <a href="{{ route('pembimbing.bimbingan.rekap') }}" class="btn btn-outline-success w-100">
                            <i class="bi bi-people-fill"></i> Rekap Bimbingan
                        </a>
                    </div>
                    <div class="col-12 col-md-2">
                        <a href="{{ route('rekomendasi.index') }}" class="btn btn-outline-info w-100">
                            <i class="bi bi-bookmark-check-fill"></i> Rekomendasi Sidang
                        </a>
                    </div>
                </form>
            </div>
        </div>

        <!-- Seminar Cards -->
        @if($seminars->isEmpty())
            <div class="alert alert-info">
                Tidak ada data seminar yang disetujui untuk Anda.
            </div>
        @else
            <div class="row">
                @foreach($seminars as $seminar)
                    <div class="col-12 col-md-6 mb-3">
                        <div class="card h-100 shadow-sm">
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title">
                                    <i class="bi bi-person"></i> {{ $seminar->name }}
                                </h5>
                                <h6 class="card-subtitle mb-2 text-muted">
                                    <i class="bi bi-journal-bookmark"></i> {{ $seminar->script_title }}
                                </h6>
                                <p class="card-text mb-3">
                                    <i class="bi bi-calendar-event"></i> {{ \Carbon\Carbon::parse($seminar->tanggal)->format('d M Y') ?? '-' }}<br>
                                    <span class="badge bg-success mt-1"><i class="bi bi-check-circle"></i> {{ ucfirst($seminar->status) }}</span>
                                </p>

                                <div class="d-flex justify-content-between mb-2 mt-auto">
                                    <!-- Lihat Komentar -->
                                    <button class="btn btn-info btn-sm" data-bs-toggle="collapse" data-bs-target="#komentar-{{ $seminar->id }}">
                                        <i class="bi bi-chat-dots"></i> Lihat Komentar
                                    </button>

                                    <!-- Tambah Catatan -->
                                    <a href="{{ route('dosen-pembimbing.bimbingan.create', $seminar->id) }}" class="btn btn-primary btn-sm">
                                        <i class="bi bi-plus-circle"></i> Tambah Catatan
                                    </a>
                                </div>

                                <div class="collapse mt-2" id="komentar-{{ $seminar->id }}">
                                    <div class="card card-body">
                                        @php
                                            $bimbingan = $seminar->bimbingan()->latest()->first();
                                        @endphp
                                        @if($bimbingan)
                                            <p><strong>Catatan Terbaru:</strong> {{ $bimbingan->pemeriksaan }}</p>
                                            <p><strong>Perbaikan:</strong> {{ $bimbingan->perbaikan }}</p>
                                        @else
                                            <p class="text-muted">Belum ada catatan bimbingan.</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

    @include('layouts.footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
