<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Penilaian Seminar Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />
</head>
<body class="d-flex flex-column min-vh-100">
    @include('layouts.navbar-kaprodi')

    <div class="container my-4">
        <h1 class="mb-4">Penilaian Seminar Mahasiswa</h1>
        <hr>

        <!-- Flash Messages -->
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <!-- Form Search -->
        <form method="GET" action="{{ route('kaprodi.seminar.penilai') }}" class="mb-4">
            <div class="input-group">
                <input type="search" name="search" class="form-control" placeholder="Cari mahasiswa, judul, atau ruangan..." value="{{ request('search') }}" />
                <button class="btn btn-primary" type="submit">
                    <i class="bi bi-search"></i> Cari
                </button>
            </div>
        </form>

        @if($seminars->isEmpty())
            <div class="alert alert-info text-center">Tidak ada jadwal seminar</div>
        @else
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                @foreach($seminars as $seminar)
                    @php
                        $penilaianSaya = $seminar->penilaians->where('dosen_id', Auth::id())->first();
                        $penilaianRekan = $seminar->penilaians->where('dosen_id', '!=', Auth::id())->first();
                    @endphp
                    <div class="col">
                        <div class="card shadow-sm h-100">
                            <div class="card-body d-flex flex-column">

                                <!-- Nama & Judul -->
                                <h5 class="card-title">{{ $seminar->name }}</h5>
                                <h6 class="card-subtitle text-muted mb-3">{{ $seminar->script_title }}</h6>

                                <!-- Informasi Seminar -->
                                <h6><i class="bi bi-info-circle"></i> Informasi Seminar</h6>
                                <hr class="my-2">
                                <dl class="row small">
                                    <dt class="col-sm-5">Status</dt>
                                    <dd class="col-sm-7">
                                        @php
                                            $status = $seminar->status;
                                            $badgeColor = 'secondary';
                                            if ($status === 'Diterima') $badgeColor = 'success';
                                            elseif ($status === 'Menunggu') $badgeColor = 'warning';
                                            elseif ($status === 'Ditolak') $badgeColor = 'danger';
                                        @endphp
                                        <span class="badge bg-{{ $badgeColor }}">{{ $status }}</span>
                                    </dd>

                                    <dt class="col-sm-5">Ruangan</dt>
                                    <dd class="col-sm-7">{{ $seminar->ruangan->nama ?? '-' }}</dd>

                                    <dt class="col-sm-5">Tanggal</dt>
                                    <dd class="col-sm-7">
                                        {{ $seminar->tanggal ? \Carbon\Carbon::parse($seminar->tanggal)->locale('id')->translatedFormat('l, d-m-Y') : '-' }}
                                    </dd>

                                    <dt class="col-sm-5">Jam</dt>
                                    <dd class="col-sm-7">
                                        {{ $seminar->jam ? \Carbon\Carbon::parse($seminar->jam)->format('H:i') : '-' }} - 
                                        {{ $seminar->jam_selesai ? \Carbon\Carbon::parse($seminar->jam_selesai)->format('H:i') : '-' }}
                                    </dd>
                                </dl>

                                <hr class="my-2">

                                <!-- Informasi Penilai -->
                                <h6><i class="bi bi-person-check"></i> Penilai</h6>
                                <dl class="row small mb-2">
                                    <dt class="col-sm-5">Penilai 1</dt>
                                    <dd class="col-sm-7">{{ $seminar->dosen_penilai_1_nama ?? '-' }}</dd>

                                    <dt class="col-sm-5">Penilai 2</dt>
                                    <dd class="col-sm-7">{{ $seminar->dosen_penilai_2_nama ?? '-' }}</dd>
                                </dl>

                                <hr class="my-2">

                                <!-- Nilai -->
                                <h6><i class="bi bi-bar-chart"></i> Nilai</h6>
                                <dl class="row small">
                                    @if($penilaianSaya)
                                        <dt class="col-sm-5">Nilai Anda</dt>
                                        <dd class="col-sm-7">{{ number_format($penilaianSaya->nilai_total) }}</dd>
                                    @endif

                                    @if($penilaianRekan)
                                        <dt class="col-sm-5">Nilai Rekan</dt>
                                        <dd class="col-sm-7">{{ number_format($penilaianRekan->nilai_total) }}</dd>
                                    @endif

                                    @if($seminar->nilai)
                                        <dt class="col-sm-5">Nilai Akhir</dt>
                                        <dd class="col-sm-7"><strong>{{ number_format($seminar->nilai) }}</strong></dd>
                                    @endif
                                </dl>

                                <!-- Tombol Nilai -->
                                @if(Auth::id() === $seminar->dosen_penilai_1 || Auth::id() === $seminar->dosen_penilai_2)
                                    <button class="btn btn-outline-primary mt-auto" data-bs-toggle="modal" data-bs-target="#modalNilai{{ $seminar->id }}">
                                        <i class="bi bi-pencil-square"></i> {{ $penilaianSaya ? 'Edit Nilai' : 'Nilai' }}
                                    </button>
                                @else
                                    <span class="text-muted mt-auto small">Bukan penilai</span>
                                @endif
                            </div>
                        </div>
                    </div>


                    <!-- Modal -->
                    @if(Auth::id() === $seminar->dosen_penilai_1 || Auth::id() === $seminar->dosen_penilai_2)
                        @php $existing = $penilaianSaya; @endphp
                        <div class="modal fade" id="modalNilai{{ $seminar->id }}" tabindex="-1" aria-labelledby="modalNilaiLabel{{ $seminar->id }}" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <form action="{{ $existing ? route('penilaian.update.kaprodi', $seminar->id) : route('penilaian.store.kaprodi', $seminar->id) }}" method="POST">
                                        @csrf
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="modalNilaiLabel{{ $seminar->id }}">Form Penilaian Seminar</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <input type="hidden" name="peran_penilai" value="{{ Auth::id() === $seminar->dosen_penilai_1 ? 'penilai_1' : 'penilai_2' }}">

                                            @php
                                                $fields = [
                                                    'judul_penelitian' => 'Judul Penelitian (10%)',
                                                    'pendahuluan' => 'Pendahuluan (15%)',
                                                    'metodologi' => 'Metodologi Penelitian (15%)',
                                                    'solusi' => 'Solusi yang Ditawarkan (25%)',
                                                    'kesiapan_produk' => 'Kesiapan Produk Penelitian (35%)',
                                                ];
                                            @endphp

                                            @foreach($fields as $name => $label)
                                                <div class="mb-3">
                                                    <label class="form-label">{{ $label }}</label>
                                                    <input type="number" name="{{ $name }}" class="form-control" min="1" max="5" required
                                                        value="{{ old($name, $existing->$name ?? '') }}">
                                                    <small class="form-text text-muted">
                                                        Keterangan: 1 = Sangat Kurang, 2 = Kurang, 3 = Cukup, 4 = Baik, 5 = Sangat Baik
                                                    </small>
                                                </div>
                                            @endforeach
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                            <button type="submit" class="btn btn-primary">
                                                <i class="bi bi-check-circle"></i> {{ $existing ? 'Update Nilai' : 'Simpan Nilai' }}
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>

            <div class="mt-4 d-flex justify-content-center">
                {{ $seminars->withQueryString()->links() }}
            </div>
        @endif
    </div>

    @include('layouts.footer')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
