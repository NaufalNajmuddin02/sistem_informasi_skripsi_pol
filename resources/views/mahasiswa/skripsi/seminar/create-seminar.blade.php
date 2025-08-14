<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengajuan Seminar Proposal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>

<body class="d-flex flex-column min-vh-100">

    @include('layouts.navbar')

    <!-- Main Content -->
    <div class="container mt-5">
        <h2>Pengajuan Seminar Proposal</h2>
        <hr>
        <form action="{{ route('seminar.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Nama</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ $nama }}" readonly>
            </div>

            <div class="mb-3">
                <label for="class" class="form-label">Kelas</label>
                <input type="text" name="class" id="class" class="form-control" value="{{ $kelas }}" readonly>
            </div>

            <div class="mb-3">
                <label for="script_title" class="form-label">Judul Skripsi</label>
                <input type="text" name="script_title" id="script_title" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="no_hp" class="form-label">No. HP</label>
                <input type="text" name="no_hp" id="no_hp" class="form-control" value="{{ $no_hp }}" readonly>
            </div>
            <div class="mb-3">
                <label for="tahun_akademik" class="form-label">Tahun Akademik</label>
                <input type="text" name="tahun_akademik" id="tahun_akademik" class="form-control" value="{{ $tahunAkademik }}" readonly>
            </div>
            <div class="mb-3">
                <label for="link" class="form-label">Link Drive</label>
                <input type="url" name="link" id="link" class="form-control" placeholder="https://drive.google.com/..." required>
            </div>
            <div class="mb-3">
                <label for="kategori_proposal_id" class="form-label">Kategori Proposal</label>
                <select name="kategori_proposal_id" id="kategori_proposal_id" class="form-select" required>
                    <option value="">-- Pilih Kategori --</option>
                    @foreach ($kategoriList as $kategori)
                        <option value="{{ $kategori->id }}">{{ $kategori->nama_kategori }}</option>
                    @endforeach
                </select>
            </div>


            <div class="mb-3">
                <label for="submission_date" class="form-label">Tanggal Pengajuan</label>
                <input type="date" name="submission_date" id="submission_date" class="form-control" value="{{ $tanggalSekarang }}" readonly onfocus="this.showPicker()">
            </div> 
            
            
            <!-- Tombol Batalkan & Ajukan -->
            <div class="d-flex justify-content-end mb-5">
                <button type="button" class="btn btn-secondary me-2" onclick="window.history.back();">Batalkan</button>
                <button type="submit" class="btn btn-primary">simpan</button>
            </div>
        </form>
    </div> <!-- Akhir wrapper konten -->

    @include('layouts.footer')


    <!-- Bootstrap and Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>
</html>