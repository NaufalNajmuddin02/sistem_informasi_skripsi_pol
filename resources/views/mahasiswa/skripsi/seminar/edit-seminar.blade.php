<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Seminar Proposal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>

<body class="d-flex flex-column min-vh-100">
    @include('layouts.navbar')

    <div class="container mt-5">
        <h2>Edit Seminar Proposal</h2>
        <hr>
        <form action="{{ route('seminar.update', $seminar->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">Nama</label>
                <input type="text" name="name" class="form-control" value="{{ $seminar->name }}" readonly>
            </div>

            <div class="mb-3">
                <label class="form-label">No. HP</label>
                <input type="text" name="no_hp" class="form-control" value="{{ $user->no_hp }}" readonly>
            </div>

            <div class="mb-3">
                <label class="form-label">Kelas</label>
                <select name="class" class="form-select" required>
                    @foreach (['A','B','C','D','E'] as $kelas)
                        <option value="{{ $kelas }}" {{ $seminar->class == $kelas ? 'selected' : '' }}>{{ $kelas }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Judul Skripsi</label>
                <input type="text" name="script_title" class="form-control" value="{{ $seminar->script_title }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Tanggal Pengajuan</label>
                <input type="date" name="submission_date" class="form-control" value="{{ $seminar->submission_date }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Tahun Akademik</label>
                <input type="text" name="tahun_akademik" class="form-control" value="{{ $seminar->tahun_akademik }}" readonly>
            </div>

            <div class="mb-3">
                <label class="form-label">Link Drive</label>
                <input type="url" name="link" class="form-control" value="{{ $seminar->link }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Kategori Proposal</label>
                <select name="kategori_proposal_id" class="form-select" required>
                    <option value="">-- Pilih Kategori --</option>
                    @foreach ($kategoriList as $kategori)
                        <option value="{{ $kategori->id }}" {{ $seminar->kategori_proposal_id == $kategori->id ? 'selected' : '' }}>
                            {{ $kategori->nama_kategori }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Tombol Batalkan & Simpan -->
            <div class="d-flex justify-content-end mb-5">
                <button type="button" class="btn btn-secondary me-2" onclick="window.history.back();">Batalkan</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>

    @include('layouts.footer')

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>
</html>
