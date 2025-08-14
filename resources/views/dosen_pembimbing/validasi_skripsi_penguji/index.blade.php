<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SISTA - Validasi Skripsi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

    <style>
        html, body {
            height: 100%;
            margin: 0;
        }
        body {
            display: flex;
            flex-direction: column;
        }
        main {
            flex: 1;
        }
        footer {
            margin-top: auto;
        }
    </style>
</head>
<body>
    @include('layouts.navbar-pembimbing')

    <main class="container mt-4">
        <h3 class="mb-4">Daftar Skripsi Mahasiswa untuk Validasi Anda</h3>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="row">
            @forelse($skripsiList as $item)
                <div class="col-12 mb-3">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">{{ $item->judul_skripsi }}</h5>
                            <p><strong>Nama:</strong> {{ $item->nama }}</p>
                            <p><strong>Kelas:</strong> {{ $item->kelas }}</p>

                            <p><strong>File Skripsi:</strong>
                                <a href="{{ asset('storage/' . $item->file_skripsi) }}" target="_blank" class="btn btn-sm btn-outline-primary">
                                    <i class="fas fa-file-alt"></i> Lihat File
                                </a>
                            </p>

                            @php
                                $username = Auth::user()->username;
                                $canApprove = false;
                                $statusField = '';
                                $statusValue = '';

                                if ($username === $item->ketua_penguji) {
                                    $canApprove = $item->status_ketua !== 'disetujui';
                                    $statusValue = $item->status_ketua;
                                    $statusField = 'status_ketua';
                                } elseif ($username === $item->penguji1) {
                                    $canApprove = $item->status_penguji1 !== 'disetujui';
                                    $statusValue = $item->status_penguji1;
                                    $statusField = 'status_penguji1';
                                } elseif ($username === $item->penguji2) {
                                    $canApprove = $item->status_penguji2 !== 'disetujui';
                                    $statusValue = $item->status_penguji2;
                                    $statusField = 'status_penguji2';
                                }
                            @endphp

                            <p><strong>Status Anda:</strong>
                                <span class="badge {{ $statusValue === 'disetujui' ? 'bg-success' : 'bg-warning text-dark' }}">
                                    {{ ucfirst($statusValue) }}
                                </span>
                            </p>

                            @if($canApprove)
                                <form method="POST" action="{{ route('dosen-pembimbing.validasi.approve', [$item->id, $statusField]) }}" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-success">
                                        <i class="fas fa-check"></i> Setujui
                                    </button>
                                </form>
                            @else
                                <p class="text-muted">Sudah disetujui</p>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-info text-center">Tidak ada skripsi yang perlu Anda validasi.</div>
                </div>
            @endforelse
        </div>
    </main>

    @include('layouts.footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
