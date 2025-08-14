<!DOCTYPE html>
<html lang="en">
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

        .scroll-container::-webkit-scrollbar {
            height: 8px;
        }

        .scroll-container::-webkit-scrollbar-thumb {
            background-color: #ccc;
            border-radius: 4px;
        }
    </style>
</head>
<body>
    @include('layouts.navbar-pembimbing')

    <div class="container mt-4">
    <h3 class="mb-4">Validasi Skripsi Anda (Sebagai Dosen Pembimbing 2)</h3>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @elseif(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="row">
        @forelse($skripsiList as $item)
            <div class="col-12 mb-3">
                <div class="card w-100 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">{{ $item->judul_skripsi }}</h5>
                        <p><strong>Nama:</strong> {{ $item->nama }}</p>
                        <p><strong>Kelas:</strong> {{ $item->kelas }}</p>
                        <p><strong>Dosen Pembimbing 1:</strong> {{ $item->dosen_pembimbing_1 }}</p>
                        <p><strong>Status Anda:</strong>
                            <span class="badge {{ $item->status_dospem_2 === 'disetujui' ? 'bg-success' : 'bg-warning text-dark' }}">
                                {{ ucfirst($item->status_dospem_2) }}
                            </span>
                        </p>

                        <a href="{{ asset('storage/' . $item->file_skripsi) }}" target="_blank" class="btn btn-sm btn-outline-primary mt-2">
                            <i class="fas fa-file-alt"></i> Lihat File
                        </a>

                        @if($item->status_dospem_2 !== 'disetujui')
                            <form method="POST" action="{{ route('dosen.validasi.dospem2.approve', $item->id) }}" class="d-inline mt-2">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-success mt-1">
                                    <i class="fas fa-check"></i> Setujui
                                </button>
                            </form>
                        @else
                            <p class="text-muted mt-2">Sudah disetujui</p>
                        @endif
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info text-center">Tidak ada skripsi untuk validasi.</div>
            </div>
        @endforelse
    </div>
</div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @include('layouts.footer')
</body>
</html>
