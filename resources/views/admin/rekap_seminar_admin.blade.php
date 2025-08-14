<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Rekap Seminar</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="d-flex flex-column min-vh-100">

    @include('layouts.navbar-admin')

    <div class="container my-5">
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-body">
                <h2 class="mb-4 text-left">Rekap Seminar Mahasiswa</h2>
                <hr>

                <form method="GET" action="{{ route('rekap.seminar.admin') }}" class="row g-3 align-items-end">
                    <div class="col-md-4">
                        <label for="tahun_akademik" class="form-label">Filter Tahun Akademik</label>
                        <select name="tahun_akademik" id="tahun_akademik" class="form-select">
                            <option value="">Semua</option>
                            @foreach($tahunList as $tahun)
                                <option value="{{ $tahun }}" {{ $tahun == $tahunAkademik ? 'selected' : '' }}>{{ $tahun }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label for="keyword" class="form-label">Cari Nama Mahasiswa</label>
                        <input type="text" name="keyword" id="keyword" value="{{ $keyword }}" class="form-control" placeholder="Nama Mahasiswa">
                    </div>

                    <div class="col-md-4 d-flex gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-funnel-fill me-1"></i> Tampilkan
                        </button>
                        <a href="{{ route('rekap.seminar.export.admin', ['tahun_akademik' => $tahunAkademik]) }}" class="btn btn-success">
                            <i class="bi bi-file-earmark-excel-fill me-1"></i> Export Excel
                        </a>
                    </div>
                </form>

            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle">
                <thead class="table-light text-center">
                    <tr>
                        <th>Nama Mahasiswa</th>
                        <th>Kelas</th>
                        <th>Judul</th>
                        <th>Dosen 1</th>
                        <th>Dosen 2</th>
                        <th>Ruangan</th>
                        <th>Tanggal</th>
                        <th>Jam</th>
                        <th>Selesai</th>
                        <th>Kategori</th>
                        <th>Status</th>
                        <th>Nilai Akhir</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($seminars as $seminar)
                        @php
                            $penilaian1 = $seminar->penilaians->where('peran_penilai', 'dosen1')->first();
                            $penilaian2 = $seminar->penilaians->where('peran_penilai', 'dosen2')->first();
                        @endphp
                        <tr>
                            <td>{{ $seminar->name ?? '-' }}</td>
                            <td>{{ $seminar->class }}</td>
                            <td>{{ $seminar->script_title }}</td>
                            <td>{{ $seminar->dosen_penilai_1_nama ?? '-' }}</td>
                            <td>{{ $seminar->dosen_penilai_2_nama ?? '-' }}</td>
                            <td>{{ $seminar->ruangan }}</td>
                            <td>{{ $seminar->tanggal }}</td>
                            <td>{{ $seminar->jam }}</td>
                            <td>{{ $seminar->jam_selesai }}</td>
                            <td>{{ $seminar->kategoriProposal->nama_kategori ?? '-' }}</td>
                            <td>{{ $seminar->status ?? '-' }}</td>
                            <td>{{ $seminar->nilai ?? '-' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="12" class="text-center text-muted py-4">
                                Tidak ada data seminar ditemukan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="mt-3">
                {{ $seminars->appends(['tahun_akademik' => $tahunAkademik,])->links() }}
            </div>

        </div>
    </div>

    @include('layouts.footer')

    <!-- Bootstrap Icons (optional, for icons in buttons) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
