<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Jadwal Penilaian Seminar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <style>
        .card-upcoming {
            background-color: #fff3cd; /* kuning muda */
        }
        .card-ongoing {
            background-color: #d1e7dd; /* hijau muda */
        }
        .countdown-text {
            font-weight: 600;
            font-size: 1.1rem;
        }
        /* Kontrol Carousel */
        .carousel-control-prev-icon,
        .carousel-control-next-icon {
            background-color: rgba(0,0,0,0.5);
            border-radius: 50%;
        }
    </style>
</head>
<body class="d-flex flex-column min-vh-100">
    @include('layouts.navbar-kaprodi')

    <div class="container my-4">
        <div class="d-flex flex-wrap align-items-center mb-3">
            <h1 class="me-3 mb-0">Jadwal Seminar Proposal</h1>
            <span class="text-muted">Jadwal anda menguji seminar proposal mahasiswa</span>
        </div>
        <hr>

        @if($seminars->isEmpty())
            <div class="alert alert-info text-center">Tidak ada jadwal seminar</div>
        @else
            @php
                // Bagi seminar menjadi grup per 6 untuk carousel
                $chunks = $seminars->chunk(6);
            @endphp

            <div id="seminarCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="false">
                <div class="carousel-inner">
                    @foreach($chunks as $chunkIndex => $chunk)
                    <div class="carousel-item {{ $chunkIndex == 0 ? 'active' : '' }}">
                        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-3">
                            @foreach($chunk as $seminar)
                                @php
                                    $now = now();
                                    $start = \Carbon\Carbon::parse($seminar->tanggal . ' ' . $seminar->jam);
                                    $end = \Carbon\Carbon::parse($seminar->tanggal . ' ' . $seminar->jam_selesai);

                                    if ($now->between($start, $end)) {
                                        $cardClass = 'card-ongoing';
                                        $badge = '<span class="badge bg-success">Sedang Berlangsung</span>';
                                    } elseif ($now->lt($start)) {
                                        $cardClass = 'card-upcoming';
                                        $badge = '<span class="badge bg-warning text-dark">Akan Segera Dimulai</span>';
                                    } else {
                                        // Jika sudah selesai, jangan tampilkan card (seharusnya sudah disaring di controller)
                                        continue;
                                    }

                                    // Format tanggal dan waktu
                                    $tanggalFormatted = $seminar->tanggal ? \Carbon\Carbon::parse($seminar->tanggal)->locale('id')->translatedFormat('l, d-m-Y') : '-';
                                    $jamMulaiFormatted = $seminar->jam ? \Carbon\Carbon::parse($seminar->jam)->format('H:i') : '-';
                                    $jamSelesaiFormatted = $seminar->jam_selesai ? \Carbon\Carbon::parse($seminar->jam_selesai)->format('H:i') : '-';
                                @endphp
                                <div class="col">
                                    <div class="card {{ $cardClass }} shadow-sm h-100">
                                        <div class="card-body d-flex flex-column">
                                            <h5 class="card-title">{{ $seminar->name }}</h5>
                                            <h6 class="card-subtitle mb-2 text-muted">{{ $seminar->script_title }}</h6>
                                            <p class="card-text mb-1">
                                                <strong>Ruangan:</strong> {{ $seminar->ruangan->nama ?? '-' }}<br>
                                                <strong>Tanggal:</strong> {{ $tanggalFormatted }}<br>
                                                <strong>Waktu:</strong> {{ $jamMulaiFormatted }} - {{ $jamSelesaiFormatted }}<br>
                                                <strong>Penilai 1:</strong> {{ $seminar->dosen_penilai_1_nama ?? '-' }}<br>
                                                <strong>Penilai 2:</strong> {{ $seminar->dosen_penilai_2_nama ?? '-' }}
                                            </p>
                                            <div class="mt-auto">
                                                {!! $badge !!}
                                                <p class="countdown-text mt-2" 
                                                   data-start="{{ $seminar->tanggal }}T{{ $seminar->jam }}" 
                                                   data-end="{{ $seminar->tanggal }}T{{ $seminar->jam_selesai }}">
                                                   <!-- Countdown muncul di sini -->
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    @endforeach
                </div>

                @if($seminars->count() > 6)
                    <button class="carousel-control-prev" type="button" data-bs-target="#seminarCarousel" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#seminarCarousel" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                @endif
            </div>
        @endif
    </div>

    @include('layouts.footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Fungsi update countdown semua countdown-text
        function updateCountdowns() {
            const countdownEls = document.querySelectorAll('.countdown-text');
            const now = new Date().getTime();

            countdownEls.forEach(el => {
                const startTime = new Date(el.dataset.start).getTime();
                const endTime = new Date(el.dataset.end).getTime();

                if (now < startTime) {
                    const distance = startTime - now;
                    const hours = Math.floor(distance / (1000 * 60 * 60));
                    const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                    const seconds = Math.floor((distance % (1000 * 60)) / 1000);
                    el.textContent = `Dimulai dalam: ${hours}j ${minutes}m ${seconds}d`;
                    el.classList.remove('text-primary', 'text-danger');
                    el.classList.add('text-success');
                } else if (now >= startTime && now <= endTime) {
                    const distance = endTime - now;
                    const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                    const seconds = Math.floor((distance % (1000 * 60)) / 1000);
                    el.textContent = `Sedang berlangsung. Sisa waktu: ${minutes}m ${seconds}d`;
                    el.classList.remove('text-success', 'text-danger');
                    el.classList.add('text-primary');
                } else {
                    el.textContent = "Seminar telah berakhir";
                    el.classList.remove('text-success', 'text-primary');
                    el.classList.add('text-danger');
                }
            });
        }

        setInterval(updateCountdowns, 1000);
        updateCountdowns(); 
    </script>
</body>
</html>
