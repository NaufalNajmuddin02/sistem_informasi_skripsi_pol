<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SISTA - Proposal Skripsi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>
<body class="d-flex flex-column min-vh-100">  
    @include('layouts.navbar')

    <!-- Main Content -->
    <div class="container flex-grow-1 my-4">
        <div class="d-flex align-items-center mb-3">
            <h1 class="me-3 mb-0">SEMINAR PROPOSAL</h1>
            <span class="text-muted">Daftar Seminar Proposal</span>
        </div>
        <hr>
        <div class="row mb-3">
            <div class="col-md-12 d-flex justify-content-end align-items-center">
                @if ($seminars->count() == 0)
                    <a href="{{ route('create-seminar') }}" class="btn btn-success">
                        <i class="fas fa-plus"></i> Tambah Seminar
                    </a>
                @else
                    <button class="btn btn-secondary" disabled>
                        <i class="fas fa-lock"></i> Seminar Sudah Diajukan
                    </button>
                @endif
            </div>
        </div>
        
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif


        <!-- Daftar Proposal -->
        <div class="container mt-4">
            <div class="row row-cols-1 g-4">
                @foreach ($seminars as $seminar)
                    <div class="col">
                        <div class="card shadow-lg border-0 h-100 d-flex flex-column">
                            <div class="card-body flex-grow-1">
                                <!-- Judul Skripsi -->
                                <h5 class="card-title fw-bold">{{ $seminar->script_title }}</h5>

                                <!-- Informasi Mahasiswa -->
                                <h6 class="text-muted mb-2">
                                    Nama: {{ $seminar->name }} |
                                    Kelas: {{ $seminar->class }} |
                                    Tahun Akademik: {{ $seminar->tahun_akademik }}
                                </h6>

                                <!-- Tanggal Pengajuan -->
                                <p class="text-muted mb-1">
                                    <small>
                                        Tanggal Pengajuan: {{ \Carbon\Carbon::parse($seminar->submission_date)->translatedFormat('d F Y') }}
                                    </small>
                                </p>

                                <!-- Kategori Proposal -->
                                @if($seminar->kategoriProposal)
                                    <p class="text-muted mb-1"><small>Kategori Proposal:</small></p>
                                    <p class="mb-1">
                                        <span class="badge bg-info text-dark">
                                            {{ $seminar->kategoriProposal->nama_kategori }}
                                        </span>
                                    </p>
                                @endif

                                <!-- Status -->
                                <p class="text-muted mb-1"><small>Status:</small></p>
                                <p>
                                    <span class="badge bg-{{ $seminar->status == 'Diterima' ? 'success' : ($seminar->status == 'Menunggu' ? 'warning' : 'danger') }}">
                                        {{ $seminar->status ?? 'Menunggu' }}
                                    </span>
                                </p>


                                <!-- Nomor HP -->
                                <p class="text-muted mb-1"><small>No. HP: {{ $seminar->no_hp }}</small></p>

                                <!-- Link Dokumen -->
                                @if($seminar->link)
                                    <div class="mt-auto">
                                        <a href="{{ $seminar->link }}" target="_blank" class="btn btn-sm btn-outline-success">
                                            <i class="fas fa-link"></i> Lihat Dokumen
                                        </a>
                                    </div>
                                @endif
                            </div>

                            <!-- Footer Card -->
                            <div class="card-footer bg-white border-0 text-center">
                                <a href="{{ route('seminar.edit', $seminar->id) }}" class="btn btn-outline-primary btn-sm me-2">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <form action="{{ route('seminar.destroy', $seminar->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus seminar ini?')">
                                        <i class="fas fa-trash"></i> Hapus
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </div>

    @include('layouts.footer')

    <!-- Bootstrap JS and Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>
</html>