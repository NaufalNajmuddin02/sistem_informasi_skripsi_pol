<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Seminar Mahasiswa</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="d-flex flex-column min-vh-100">
@include('layouts.navbar-admin')

<div class="container mt-5">
    <div class="d-flex align-items-center mb-3">
        <h1 class="me-3 mb-0">Daftar Jadwal Seminar</h1>
        <span class="text-muted">Pembagian jadwal dan ruangan seminar</span>
    </div>
    <hr>

    {{-- Filter --}}
    <div class="card-body">
        <form method="GET" action="{{ route('admin.seminar') }}">
            <div class="row g-3">
                <!-- Tahun Akademik -->
                <div class="col-md-3">
                    <label for="tahun_akademik" class="form-label">Tahun Akademik</label>
                    <select name="tahun_akademik" id="tahun_akademik" class="form-select" onchange="this.form.submit()">
                        <option value="">-- Semua Tahun Akademik --</option>
                        @foreach($daftarTahunAkademik as $tahun)
                            <option value="{{ $tahun }}" {{ $tahun == request('tahun_akademik') ? 'selected' : '' }}>
                                {{ $tahun }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Search -->
                <div class="col-md-4">
                    <label for="search" class="form-label">Cari</label>
                    <input type="text" name="search" value="{{ request('search') }}" id="search"
                        class="form-control" placeholder="Nama, Kelas, atau Judul Skripsi">
                </div>

                <!-- Status Jadwal -->
                <div class="col-md-3">
                    <label for="status_jadwal" class="form-label">Status Jadwal</label>
                    <select name="status_jadwal" id="status_jadwal" class="form-select" onchange="this.form.submit()">
                        <option value="">-- Semua --</option>
                        <option value="belum" {{ request('status_jadwal') == 'belum' ? 'selected' : '' }}>Belum Dijadwalkan</option>
                        <option value="sudah" {{ request('status_jadwal') == 'sudah' ? 'selected' : '' }}>Sudah Dijadwalkan</option>
                    </select>
                </div>

                <!-- Tombol Cari -->
                <div class="col-md-2 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="fas fa-search"></i> Cari
                    </button>
                </div>
            </div>
        </form>
    </div>

    <br>

    {{-- Alert --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="table-responsive">
        <table class="table table-bordered align-middle">
            <thead class="table-primary">
            <tr>
                <th>Mahasiswa</th>
                <th>Kelas</th>
                <th>Judul Skripsi</th>
                <th>Tahun Akademik</th>
                <th>Penilai 1</th>
                <th>Penilai 2</th>
                <th>Ruangan</th>
                <th>Tanggal</th>
                <th>Jam Mulai</th>
                <th>Jam Selesai</th>
                <th>Status Jadwal</th>
                <th>aksi</th>
                <th>Jadwalkan Ulang</th>
            </tr>
            </thead>
            <tbody>
            @foreach($seminars as $seminar)
                <tr>
                    <td>{{ $seminar->name }}</td>
                    <td>{{ $seminar->class }}</td>
                    <td>{{ $seminar->script_title }}</td>
                    <td>{{ $seminar->tahun_akademik }}</td>
                    <td>{{ $seminar->dosen_penilai_1_nama ?? 'Belum Ditentukan' }}</td>
                    <td>{{ $seminar->dosen_penilai_2_nama ?? 'Belum Ditentukan' }}</td>
                    <td>{{ $seminar->ruangan->nama ?? '-' }}</td>
                    <td>{{ $seminar->tanggal ? \Carbon\Carbon::parse($seminar->tanggal)->locale('id')->translatedFormat('l, d-m-Y') : '-' }}</td>
                    <td>{{ $seminar->jam ?? '-' }}</td>
                    <td>{{ $seminar->jam_selesai ?? '-' }}</td>
                    <td>
                        @if($seminar->is_rescheduled == 0)
                            <span class="badge bg-primary">Seminar</span>
                        @else
                            <span class="badge bg-warning text-dark">Penjadwalan Ulang</span>
                        @endif
                    </td>
                    <td>
                        <button class="btn btn-primary btn-sm text-nowrap" data-bs-toggle="modal" data-bs-target="#jadwalModal{{ $seminar->id }}">
                            <i class="fas fa-edit"></i>
                            {{ $seminar->ruangan_id && $seminar->tanggal && $seminar->jam ? 'Edit Jadwal' : 'Atur Jadwal' }}
                        </button>
                    </td>
                    <td>
                        <form action="{{ route('seminar.reschedule', $seminar->id) }}" method="POST" style="display:inline;">
                            @csrf
                            <button type="submit" class="btn btn-warning btn-sm text-nowrap">
                                <i class="fas fa-redo"></i> Jadwalkan Ulang
                            </button>
                        </form>
                    </td>
                </tr>

                {{-- Modal --}}
                <div class="modal fade" id="jadwalModal{{ $seminar->id }}" tabindex="-1">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <form action="{{ route('seminar.updateJadwal', $seminar->id) }}" method="POST">
                                @csrf
                                <div class="modal-header">
                                    <h5 class="modal-title">
                                        @if(!$seminar->ruangan_id && !$seminar->tanggal)
                                            Buat Jadwal Seminar
                                        @elseif($seminar->is_rescheduled)
                                            Penjadwalan Ulang Seminar
                                        @else
                                            Edit Jadwal Seminar
                                        @endif
                                    </h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body row g-3">
                                    <div class="col-md-4">
                                        <label>Ruangan</label>
                                        <select name="ruangan_id" class="form-select" required>
                                            <option value="">-- Pilih Ruangan --</option>
                                            @foreach($ruangans as $ruangan)
                                                <option value="{{ $ruangan->id }}" {{ $ruangan->id == $seminar->ruangan_id ? 'selected' : '' }}>
                                                    {{ $ruangan->nama }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label>Tanggal Seminar</label>
                                        <input type="date" name="tanggal" class="form-control"
                                               value="{{ old('tanggal', $seminar->tanggal ?? '') }}" required>
                                    </div>
                                    <div class="col-md-3">
                                        <label>Jam Mulai</label>
                                        <select name="jam" id="jamMulai{{ $seminar->id }}" class="form-control" required>
                                            @php
                                                $start = strtotime('08:00');
                                                $end = strtotime('17:45');
                                                while ($start <= $end) {
                                                    $time = date('H:i', $start);
                                                    $selected = old('jam', $seminar->jam) == $time ? 'selected' : '';
                                                    echo "<option value=\"$time\" $selected>$time</option>";
                                                    $start = strtotime('+15 minutes', $start);
                                                }
                                            @endphp
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <label>Durasi</label>
                                        <select id="durasi{{ $seminar->id }}" class="form-control">
                                            <option value="15">15 Menit</option>
                                            <option value="30">30 Menit</option>
                                            <option value="45">45 Menit</option>
                                            <option value="60" selected>1 Jam</option>
                                            <option value="75">1 Jam 15 Menit</option>
                                            <option value="90">1.5 Jam</option>
                                            <option value="105">1 Jam 45 Menit</option>
                                            <option value="120">2 Jam</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <label>Jam Selesai</label>
                                        <input type="text" name="jam_selesai" id="jamSelesai{{ $seminar->id }}" class="form-control"
                                               value="{{ old('jam_selesai', $seminar->jam_selesai) }}" readonly required>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                    <button type="submit" class="btn btn-success">Simpan Jadwal</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
            </tbody>
        </table>
        <div class="d-flex justify-content-center">
            {{ $seminars->links() }}
        </div>
    </div>
</div>

@include('layouts.footer')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // buka modal otomatis setelah klik Jadwalkan Ulang
        const params = new URLSearchParams(window.location.search);
        const rescheduleId = params.get('reschedule_id');
        if (rescheduleId) {
            const modal = new bootstrap.Modal(document.getElementById(`jadwalModal${rescheduleId}`));
            modal.show();
        }

        // hitung jam selesai untuk setiap modal
        @foreach($seminars as $seminar)
        (function(){
            const jamMulai = document.getElementById('jamMulai{{ $seminar->id }}');
            const durasi = document.getElementById('durasi{{ $seminar->id }}');
            const jamSelesai = document.getElementById('jamSelesai{{ $seminar->id }}');

            function updateJamSelesai() {
                const mulai = jamMulai.value;
                const dur = parseInt(durasi.value);
                if (mulai) {
                    const [hour, minute] = mulai.split(':').map(Number);
                    const mulaiDate = new Date();
                    mulaiDate.setHours(hour, minute, 0);
                    mulaiDate.setMinutes(mulaiDate.getMinutes() + dur);
                    jamSelesai.value =
                        mulaiDate.getHours().toString().padStart(2, '0') + ':' +
                        mulaiDate.getMinutes().toString().padStart(2, '0');
                }
            }

            jamMulai.addEventListener('change', updateJamSelesai);
            durasi.addEventListener('change', updateJamSelesai);
            updateJamSelesai();
        })();
        @endforeach
    });
</script>
</body>
</html>
