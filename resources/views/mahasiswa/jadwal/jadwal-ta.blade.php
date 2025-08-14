<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SISTA - Jadwal Yudisium</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>
<body class="d-flex flex-column min-vh-100">
    @include('layouts.navbar')
    <!-- Main Content -->
    <div class="container my-4">
        <div class="container my-4">
    <div class="d-flex align-items-center mb-3">
        <h1 class="me-3 mb-0">JADWAL TA</h1>
    </div>
    <hr>

        @forelse($jadwal as $item)
            @php
                
                $tanggal = $item->tanggal ? \Carbon\Carbon::parse($item->tanggal)->locale('id')->translatedFormat('l, d-m-Y') : '-';
                $jam = $item->waktu ? \Carbon\Carbon::parse($item->waktu)->format('H:i') : '-';
                $selesai = $item->selesai ? \Carbon\Carbon::parse($item->selesai)->format('H:i') : '-';
            @endphp

            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-3">
                        <h5 class="me-2"><i class="fas fa-calendar-alt text-primary"></i> Detail Tugas Akhir</h5>
                        <div class="flex-grow-1 border-bottom border-2 border-primary"></div>
                    </div>
                    <p><i class="fas fa-user-shield"></i> <strong>Ketua Penguji:</strong> {{ $item->ketuaPenguji->username ?? '-' }}</p>
                    <p><i class="fas fa-user-tie"></i> <strong>Penguji 1:</strong> {{ $item->penguji1->username ?? '-' }}</p>
                    <p><i class="fas fa-user-tie"></i> <strong>Penguji 2:</strong> {{ $item->penguji2->username ?? '-' }}</p>
                    <p><i class="fas fa-door-open"></i> <strong>Ruangan:</strong> {{ $item->ruangan ?? '-' }}</p>
                    <p><i class="fas fa-calendar-day"></i> <strong>Tanggal:</strong> {{ $item->tanggal_formatted }}</p>
                    <p><i class="fas fa-clock"></i> <strong>Jam Mulai:</strong> {{ $item->jam_formatted }}</p>
                    <p><i class="fas fa-clock"></i> <strong>Jam Selesai:</strong> {{ $item->selesai_formatted }}</p>    

                </div>
            </div>
        @empty
            <div class="card shadow-sm mt-4">
                <div class="card-body text-center text-muted">
                    <i class="fas fa-exclamation-circle"></i> Belum ada jadwal seminar
                </div>
            </div>
        @endforelse
    </div>

    </div>

    @include('layouts.footer')

    <!-- Bootstrap JS and Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>
</html>