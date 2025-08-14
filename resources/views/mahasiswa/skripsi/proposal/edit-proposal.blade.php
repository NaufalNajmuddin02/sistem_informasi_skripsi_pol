<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Proposal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-lite.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-lite.min.js"></script>
</head>
<body class="d-flex flex-column min-vh-100">

    @include('layouts.navbar')

    <div class="container mt-5">
        <h2>Edit Proposal Skripsi</h2>
        <hr>
        <form action="{{ route('proposals.update', $proposal->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">Nama</label>
                <input type="text" name="name" value="{{ $proposal->name }}" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Kelas</label>
                <select name="class" class="form-select" required>
                    <option value="A" {{ $proposal->class == 'A' ? 'selected' : '' }}>A</option>
                    <option value="B" {{ $proposal->class == 'B' ? 'selected' : '' }}>B</option>
                    <option value="C" {{ $proposal->class == 'C' ? 'selected' : '' }}>C</option>
                    <option value="D" {{ $proposal->class == 'D' ? 'selected' : '' }}>D</option>
                    <option value="E" {{ $proposal->class == 'E' ? 'selected' : '' }}>E</option>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Tanggal Pengajuan</label>
                <input type="date" name="submission_date" value="{{ $proposal->submission_date }}" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Judul Skripsi</label>
                <input type="text" name="script_title" value="{{ $proposal->script_title }}" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Link Dokumen (Google Drive)</label>
                <input type="url" name="link" value="{{ $proposal->link }}" class="form-control" placeholder="https://drive.google.com/..." required>
            </div>

            <div class="mb-3">
                <label class="form-label">Kategori Proposal</label>
                <select name="kategori_proposal_id" class="form-select" required>
                    <option value="">-- Pilih Kategori --</option>
                    @foreach($kategoriList as $kategori)
                        <option value="{{ $kategori->id }}" {{ $proposal->kategori_proposal_id == $kategori->id ? 'selected' : '' }}>
                            {{ $kategori->nama_kategori }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="abstract" class="form-label">Detail</label>
                <textarea name="abstract" id="abstract" class="form-control" required>{{ $proposal->abstract }}</textarea>
            </div>

            <div class="d-flex justify-content-end mb-5">
                <button type="button" class="btn btn-secondary me-2" onclick="window.history.back();">Batalkan</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>

    @include('layouts.footer')

    <script>
        $(document).ready(function () {
            $('#abstract').summernote({
                placeholder: 'Tulis Detail di sini...',
                tabsize: 2,
                height: 200
            });
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
