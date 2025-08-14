<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SISTA - Jadwal Seminar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>
<body class="d-flex flex-column min-vh-100">

    @include('layouts.navbar')

    <!-- Main Content -->
    <div class="container my-4">
        <div class="d-flex align-items-center mb-3">
            <h1 class="me-3 mb-0">JADWAL SEMINAR</h1>
        </div>
        <hr>
        <div class="card shadow-sm mt-3">
            <div class="card-body">
                <div class="d-flex align-items-center mb-3">
                    <h4 class="me-2"><i class="fas fa-calendar-alt text-primary"></i> Jadwal Seminar</h4>
                    <div class="flex-grow-1 border-bottom border-2 border-primary"></div>
                </div>
                @php
                    use Carbon\Carbon;

                    $now = Carbon::now();
                    $start = Carbon::parse($seminar->tanggal . ' ' . $seminar->jam);
                    $end = Carbon::parse($seminar->tanggal . ' ' . $seminar->jam_selesai);
                    $isBefore = $now->lt($start);
                    $isDuring = $now->between($start, $end);
                @endphp

                @if($seminar)
                    <div class="p-3 mb-2 rounded {{ $isDuring ? 'bg-warning-subtle' : 'bg-light' }}">
                        <p><i class="fas fa-door-open"></i> <strong>Ruangan:</strong> {{ $seminar->ruangan->nama ?? '-' }}</p>
                        <p><i class="fas fa-user-tie"></i> <strong>Penilai 1:</strong> {{ $seminar->dosen_penilai_1_nama ?? '-' }}</p>
                        <p><i class="fas fa-user-tie"></i> <strong>Penilai 2:</strong> {{ $seminar->dosen_penilai_2_nama ?? '-' }}</p>
                        <p><i class="fas fa-calendar-day"></i> <strong>Tanggal:</strong> {{ $seminar->tanggal ? Carbon::parse($seminar->tanggal)->locale('id')->translatedFormat('l, d-m-Y') : '-' }}</p>
                        <p><i class="fas fa-clock"></i> <strong>Jam:</strong> {{ $seminar->jam ? Carbon::parse($seminar->jam)->format('H:i') : '-' }} - {{ $seminar->jam_selesai ? Carbon::parse($seminar->jam_selesai)->format('H:i') : '-' }}</p>
                        <p id="countdown" class="mt-2 fw-bold fs-4"></p>
                    </div>
                @else
                    <div class="text-center text-muted p-4"><i class="fas fa-exclamation-circle"></i> Belum ada jadwal seminar</div>
                @endif

            </div>
        </div>
    </div>

    @include('layouts.footer')

    <!-- Bootstrap JS and Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    <script>
        const countdownEl = document.getElementById("countdown");

        const startTime = new Date('{{ $seminar->tanggal }}T{{ $seminar->jam }}').getTime();
        const endTime = new Date('{{ $seminar->tanggal }}T{{ $seminar->jam_selesai }}').getTime();

        function updateCountdown() {
            const now = new Date().getTime();

            if (now < startTime) {
                const distance = startTime - now;
                const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                const seconds = Math.floor((distance % (1000 * 60)) / 1000);

                countdownEl.textContent = `Seminar dimulai dalam: ${hours}j ${minutes}m ${seconds}d`;
                countdownEl.className = "mt-2 fw-bold fs-4 text-success"; // hijau saat belum mulai

            } else if (now >= startTime && now <= endTime) {
                const distance = endTime - now;
                const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                const seconds = Math.floor((distance % (1000 * 60)) / 1000);

                countdownEl.textContent = `Seminar sedang berlangsung. Sisa waktu: ${minutes}m ${seconds}d`;
                countdownEl.className = "mt-2 fw-bold fs-4 text-primary"; // biru saat sedang berlangsung

            } else {
                countdownEl.textContent = "Seminar telah berakhir";
                countdownEl.className = "mt-2 fw-bold fs-4 text-danger"; // merah saat sudah selesai
            }
        }

        if (countdownEl) setInterval(updateCountdown, 1000);
    </script>

</body>
</html>
