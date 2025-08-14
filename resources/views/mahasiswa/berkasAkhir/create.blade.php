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
                
                <form action="{{ route('mahasiswa.berkas-akhir.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Nama</label>
                        <input type="text" name="nama" value="{{$nama}}" class="form-control">
                    </div>

                    <div class="mb-3">
                       <label class="form-label">Kelas</label>
                    <select name="kelas" class="form-select">
                        <option value="A">A</option>
                        <option value="B">B</option>
                        <option value="C">C</option>
                        <!-- Tambahkan opsi lain jika perlu -->
                    </select>
                    </div>

                    <!-- <div class="row mb-3">
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
                    </div> -->

                    <div class="mb-3">
                        <label class="form-label">Judul Skripsi</label>
                        <input type="text" name="judul_skripsi" value="{{$judul}}" class="form-control">
                    </div>
                    <!-- <div class="mb-3">
                        <label class="form-label">Pilih Dosen</label>
                        <select name="dosen" class="form-select" ">
                            <option value="">-- Pilih Pembimbing --</option>
                            @if($dosen1)
                                <option value="{{ $dosen1 }}" >Pembimbing I - {{ $dosen1 }}</option>
                            @endif
                            @if($dosen2)
                                <option value="{{ $dosen2 }}" >Pembimbing II - {{ $dosen2 }}</option>
                            @endif
                        </select>
                    </div> -->

                     <div class="mb-3">
                        <label class="form-label">Nama Dosen Pembimbing 1 :</label>
                        <input type="text" value="{{ $dosen1 }}"  name="dospem1" class="form-control" readonly>
                    </div>
                      <div class="mb-3">
                        <label class="form-label">Nama Dosen Pembimbing 2 :</label>
                        <input type="text" value="{{ $dosen2 }}"  name="dospem2" class="form-control" readonly>
                    </div>



                    <div class="mb-3">
                        <label class="form-label">File Skripsi</label>
                        <div class="input-group">
                            <!-- <button class="btn btn-secondary" type="button">Pilih File</button> -->
                            <input type="file" class="form-control" name="file_skripsi" placeholder="Tidak ada file yang di pilih">
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