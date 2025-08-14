<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jadwal Bimbingan Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="d-flex flex-column min-vh-100">
    @include('layouts.navbar-dosen')

    <div class="container mt-4">
        <h4 class="mb-3">Jadwal Bimbingan Mahasiswa</h4>

        <div class="card shadow-sm">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="table-success">
                            <tr>
                                <th>No</th>
                                <th>Nama Mahasiswa</th>
                                <th>Tanggal</th>
                                <th>Waktu Mulai</th>
                                <th>Waktu Berakhir</th>
                                <th>Ruangan</th>
                                <th>Status</th>
                                <th>Hitung Mundur</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($jadwals as $index => $jadwal)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $jadwal->bimbingan->nama }}</td>
                                <td>{{ \Carbon\Carbon::parse($jadwal->tanggal)->format('d-m-Y') }}</td>
                                <td>{{ $jadwal->waktu_mulai }}</td>
                                <td>{{ $jadwal->waktu_selesai }}</td>
                                <td>{{ $jadwal->ruangan }}</td>
                                <td class="status" data-mulai="{{ $jadwal->tanggal }} {{ $jadwal->waktu_mulai }}" data-akhir="{{ $jadwal->tanggal }} {{ $jadwal->waktu_berakhir }}"></td>
                                <td class="countdown" data-start="{{ $jadwal->tanggal }} {{ $jadwal->waktu_mulai }}" data-end="{{ $jadwal->tanggal }} {{ $jadwal->waktu_berakhir }}"></td>
                            </tr>
                            @endforeach
                            @if($jadwals->isEmpty())
                            <tr>
                                <td colspan="8" class="text-center">Belum ada jadwal bimbingan</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @include('layouts.footer')
    <script>
        function updateCountdown() {
            const now = new Date().getTime();

            document.querySelectorAll(".countdown").forEach(element => {
                const startTime = new Date(element.dataset.start).getTime();
                const endTime = new Date(element.dataset.end).getTime();

                if (now < startTime) {
                    const diff = startTime - now;
                    const hours = Math.floor((diff % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                    const minutes = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
                    const seconds = Math.floor((diff % (1000 * 60)) / 1000);
                    element.innerHTML = `Mulai dalam: ${hours}j ${minutes}m ${seconds}d`;
                } else if (now >= startTime && now <= endTime) {
                    const diff = endTime - now;
                    const minutes = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
                    const seconds = Math.floor((diff % (1000 * 60)) / 1000);
                    element.innerHTML = `Sedang berlangsung: ${minutes}m ${seconds}d`;
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
