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

    <!-- Wrapper untuk konten utama -->
    <div class="container flex-grow-1 my-4">
        <div class="d-flex align-items-center mb-3">
            <h1 class="me-3 mb-0">PROPOSAL SKRIPSI</h1>
            <span class="text-muted">Daftar Proposal Skripsi</span>
        </div>
        <hr>
        <div class="row mb-3">
            <!-- <div class="col-md-12 d-flex justify-content-end align-items-center">
                <a href="{{ route('create-proposal') }}" class="btn btn-success">
                    <i class="fas fa-plus"></i> Tambah
                </a>
            </div> -->
            <div class="col-md-12 d-flex justify-content-end align-items-center">
                @if ($proposals->count() == 0)
                    <a href="{{ route('create-proposal') }}" class="btn btn-success">
                        <i class="fas fa-plus"></i> Tambah Proposal
                    </a>
                @else
                    <button class="btn btn-secondary" disabled>
                        <i class="fas fa-lock"></i> Proposal Sudah Diajukan
                    </button>
                @endif
            </div>
        </div>

        <!-- Notifikasi Sukses -->
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <div class="container mt-4">
            <div class="row row-cols-1 g-4">
                @foreach ($proposals as $proposal)
                    <div class="col">
                        <div class="card shadow-lg border-0 h-100 d-flex flex-column">
                            <div class="card-body flex-grow-1">
                                <h5 class="card-title fw-bold">{{ $proposal->script_title }}</h5>
                                <h6 class="text-muted">
                                    Nama: {{ $proposal->name }} |
                                    Kelas: {{ $proposal->class }} |
                                    Tahun Akademik: {{ $proposal->tahun_akademik }}
                                </h6>
                               <p class="text-muted mb-1">
                                    <small>Tanggal Pengajuan: {{ \Carbon\Carbon::parse($proposal->submission_date)->translatedFormat('d F Y') }}</small>
                                </p>
                                <!-- Kategori Proposal -->
                                @if($proposal->kategoriProposal)
                                    <p class="mb-1">
                                        <span class="badge bg-info text-dark">
                                            {{ $proposal->kategoriProposal->nama_kategori }}
                                        </span>
                                    </p>
                                @endif
                                <!-- Status -->
                                <span class="badge bg-{{ $proposal->status == 'Diterima' ? 'success' : ($proposal->status == 'Menunggu' ? 'warning' : 'danger') }}">
                                    {{ $proposal->status }}
                                </span>
                                <!-- Abstrak -->
                                <p class="card-text mt-2">
                                    {!! Str::limit(strip_tags($proposal->abstract), 120, '...') !!}
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#modalAbstract{{ $proposal->id }}" class="text-primary">Baca selengkapnya</a>
                                </p>
                                <!-- Link Dokumen -->
                                @if($proposal->link)
                                    <a href="{{ $proposal->link }}" target="_blank" class="btn btn-sm btn-outline-success">
                                        <i class="fas fa-link"></i> Lihat Dokumen
                                    </a>
                                @endif
                                <!-- Tombol untuk melihat komentar -->
                                <div class="mt-3">
                                    <button class="btn btn-link p-0 text-primary" data-bs-toggle="collapse" data-bs-target="#commentSection{{ $proposal->id }}">
                                        Lihat Komentar
                                    </button>
                                </div>
                                <!-- Bagian Komentar (Collapse) -->
                                <div class="collapse mt-2" id="commentSection{{ $proposal->id }}">
                                    <h6>Komentar:</h6>
                                    @if($proposal->comments->isEmpty())
                                        <p class="text-muted">Belum ada komentar.</p>
                                    @else
                                        <ul class="list-group">
                                            @foreach($proposal->comments as $comment)
                                                <li class="list-group-item">{{ $comment->comment }}</li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </div>
                            </div>
                            <!-- Footer Card -->
                            <div class="card-footer bg-white border-0 text-center mt-auto">
                                <a href="{{ route('proposals.edit', $proposal->id) }}" class="btn btn-outline-primary btn-sm me-2">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <form action="{{ route('proposals.destroy', $proposal->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus proposal ini?')">
                                        <i class="fas fa-trash"></i> Hapus
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Modal untuk Abstrak -->
                    <div class="modal fade" id="modalAbstract{{ $proposal->id }}" tabindex="-1" aria-labelledby="modalLabel{{ $proposal->id }}" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title fw-bold" id="modalLabel{{ $proposal->id }}">{{ $proposal->script_title }}</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p class="text-muted"><small>Tanggal Pengajuan: {{ $proposal->submission_date }}</small></p>
                                    <p>{!! $proposal->abstract !!}</p>
                                    @if($proposal->link)
                                        <a href="{{ $proposal->link }}" target="_blank" class="btn btn-outline-success mt-3">
                                            <i class="fas fa-link"></i> Lihat Dokumen Lengkap
                                        </a>
                                    @endif
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

    </div> <!-- Akhir wrapper konten -->

    @include('layouts.footer')

    <!-- Bootstrap JS and Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>
</html>
