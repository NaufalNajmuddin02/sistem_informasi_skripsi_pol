<!DOCTYPE html>
<html>
<head>
    <title>Rekap Bimbingan Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body class="d-flex flex-column min-vh-100">

    @include('layouts.navbar-kaprodi')

    <div class="container my-5">
        <h2 class="mb-4">Rekap Bimbingan Mahasiswa</h2>
        <hr>

        <form method="GET" action="{{ route('rekap.bimbingan') }}" class="row g-3 mb-4">
            <div class="col-md-3">
                <label for="tahun_akademik" class="form-label">Tahun Akademik</label>
                <select name="tahun_akademik" id="tahun_akademik" class="form-select">
                    <option value="">Semua</option>
                    @foreach($tahunList as $tahun)
                        <option value="{{ $tahun }}" {{ $tahun == $tahunAkademik ? 'selected' : '' }}>{{ $tahun }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <label for="keyword" class="form-label">Cari Nama Mahasiswa</label>
                <input type="text" name="keyword" id="keyword" class="form-control" placeholder="Nama Mahasiswa" value="{{ $keyword }}">
            </div>
            <div class="col-md-6 d-flex align-items-end">
                <button type="submit" class="btn btn-primary me-2">
                    <i class="bi bi-funnel-fill me-1"></i> Tampilkan
                </button>
                <a href="{{ route('rekap.bimbingan.export', ['tahun_akademik' => $tahunAkademik]) }}" class="btn btn-success">
                    <i class="bi bi-file-earmark-excel-fill me-1"></i> Export Excel
                </a>
            </div>
        </form>


        <table class="table table-bordered table-striped">
            <thead class="table-light">
                <tr>
                    <th>Nama Mahasiswa</th>
                    <th>Kelas</th>
                    <th>Judul</th>
                    <th>Dosen Pembimbing 1</th>
                    <th>Jumlah Bimbingan 1</th>
                    <th>Dosen Pembimbing 2</th>
                    <th>Jumlah Bimbingan 2</th>
                    <th>Tahun Akademik</th>
                </tr>
            </thead>
            <tbody>
                @foreach($seminars as $seminar)
                    <tr>
                        <td>{{ $seminar->name }}</td>
                        <td>{{ $seminar->class }}</td>
                        <td>{{ $seminar->script_title }}</td>
                        <td>{{ $seminar->dosen_penilai_1_nama }}</td>
                        <td>{{ $seminar->bimbingan->where('nama_dosen', $seminar->dosen_penilai_1_nama)->count() }}</td>
                        <td>{{ $seminar->dosen_penilai_2_nama }}</td>
                        <td>{{ $seminar->bimbingan->where('nama_dosen', $seminar->dosen_penilai_2_nama)->count() }}</td>
                        <td>{{ $seminar->tahun_akademik }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="mt-3">
            {{ $seminars->appends(['tahun_akademik' => $tahunAkademik])->links() }}
        </div>

    </div>
    @include('layouts.footer')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
