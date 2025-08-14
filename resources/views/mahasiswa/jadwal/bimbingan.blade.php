<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jadwal Bimbingan Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{asset('css/mahasiswa/jadwal/bimbingan.css')}}">
</head>

<body class="d-flex flex-column min-vh-100">
    @include('layouts.navbar')

    <div class="container mt-4">
        <h4 class="mb-3">Jadwal Bimbingan Mahasiswa</h4>

        @php
            use Carbon\Carbon;
            $today = Carbon::today()->format('Y-m-d'); // Ambil tanggal hari ini
            $filteredJadwals = $jadwals->filter(function($jadwal) {
                return Carbon::parse($jadwal->tanggal)->format('Y-m-d') === Carbon::today()->format('Y-m-d');
            });
        @endphp


        @if($filteredJadwals->isNotEmpty())
            <div class="row g-4">
                @foreach($filteredJadwals as $jadwal)
                <div class="col-12">
                    <div class="card shadow-lg border-0 jadwal-card overflow-hidden transition-all hover:shadow-xl" style="transition: all 0.3s ease;">
                        <div class="row g-0">
                            <!-- Left Section with Gradient Background -->
                            <div class="col-md-3 position-relative" style="background: linear-gradient(135deg,rgb(255, 0, 0) 0%, #C850C0 100%);">
                                <div class="text-white text-center py-4 h-100 d-flex flex-column justify-content-center">
                                    <div class="mb-3">
                                        <i class="bi bi-person-circle" style="font-size: 2.5rem;"></i>
                                    </div>
                                    <h5 class="fw-bold mb-2">{{ $jadwal->bimbingan->nama_dosen }}</h5>
                                    <div class="d-flex align-items-center justify-content-center">
                                        <i class="bi bi-calendar-event me-2"></i>
                                        <span>{{ \Carbon\Carbon::parse($jadwal->tanggal)->format('d M Y') }}</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Right Section with Details -->
                            <div class="col-md-9">
                                <div class="card-body p-4">
                                    <div class="row">
                                        <div class="col-md-7">
                                            <!-- Time Details -->
                                            <div class="d-flex align-items-center mb-3">
                                                <div class="p-2 rounded-circle me-3" style="background: rgba(65, 88, 208, 0.1);">
                                                    <i class="bi bi-clock text-primary"></i>
                                                </div>
                                                <div>
                                                    <p class="mb-0 text-muted">Waktu Bimbingan</p>
                                                    <p class="mb-0 fw-bold">{{ $jadwal->waktu_mulai }} - {{ $jadwal->waktu_selesai }}</p>
                                                </div>
                                            </div>

                                            <!-- Location Details -->
                                            <div class="d-flex align-items-center">
                                                <div class="p-2 rounded-circle me-3" style="background: rgba(200, 80, 192, 0.1);">
                                                    <i class="bi bi-geo-alt text-danger"></i>
                                                </div>
                                                <div>
                                                    <p class="mb-0 text-muted">Lokasi</p>
                                                    <p class="mb-0 fw-bold">{{ $jadwal->ruangan }}</p>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Status and Countdown aligned horizontally -->
                                        <div class="col-md-5 d-flex align-items-center justify-content-end">
                                            <div class="status-wrapper text-end">
                                                <div class="d-flex align-items-center gap-2">
                                                    <div class="status badge py-2 px-3" 
                                                        data-mulai="{{ $jadwal->tanggal }} {{ $jadwal->waktu_mulai }}" 
                                                        data-akhir="{{ $jadwal->tanggal }} {{ $jadwal->waktu_selesai }}"
                                                        style="font-size: 0.9rem;">
                                                    </div>
                                                    <div class="countdown fw-bold" 
                                                        data-start="{{ $jadwal->tanggal }} {{ $jadwal->waktu_mulai }}" 
                                                        data-end="{{ $jadwal->tanggal }} {{ $jadwal->waktu_selesai }}"
                                                        style="color:rgb(0, 0, 0); font-size: 0.9rem;">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        @else
            <div class="alert alert-info border-0 shadow-sm text-center p-4">
                <i class="bi bi-info-circle fs-4 mb-2"></i>
                <p class="mb-0">Tidak ada jadwal bimbingan untuk hari ini.</p>
            </div>
        @endif
    </div>

    @include('layouts.footer')

    <script>
        function formatTime(ms) {
            let totalSeconds = Math.floor(ms / 1000);
            let hours = Math.floor(totalSeconds / 3600);
            let minutes = Math.floor((totalSeconds % 3600) / 60);
            let seconds = totalSeconds % 60;

            return `${String(hours).padStart(2, '0')}:${String(minutes).padStart(2, '0')}:${String(seconds).padStart(2, '0')}`;
        }

        function updateCountdown() {
            const now = new Date().getTime();

            document.querySelectorAll(".countdown").forEach(element => {
                const startTime = new Date(element.dataset.start).getTime();
                const endTime = new Date(element.dataset.end).getTime();

                if (now < startTime) {
                    const diff = startTime - now;
                    element.innerHTML = `Mulai dalam: ${formatTime(diff)}`;
                } else if (now >= startTime && now <= endTime) {
                    const diff = endTime - now;
                    element.innerHTML = `Berakhir dalam: ${formatTime(diff)}`;
                } else {
                    element.innerHTML = "Selesai";
                }
            });

            document.querySelectorAll(".status").forEach(element => {
                const startTime = new Date(element.dataset.mulai).getTime();
                const endTime = new Date(element.dataset.akhir).getTime();

                if (now < startTime) {
                    element.innerHTML = "<span class='badge bg-warning'>Belum Dimulai</span>";
                } else if (now >= startTime && now <= endTime) {
                    element.innerHTML = "<span class='badge bg-success'>Sedang Berlangsung</span>";
                } else {
                    element.innerHTML = "<span class='badge bg-secondary'>Selesai</span>";
                }
            });
        }

        setInterval(updateCountdown, 1000);
        updateCountdown();
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
