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
        <div class="d-flex align-items-center mb-3">
            <h1 class="me-3 mb-0">JADWAL YUDISIUM</h1>
        </div>
        <hr>
        <table class="table table-striped table-bordered">
            <thead class="table-primary">
                <tr>
                    <th>Ketua Penguji</th>
                    <th>Penguji 1</th>
                    <th>Penguji 2</th>
                    <th>Ruangan</th>
                    <th>Tanggal</th>
                    <th>Jam</th>
                </tr>
            </thead>
            <tbody>
                @forelse($jadwal as $item)
                    <tr>
                        <td>{{ $item->ketuaPenguji->username ?? '-' }}</td>
                        <td>{{ $item->penguji1->username ?? '-' }}</td>
                        <td>{{ $item->penguji2->username ?? '-' }}</td>
                        <td>{{ $item->ruangan ?? '-' }}</td>
                        <td>{{ \Carbon\Carbon::parse($item->tanggal)->format('d-m-Y') ?? '-' }}</td>
                        <td>{{ \Carbon\Carbon::parse($item->waktu)->format('H:i') ?? '-' }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted p-4">Belum ada jadwal</td>
                    </tr>
                @endforelse
            </tbody>

        </table>
    </div>

    @include('layouts.footer')

    <!-- Bootstrap JS and Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>
</html>