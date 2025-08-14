<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SISTA Dashboard Dosen Penilai</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel ="stylesheet" href="{{asset('css/dosen_penilai/dashboard.css')}}">
</head>

<body class="d-flex flex-column min-vh-100">

    @include('layouts.navbar-penilai')

    <!-- Main Content -->
    <div class="content">
        <div class="row">
            <div class="col-md-6">
                <!-- Profile Card -->
                <div class="card mb-3" style="background-color: #333; color: white;">
                    <div class="card-body d-flex align-items-center">
                        <img src="{{ auth()->user()->profile_picture ? asset('storage/' . auth()->user()->profile_picture) : asset('images/no_profile.png') }}" 
                             class="rounded-circle me-3" width="50" height="50">
                        <div>
                            <h5 class="mb-1">{{ auth()->user()->username }}</h5>
                            <p class="mb-0">{{ auth()->user()->nim }}</p>
                        </div>
                        <span class="ms-auto badge status-badge">Aktif</span>
                    </div>
                </div>

                <!-- Info Grid -->
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="row mb-2">
                            <div class="col-4">Prodi</div>
                            <div class="col-8 text-end">{{ auth()->user()->prodi }}</div>
                        </div>
                    </div>
                </div>

                <!-- Schedule Table -->
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Jadwal</h5>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>ACARA</th>
                                    <th>WAKTU</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($seminarTerdekat)
                                    <tr>
                                        <td>
                                            {{ strtoupper($seminarTerdekat->jenis_seminar ?? 'Seminar Skripsi') }} <br>
                                            Ruangan: {{ $seminarTerdekat->ruangan->nama ?? '-' }}
                                        </td>
                                        <td>
                                            {{ \Carbon\Carbon::parse($seminarTerdekat->tanggal)->format('d M Y') }} <br>
                                            {{ $seminarTerdekat->jam ?? '-' }} - {{ $seminarTerdekat->jam_selesai ?? '-' }}
                                        </td>
                                    </tr>
                                @else
                                    <tr>
                                        <td colspan="2" class="text-center">TIDAK ADA ACARA</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>


            <div class="col-md-6">
                <!-- Calendar Card -->
                <div class="card mb-3">
                    <div class="card-body d-flex align-items-center">
                        <div>
                            <h2 class="mb-1">KALENDER AKADEMIK</h2>
                            <h5 class="mb-2">{{ $tahunAkademik }}</h5>
                            <p class="mb-0">Semester {{ $semester }}</p>
                        </div>
                        <div class="ms-auto calendar-icon p-2 rounded">
                            📅
                        </div>
                    </div>
                </div>
                

                <!-- Info Box Carousel -->
                <div class="card mt-4 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title mb-4">Informasi Terbaru</h5>
                        <div id="infoTerbaruCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="8000" data-bs-pause="hover">
                            <div class="carousel-inner">
                                @foreach ($infoTerbaru as $index => $info)
                                    <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                                        <div class="px-4 py-3" style="max-height: 200px; overflow-y: auto;">
                                            <h6 class="text-primary fw-semibold">{{ $info->judul }}</h6>
                                            <p class="text-muted mb-0" style="white-space: pre-line;">{!! e($info->konten) !!}</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <button class="carousel-control-prev" type="button" data-bs-target="#infoTerbaruCarousel" data-bs-slide="prev" aria-label="Previous">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#infoTerbaruCarousel" data-bs-slide="next" aria-label="Next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            </button>

                            @if(count($infoTerbaru) > 1)
                                <div class="carousel-indicators mt-3">
                                    @foreach ($infoTerbaru as $index => $info)
                                        <button type="button" data-bs-target="#infoTerbaruCarousel" data-bs-slide-to="{{ $index }}" class="{{ $index == 0 ? 'active' : '' }}" aria-current="{{ $index == 0 ? 'true' : 'false' }}" aria-label="Slide {{ $index + 1 }}"></button>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    @include('layouts.footer')
    <!-- Bootstrap and Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>
</html>