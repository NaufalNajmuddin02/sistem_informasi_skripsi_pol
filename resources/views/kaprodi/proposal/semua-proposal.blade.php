<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Semua Proposal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body class="d-flex flex-column min-vh-100">
    @include('layouts.navbar-kaprodi')

    <div class="container mt-4">
        <h1 class="mb-4">Daftar Semua Proposal</h1>
        <hr>
        {{-- Filter dan Search --}}
        <form method="GET" class="row g-3 mb-4">
            {{-- Baris 1: Tahun Akademik, Nama Dosen, Status --}}
            <div class="col-md-4">
                <label for="tahun_akademik" class="form-label">Pilih Filter Tahun Akademik</label>
                <select name="tahun_akademik" id="tahun_akademik" class="form-select">
                    <option value="">Semua Tahun</option>
                    @foreach ($listTahunAkademik as $tahun)
                        <option value="{{ $tahun }}" {{ request('tahun_akademik') == $tahun ? 'selected' : '' }}>
                            {{ $tahun }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-4">
                <label for="nama_dosen" class="form-label">Pilih FilterNama Dosen</label>
                <input type="text" name="nama_dosen" id="nama_dosen" class="form-control" value="{{ request('nama_dosen') }}">
            </div>

            <div class="col-md-4">
                <label for="status" class="form-label"> Pilih Filter Status</label>
                <select name="status" id="status" class="form-select">
                    <option value="">Semua</option>
                    <option value="Diterima" {{ request('status') == 'Diterima' ? 'selected' : '' }}>Diterima</option>
                    <option value="Ditolak" {{ request('status') == 'Ditolak' ? 'selected' : '' }}>Ditolak</option>
                    <option value="Diproses" {{ request('status') == 'Diproses' ? 'selected' : '' }}>Diproses</option>
                </select>
            </div>

            {{-- Baris 2: Search Nama Mahasiswa --}}
            <div class="col-md-8">
                <label for="search" class="form-label">Cari Nama Mahasiswa</label>
                <input type="text" name="search" id="search" class="form-control" placeholder="Cari..." value="{{ request('search') }}">
            </div>

            {{-- Baris 2: Tombol Aksi --}}
            <div class="col-md-4 d-flex align-items-end gap-2">
                <button type="submit" class="btn btn-primary w-50">
                    <i class="bi bi-funnel-fill me-1"></i> Terapkan Filter
                </button>
                <a href="{{ route('proposal.export', [
                    'tahun_akademik' => $tahunAkademik,
                    'nama_dosen' => $namaDosen,
                    'status' => $status
                ]) }}" class="btn btn-success w-50">
                    <i class="bi bi-file-earmark-excel-fill me-1"></i> Export Excel
                </a>
            </div>
        </form>


        {{-- Tabel Proposal --}}
        @if ($proposals->isEmpty())
            <div class="alert alert-warning text-center">Tidak ada proposal ditemukan.</div>
        @else
            <div class="table-responsive">
                <table class="table table-striped table-bordered align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Nama</th>
                            <th>NIM</th>
                            <th>Dosen Pengampu</th>
                            <th>Kelas</th>
                            <th>Tanggal Pengajuan</th>
                            <th>Judul Skripsi</th>
                            <th>Kategori</th>
                            <th>Tahun Akademik</th>
                            <th>Status</th>
                            <th>Abstrak</th>
                            <th>Link</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($proposals as $proposal)
                            <tr>
                                <td>{{ $proposal->name }}</td>
                                <td>{{ $proposal->user->nim ?? '-' }}</td>
                                <td>{{ $proposal->nama_dosen }}</td>
                                <td>{{ $proposal->class }}</td>
                                <td>{{ \Carbon\Carbon::parse($proposal->submission_date)->format('d/m/Y') }}</td>
                                <td>{{ Str::limit($proposal->script_title, 50) }}</td>
                                <td>{{ $proposal->kategori->nama_kategori ?? '-' }}</td>
                                <td>{{ $proposal->tahun_akademik }}</td>
                                <td>
                                    <span class="badge 
                                        @if($proposal->status == 'Diterima') bg-success 
                                        @elseif($proposal->status == 'Ditolak') bg-danger 
                                        @else bg-secondary @endif">
                                        {{ $proposal->status }}
                                    </span>
                                </td>
                                <td>
                                    <button class="btn btn-sm btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#modalAbstrak{{ $proposal->id }}">
                                        <i class="bi bi-file-text"></i> Lihat Abstrak
                                    </button>

                                    <!-- Modal Abstrak -->
                                    <div class="modal fade" id="modalAbstrak{{ $proposal->id }}" tabindex="-1" aria-labelledby="modalAbstrakLabel{{ $proposal->id }}" aria-hidden="true">
                                        <div class="modal-dialog modal-lg modal-dialog-scrollable">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="modalAbstrakLabel{{ $proposal->id }}">Abstrak - {{ $proposal->name }}</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                                                </div>
                                                <div class="modal-body">
                                                    {!! $proposal->abstract !!}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>

                                <td>
                                    @if ($proposal->link)
                                        <a href="{{ $proposal->link }}" class="btn btn-sm btn-outline-primary" target="_blank">
                                            <i class="bi bi-link-45deg"></i> Link
                                        </a>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            <div class="d-flex justify-content-center mt-3">
                {{ $proposals->appends(request()->query())->links('vendor.pagination.bootstrap-4') }}
            </div>
        @endif
    </div>

    @include('layouts.footer')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
