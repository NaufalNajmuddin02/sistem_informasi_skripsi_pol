<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SISTA - Tambah Dosen Mapel Proposal Skripsi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body class="d-flex flex-column min-vh-100">
    @include('layouts.navbar-kaprodi')

    <div class="container mt-5 mb-5">

   <form action="{{ route('kaprodi.datapesertasidang.store') }}" method="POST" class="needs-validation" novalidate>
    @csrf

    <div class="mb-3">
                @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <label for="pilih_mahasiswa" class="form-label">Pilih Mahasiswa</label>
        <select class="form-select" id="pilih_mahasiswa">
            <option value="">-- Pilih Mahasiswa --</option>
            @foreach ($mahasiswaList as $pendaftaran)
                <option value="{{ $pendaftaran->nim }}">
                    {{ $pendaftaran->nim }} - {{ $pendaftaran->user->username ?? 'Tidak ada nama' }}
                </option>
            @endforeach
        </select>
    </div>


    <div class="mb-3">
        <label for="nim" class="form-label">NIM</label>
        <input type="text" class="form-control" id="nim" name="nim" required>
        <div class="invalid-feedback">Silakan masukkan NIM.</div>
    </div>

    <div class="mb-3">
        <label for="judul" class="form-label">Judul TA</label>
        <input type="text" class="form-control" id="judul" name="judul" required>
        <div class="invalid-feedback">Silakan masukkan judul.</div>
    </div>


    <!-- Dosen Pembimbing 1 -->
   <div class="mb-3">
        <label for="nama_pembimbing_1" class="form-label">Dosen Pembimbing 1</label>
        <input type="text" id="nama_pembimbing_1" name="nama_pembimbing_1" class="form-control" readonly>
    </div>



    <!-- Dosen Pembimbing 2 -->
   <div class="mb-3">
        <label for="nama_pembimbing_1" class="form-label">Dosen Pembimbing 2</label>
        <input type="text" id="nama_pembimbing_2" name="nama_pembimbing_2" class="form-control" readonly>
    </div>


    <!-- Ketua Penguji -->
    <div class="mb-3">
        <label for="ketua_penguji_id" class="form-label">Ketua Penguji</label>
        <select name="ketua_penguji_id" id="ketua_penguji_id" class="form-select" required>
            <option value="">-- Pilih Dosen --</option>
            @foreach($dosenList as $dosen)
                <option value="{{ $dosen->id }}">{{ $dosen->username }}</option>
            @endforeach
        </select>
        <div class="invalid-feedback">Silakan pilih ketua penguji.</div>
    </div>

    <!-- Penguji 1 -->
    <div class="mb-3">
        <label for="penguji1_id" class="form-label">Penguji 1</label>
        <select name="penguji1_id" id="penguji1_id" class="form-select" required>
            <div class="invalid-feedback">Silakan pilih penguji 1.</div>
            <option value="">-- Pilih Dosen --</option>
            @foreach($dosenList as $dosen)
                <option value="{{ $dosen->id }}">{{ $dosen->username }}</option>
            @endforeach
        </select>
        
    </div>

    <!-- Penguji 2 -->
    <div class="mb-3">
        <label for="penguji2" class="form-label">Penguji 2</label>
        <input type="text" id="penguji2" name="penguji2" class="form-control" readonly>
    </div>

    <!-- Tombol Aksi -->
    <div class="text-end">
        <a href="{{ route('kaprodi.pesertasidang') }}" class="btn btn-secondary me-2">
            <i class="bi bi-arrow-left-circle"></i> Kembali
        </a>
        <button type="submit" class="btn btn-success">
            <i class="bi bi-plus-circle"></i> Simpan Peserta TA
        </button>
    </div>
</form>
</div>


    @include('layouts.footer')

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Validasi Form -->
    <script>
    document.getElementById('pilih_mahasiswa').addEventListener('change', function () {
    const nim = this.value;
    if (!nim) {
        // reset jika tidak pilih apa-apa
        document.getElementById('nim').value = '';
        document.getElementById('judul').value = '';
        document.getElementById('nama_pembimbing_1').value = '';
        document.getElementById('nama_pembimbing_2').value = '';
        document.getElementById('penguji2').value = '';
        return;
    }

    fetch(`/get-data-pendaftaran/${nim}`)
        .then(res => {
            if (!res.ok) throw new Error('Data tidak ditemukan');
            return res.json();
        })
        .then(data => {
            document.getElementById('nim').value = data.nim || '';
            document.getElementById('judul').value = data.judul || '';
            document.getElementById('nama_pembimbing_1').value = data.nama_pembimbing_1 || '';
            document.getElementById('nama_pembimbing_2').value = data.nama_pembimbing_2 || '';
            document.getElementById('penguji2').value = data.penguji2 || '';
        })
        .catch(err => {
            alert('Gagal mengambil data: ' + err.message);
            document.getElementById('nim').value = '';
            document.getElementById('judul').value = '';
            document.getElementById('nama_pembimbing_1').value = '';
            document.getElementById('nama_pembimbing_2').value = '';
            document.getElementById('penguji2').value = '';
        });
    });



    </script>


</body>
</html>
