<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SISTA - Pengumpulan Berkas Akhir</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/mahasiswa/skripsi/berkasakhir.css') }}">
</head>

<body class="d-flex flex-column min-vh-100">
@include('layouts.navbar')

<div class="container mt-5">
    <h2 class="mb-4">Data Berkas Akhir Anda</h2>

    <div class="card">
        <div class="card-body">
            <p><strong>Nama:</strong> {{ $berkas->nama }}</p>
            <p><strong>Kelas:</strong> {{ $berkas->kelas }}</p>
            <p><strong>Judul Skripsi:</strong> {{ $berkas->judul_skripsi }}</p>
            <p><strong>Dosen Pembimbing 1:</strong> {{ $berkas->dosen_pembimbing_1 }}</p>
            <p><strong>Status Pembimbing 1:</strong>
                <span class="badge {{ $berkas->status_dospem_1 === 'disetujui' ? 'bg-success' : 'bg-warning text-dark' }}">
                    {{ ucfirst($berkas->status_dospem_1) }}
                </span>
            </p>
            <p><strong>Dosen Pembimbing 2:</strong> {{ $berkas->dosen_pembimbing_2 }}</p>
            <p><strong>Status Pembimbing 2:</strong>
                <span class="badge {{ $berkas->status_dospem_2 === 'disetujui' ? 'bg-success' : 'bg-warning text-dark' }}">
                    {{ ucfirst($berkas->status_dospem_2) }}
                </span>
            </p>
            <p><strong>File Skripsi:</strong>
                <a href="{{ asset('storage/' . $berkas->file_skripsi) }}" target="_blank" class="btn btn-sm btn-outline-primary">Lihat File</a>
            </p>

            <!-- Tombol Edit -->
            <button class="btn btn-sm btn-warning mt-3" data-bs-toggle="modal" data-bs-target="#editModal">
                Edit Berkas
            </button>
        </div>
    </div>
</div>

<!-- Modal Edit -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('mahasiswa.berkas-akhir.update', $berkas->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Berkas Akhir</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Nama</label>
                        <input type="text" name="nama" class="form-control" value="{{ $berkas->nama }}" readonly>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Kelas</label>
                        <select name="kelas" class="form-select" required>
                            <option value="A" {{ $berkas->kelas == 'A' ? 'selected' : '' }}>A</option>
                            <option value="B" {{ $berkas->kelas == 'B' ? 'selected' : '' }}>B</option>
                            <option value="C" {{ $berkas->kelas == 'C' ? 'selected' : '' }}>C</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Judul Skripsi</label>
                        <input type="text" name="judul_skripsi" class="form-control" value="{{ $berkas->judul_skripsi }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">File Skripsi Baru</label>
                        <input type="file" name="file_skripsi" class="form-control" accept=".pdf,.doc,.docx">
                        <small class="text-muted">Biarkan kosong jika tidak ingin mengganti file.</small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>

@include('layouts.footer')

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
