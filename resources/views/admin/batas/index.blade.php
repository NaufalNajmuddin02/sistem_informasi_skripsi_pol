<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Atur Batas Waktu Pengajuan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="d-flex flex-column min-vh-100">
    @include('layouts.navbar-admin')

    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-lg-10">

                <div class="text-left mb-4">
                    <h2 class="fw-bold">Atur Batas Waktu Pengajuan Seminar Proposal</h2>
                    <p class="text-muted">Gunakan form di bawah ini untuk mengatur batas waktu pengajuan per tahun akademik.</p>
                </div>
                <hr>

                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <!-- Form Input -->
                <div class="card shadow-sm mb-5 border-0">
                    <div class="card-header bg-danger text-white">
                        <i class="fas fa-calendar-plus me-2"></i> Tambah / Perbarui Batas Waktu
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.batas.store') }}">
                            @csrf
                            <div class="row g-3 align-items-end">
                                <div class="col-md-5">
                                    <label for="tahun_akademik" class="form-label">Tahun Akademik</label>
                                    <input type="text" name="tahun_akademik" id="tahun_akademik" class="form-control"
                                           value="{{ now()->format('Y') . '/' . now()->addYear()->format('Y') }}" required>
                                </div>
                                <div class="col-md-5">
                                    <label for="tanggal_batas" class="form-label">Tanggal Batas Pengajuan</label>
                                    <input type="date" id="tanggal_batas" name="tanggal_batas" class="form-control" required>
                                </div>
                                <div class="col-md-2 d-grid">
                                    <button type="submit" class="btn btn-danger">
                                        <i class="fas fa-save me-1"></i> Simpan
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Table -->
                <div class="card shadow-sm border-0">
                    <!-- Header: Merah -->
                    <div class="card-header bg-danger text-white">
                        <i class="fas fa-clock me-2"></i> Daftar Batas Waktu yang Sudah Ditentukan
                    </div>

                    <!-- Body: Putih -->
                    <div class="card-body p-0 bg-white">
                        <div class="table-responsive">
                            <table class="table table-bordered mb-0">
                                <thead class="table-light text-center">
                                    <tr>
                                        <th style="width: 5%;">No</th>
                                        <th style="width: 45%;">Tahun Akademik</th>
                                        <th style="width: 50%;">Batas Waktu Pengajuan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($batasList as $index => $batas)
                                        <tr>
                                            <td class="text-center">{{ $index + 1 }}</td>
                                            <td>{{ $batas->tahun_akademik }}</td>
                                            <td>{{ \Carbon\Carbon::parse($batas->tanggal_batas)->translatedFormat('d F Y') }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3" class="text-center text-muted">Belum ada data batas waktu.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    @include('layouts.footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
