<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SISTA - Jadwal Yudisium</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>
<body class="d-flex flex-column min-vh-100">

@include('layouts.navbar')

<div class="container my-4">
    <div class="d-flex align-items-center mb-3">
        <h1 class="me-3 mb-0">JADWAL YUDISIUM</h1>
    </div>
    <hr>

    @forelse($jadwal as $item)
        @php
            $tanggal = \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d-m-Y');
            $jamMulai = \Carbon\Carbon::parse($item->waktu_mulai)->format('H:i');
            $jamSelesai = \Carbon\Carbon::parse($item->waktu_selesai)->format('H:i');
        @endphp

        <div class="card shadow-sm mb-4">
            <div class="card-body">
                <h5 class="card-title"><i class="fas fa-calendar-alt text-primary me-2"></i>Yudisium</h5>
                <p><i class="fas fa-door-open"></i> <strong>Ruangan:</strong> {{ $item->ruangan }}</p>
                <p><i class="fas fa-calendar-day"></i> <strong>Tanggal:</strong> {{ $tanggal }}</p>
                <p><i class="fas fa-clock"></i> <strong>Jam:</strong> {{ $jamMulai }} - {{ $jamSelesai }}</p>
                @if($item->keterangan)
                    <p><i class="fas fa-info-circle"></i> <strong>Keterangan:</strong> {{ $item->keterangan }}</p>
                @endif
            </div>
        </div>
    @empty
        <div class="card shadow-sm mt-4">
            <div class="card-body text-center text-muted">
                <i class="fas fa-exclamation-circle me-2"></i> Belum ada jadwal yudisium
            </div>
        </div>
    @endforelse
</div>

@include('layouts.footer')

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
