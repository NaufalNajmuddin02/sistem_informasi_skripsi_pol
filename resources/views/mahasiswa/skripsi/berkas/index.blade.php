<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Status Persetujuan Dokumen</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="d-flex flex-column min-vh-100">

@include('layouts.navbar')


<div class="container mt-5">
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup"></button>
        </div>
    @endif

    <h2 class="mb-4">Status Pengumpulan Berkas Skripsi</h2>

    <div class="row">
        @forelse($skripsiList as $skripsi)
            <div class="col-md-6 mb-4">
                <div class="card shadow-sm h-100">
                    <div class="card-body">
                        <h5 class="card-title">{{ $skripsi->judul_skripsi }}</h5>
                        <p class="card-text mb-1"><strong>Nama:</strong> {{ $skripsi->user->username ?? '-' }}</p>
                        <p class="card-text mb-1"><strong>NIM:</strong> {{ $skripsi->user->nim ?? '-' }}</p>
                        <p class="card-text mb-1"><strong>Email:</strong> {{ $skripsi->email }}</p>
                        <p class="card-text mb-1"><strong>Nomor WA:</strong> {{ $skripsi->no_wa }}</p>
                        <p class="card-text mb-2">
                            <strong>Status:</strong>
                            @if($skripsi->status_skripsi === 'disetujui')
                                <span class="badge bg-success">Disetujui</span>
                            @else
                                <span class="badge bg-warning text-dark">Belum Disetujui</span>
                            @endif
                        </p>
                        <a href="{{ asset('storage/' . $skripsi->file_skripsi) }}" target="_blank" class="btn btn-sm btn-outline-primary">Lihat File</a>
                        <button class="btn btn-sm btn-secondary ms-2" data-bs-toggle="modal" data-bs-target="#editModal{{ $skripsi->id }}">
                            Edit
                        </button>
                    </div>
                </div>
            </div>

            <!-- Modal Edit -->
            <div class="modal fade" id="editModal{{ $skripsi->id }}" tabindex="-1" aria-labelledby="modalLabel{{ $skripsi->id }}" aria-hidden="true">
                <div class="modal-dialog">
                    <form action="{{ route('berkas.skripsi.update.all', $skripsi->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalLabel{{ $skripsi->id }}">Edit Data Skripsi</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label class="form-label">Nama</label>
                                    <input type="text" name="nama" class="form-control" value="{{ $skripsi->user->username ?? '' }}" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">NIM</label>
                                    <input type="text" name="nim" class="form-control" value="{{ $skripsi->user->nim ?? '' }}" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Judul Skripsi</label>
                                    <input type="text" name="judul_skripsi" class="form-control" value="{{ $skripsi->judul_skripsi }}" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Email</label>
                                    <input type="email" name="email" class="form-control" value="{{ $skripsi->email }}" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Nomor WhatsApp</label>
                                    <input type="text" name="no_wa" class="form-control" value="{{ $skripsi->no_wa }}" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Upload File Baru (PDF)</label>
                                    <input type="file" name="file_skripsi" class="form-control" accept="application/pdf">
                                    <small class="text-muted">Kosongkan jika tidak ingin mengganti file.</small>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info text-center">Belum ada data skripsi dikumpulkan.</div>
            </div>
        @endforelse
    </div>
</div>

 @include('layouts.footer')

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
