<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Manajemen Data Pendaftar Sidang TA</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
</head>
<body class="d-flex flex-column min-vh-100">
    @include('layouts.navbar-admin')

    <div class="container mt-5">
        <div class="d-flex align-items-center mb-3">
            <h1 class="me-3 mb-0">Data Pendaftar Sidang TA</h1>
        </div>
        <hr>

        <!-- Form Pencarian -->
        <form method="GET" action="{{ route('admin.sidangta.index') }}" class="mb-4">
            <div class="input-group">
                <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Cari nama, NIM, atau email...">
                <button class="btn btn-primary" type="submit"><i class="fas fa-search"></i> Cari</button>
            </div>
        </form>

        <div class="table-responsive">
            <table class="table table-bordered align-middle">
                <thead class="table-primary">
                    <tr>
                        <th>NIM</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>No. WA</th>
                        <th>Jenis Laporan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($pendaftars as $item)
                        <tr>
                            <td>{{ $item->nim }}</td>
                            <td>{{ $item->nama }}</td>
                            <td>{{ $item->email }}</td>
                            <td>{{ $item->nomor_wa }}</td>
                            <td>{{ $item->jenis_laporan }}</td>
                            <td>
                                <a href="{{ route('admin.sidangta.edit', $item->id) }}" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i> Verifikasi
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">Tidak ada data ditemukan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="d-flex justify-content-center">
                {{ $pendaftars->appends(['search' => request('search')])->links() }}
            </div>

                        <!-- Tabel Mahasiswa Belum Daftar -->
            <div class="mt-5">
                <h3 class="mb-3">Mahasiswa yang Belum Mendaftar Ujian TA</h3>
                <div class="table-responsive">
                    <table class="table table-bordered align-middle">
                        <thead class="table-danger">
                            <tr>
                                <th>NIM</th>
                                <th>Nama</th>
                                <th>Email/No. HP</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($belumDaftar as $mhs)
                                <tr>
                                    <td>{{ $mhs->nim }}</td>
                                    <td>{{ $mhs->nama }}</td>
                                    <td>{{ $mhs->no_hp }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center">Semua mahasiswa sudah mendaftar ujian TA.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    <!-- Pagination Belum Daftar -->
                    <div class="d-flex justify-content-center">
                        {{ $belumDaftar->links() }}
                    </div>
                </div>
            </div>


            <!-- Pagination -->
            
        </div>
    </div>

    @include('layouts.footer')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
