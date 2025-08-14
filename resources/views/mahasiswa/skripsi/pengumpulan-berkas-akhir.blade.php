<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SISTA - Pengumpulan Berkas Akhir</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel ="stylesheet" href="{{asset('css/mahasiswa/skripsi/berkasakhir.css')}}">
</head>

<body class="d-flex flex-column min-vh-100">
    @include('layouts.navbar')
    <!-- Main Content -->
    <div class="main-content">
        <div class="container">
            <div class="form-container">
                <h2 class="mb-4">Pengumpulan Berkas Akhir</h2>
                
                <form>
                    <div class="mb-3">
                        <label class="form-label">Nama</label>
                        <input type="text" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Kelas</label>
                        <select class="form-select">
                            <option selected>B</option>
                        </select>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Tanggal Mulai</label>
                            <div class="d-flex align-items-center">
                                <input type="text" class="form-control" placeholder="dd-mm-yy">
                                <span class="date-picker-icon">
                                    <i class="fas fa-calendar"></i>
                                </span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Tanggal Selesai</label>
                            <div class="d-flex align-items-center">
                                <input type="text" class="form-control" placeholder="dd-mm-yy">
                                <span class="date-picker-icon">
                                    <i class="fas fa-calendar"></i>
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Judul Skripsi</label>
                        <input type="text" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Periode</label>
                        <select class="form-select">
                            <option selected>-- Pilih Periode Mulai --</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">File Skripsi</label>
                        <div class="input-group">
                            <button class="btn btn-secondary" type="button">Pilih File</button>
                            <input type="text" class="form-control" placeholder="Tidak ada file yang di pilih" readonly>
                        </div>
                        <small class="text-muted">pdf, doc, docx (maksimal 20mb)</small>
                    </div>

                    <div class="text-end mt-4">
                        <button type="button" class="btn btn-danger me-2">Batalkan</button>
                        <button type="submit" class="btn btn-success">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @include('layouts.footer')

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/your-kit-code.js"></script>
</body>
</html>