<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Status Persetujuan Dokumen</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="d-flex flex-column min-vh-100">

@include('layouts.navbar-perpus')


<div class="container mt-5">
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup"></button>
        </div>
    @endif
    <h2 class="mb-4">Status Pengumpulan Berkas Skripsi</h2>

    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead class="table-primary text-center">
                <tr>
                    <th>Nama</th>
                    <th>NIM</th>
                    <th>Judul Skripsi</th>
                    <th>Email</th>
                    <th>No WA</th>
                    <th>File</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody class="text-center">
                @forelse($skripsiList as $skripsi)
                    <tr>
                        <td>{{ $skripsi->user->username ?? '-' }}</td>
                        <td>{{ $skripsi->user->nim ?? '-' }}</td>
                        <td>{{ $skripsi->judul_skripsi }}</td>
                        <td>{{ $skripsi->email }}</td>
                        <td>{{ $skripsi->no_wa }}</td>
                        <td>
                            <a href="{{ asset('storage/' . $skripsi->file_skripsi) }}" target="_blank" class="btn btn-sm btn-outline-primary">Lihat File</a>
                        </td>
                        <td>
                            @if($skripsi->status_skripsi === 'disetujui')
                                <span class="badge bg-success">Disetujui</span>
                            @else
                                <span class="badge bg-warning text-dark">Belum Disetujui</span>
                            @endif
                        </td>
                        <td>
                            <!-- Tombol edit -->
                            <button class="btn btn-sm btn-secondary" data-bs-toggle="modal" data-bs-target="#editModal{{ $skripsi->id }}">
                                Edit
                            </button>

                            <!-- Modal Edit -->
                            <div class="modal fade" id="editModal{{ $skripsi->id }}" tabindex="-1" aria-labelledby="modalLabel{{ $skripsi->id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <form action="{{ route('perpus.skripsi.update.all', $skripsi->id) }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="modalLabel{{ $skripsi->id }}">Edit Data Skripsi</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                                            </div>
                                            <div class="modal-body">
                                                <!-- Nama -->
                                                <div class="mb-3">
                                                    <label class="form-label">Nama</label>
                                                    <input type="text" name="nama" class="form-control" value="{{ $skripsi->user->username ?? '' }}" required>
                                                </div>
                                                <!-- NIM -->
                                                <div class="mb-3">
                                                    <label class="form-label">NIM</label>
                                                    <input type="text" name="nim" class="form-control" value="{{ $skripsi->user->nim ?? '' }}" required>
                                                </div>
                                                <!-- Judul Skripsi -->
                                                <div class="mb-3">
                                                    <label class="form-label">Judul Skripsi</label>
                                                    <input type="text" name="judul_skripsi" class="form-control" value="{{ $skripsi->judul_skripsi }}" required>
                                                </div>
                                                <!-- Email -->
                                                <div class="mb-3">
                                                    <label class="form-label">Email</label>
                                                    <input type="email" name="email" class="form-control" value="{{ $skripsi->email }}" required>
                                                </div>
                                                <!-- Nomor WA -->
                                                <div class="mb-3">
                                                    <label class="form-label">Nomor WhatsApp</label>
                                                    <input type="text" name="no_wa" class="form-control" value="{{ $skripsi->no_wa }}" required>
                                                </div>
                                                <!-- File -->
                                                <!-- <div class="mb-3">
                                                    <label class="form-label">Upload File Baru (PDF)</label>
                                                    <input type="file" name="file_skripsi" class="form-control" accept="application/pdf">
                                                    <small class="text-muted">Kosongkan jika tidak ingin mengganti file.</small>
                                                </div> -->
                                                <!-- Status Persetujuan -->
                                                <div class="mb-3">
                                                    <label class="form-label">Status Persetujuan</label>
                                                    <select name="status_skripsi" class="form-select">
                                                        <option value="belum disetujui" {{ $skripsi->status_skripsi === 'belum disetujui' ? 'selected' : '' }}>Belum Disetujui</option>
                                                        <option value="disetujui" {{ $skripsi->status_skripsi === 'disetujui' ? 'selected' : '' }}>Disetujui</option>
                                                    </select>
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
                        </td>

                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center">Belum ada data skripsi dikumpulkan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@include('layouts.footer')

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
