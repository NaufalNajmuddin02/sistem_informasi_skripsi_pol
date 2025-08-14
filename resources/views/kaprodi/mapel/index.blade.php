<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>SISTA - Daftar Dosen Mapel Proposal Skripsi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />
</head>
<body class="d-flex flex-column min-vh-100">
    @include('layouts.navbar-kaprodi')

    <!-- Main Content -->
    <div class="container mt-4">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2 class="card-title m-0">Daftar Dosen Mata kulian Proposal Skripsi</h2>
                    <a href="{{ route('mapel.create') }}" class="btn btn-primary">
                        <i class="bi bi-plus-lg me-1"></i> Tambah
                    </a>
                </div>
                <hr class="mb-4">
                <!-- Filter & Pencarian -->
                <form method="GET" class="row row-cols-lg-auto g-3 align-items-center mb-3">
                    <div class="col-12">
                        <label for="tahun_akademik" class="form-label">Tahun Akademik:</label>
                        <select name="tahun_akademik" id="tahun_akademik" class="form-select">
                            <option value="">-- Semua Tahun --</option>
                            @foreach ($tahunAkademikList as $tahun)
                                <option value="{{ $tahun }}" {{ $tahunAkademikFilter == $tahun ? 'selected' : '' }}>
                                    {{ $tahun }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-12">
                        <label for="search" class="form-label">Cari Dosen/Kelas:</label>
                        <input type="text" name="search" id="search" class="form-control" placeholder="Cari..." value="{{ $search }}">
                    </div>
                    <div class="col-12">
                        <label class="form-label d-block">&nbsp;</label>
                        <button type="submit" class="btn btn-outline-primary">
                            <i class="bi bi-search"></i> Cari
                        </button>
                        <a href="{{ route('mapel.index') }}" class="btn btn-outline-secondary">
                            <i class="bi bi-arrow-clockwise"></i> Reset
                        </a>
                    </div>
                </form>


                <!-- Notifikasi Sukses -->
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <!-- Tabel Data Mata Kuliah -->
                <div class="table-responsive">
                    <table class="table table-bordered table-hover align-middle">
                        <thead class="table-primary">
                            <tr>
                                <!-- <th style="width: 5%;">No</th> -->
                                <th>Nama Dosen</th>
                                <th>Nama Mata Kuliah</th>
                                <th>Kelas</th>
                                <th>Tahun Akademik</th>
                                <th style="width: 15%;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($mapelList as $index => $mapel)
                                <tr>
                                    <!-- <td>{{ $index + 1 }}</td> -->
                                    <td>{{ $mapel->dosen->username ?? '-' }}</td>
                                    <td>{{ $mapel->nama_mapel }}</td>
                                    <td>{{ $mapel->kelas }}</td>
                                    <td>{{ $mapel->tahun_akademik }}</td>
                                    <td>
                                        <a href="{{ route('mapel.edit', $mapel->id) }}" class="btn btn-sm btn-warning me-1" title="Edit">
                                            <i class="bi bi-pencil-square">Edit</i>
                                        </a>
                                        <form action="{{ route('mapel.delete', $mapel->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus?')">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-danger" title="Hapus">
                                                <i class="bi bi-trash">Hapus</i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">Belum ada mata kuliah yang ditambahkan.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <!-- Pagination -->
                    <div class="mt-3">
                        {{ $mapelList->withQueryString()->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('layouts.footer')

    <!-- Bootstrap JS dan Bootstrap Icons sudah di-load di head -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
