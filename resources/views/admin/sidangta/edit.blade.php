<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Edit Pendaftar Sidang TA</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body class="d-flex flex-column min-vh-100">
    @include('layouts.navbar-admin')

    <div class="container mt-5">
        <h1>Verfikasi Data Pendaftar Sidang TA</h1>
        <hr>
        <form action="{{ route('admin.sidangta.update', $pendaftar->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="row g-3">
                <div class="col-md-6 d-flex align-items-center">
                    <label class="form-label mb-0">NIM</label>
                </div>
                <div class="col-md-6">
                    <input type="text" class="form-control" value="{{ $pendaftar->nim }}" readonly>
                </div>

                <div class="col-md-6 d-flex align-items-center">
                    <label class="form-label mb-0">Nama</label>
                </div>
                <div class="col-md-6">
                    <input type="text" name="nama" class="form-control" value="{{ $pendaftar->nama }}">
                </div>

                <div class="col-md-6 d-flex align-items-center">
                    <label class="form-label mb-0">Email</label>
                </div>
                <div class="col-md-6">
                    <input type="email" name="email" class="form-control" value="{{ $pendaftar->email }}">
                </div>

                <div class="col-md-6 d-flex align-items-center">
                    <label class="form-label mb-0">Nomor WA</label>
                </div>
                <div class="col-md-6">
                    <input type="text" name="nomor_wa" class="form-control" value="{{ $pendaftar->nomor_wa }}">
                </div>

                <div class="col-md-6 d-flex align-items-center">
                    <label class="form-label mb-0">Jenis Laporan</label>
                </div>
                <div class="col-md-6">
                    <input type="text" name="jenis_laporan" class="form-control" value="{{ $pendaftar->jenis_laporan }}">
                </div>

                <div class="col-md-6 d-flex align-items-center">
                    <label class="form-label mb-0">NIK KTP</label>
                </div>
                <div class="col-md-6">
                    <input type="text" name="nik_ktp" class="form-control" value="{{ $pendaftar->nik_ktp }}">
                </div>

                <div class="col-md-6 d-flex align-items-center">
                    <label class="form-label mb-0">Tanggal Lahir</label>
                </div>
                <div class="col-md-6">
                    <input type="date" name="tanggal_lahir" class="form-control" value="{{ $pendaftar->tanggal_lahir }}">
                </div>

                <div class="col-md-6 d-flex align-items-center">
                    <label class="form-label mb-0">Alamat</label>
                </div>
                <div class="col-md-6">
                    <input type="text" name="alamat" class="form-control" value="{{ $pendaftar->alamat }}">
                </div>

                <div class="col-md-6 d-flex align-items-center">
                    <label class="form-label mb-0">Kota</label>
                </div>
                <div class="col-md-6">
                    <input type="text" name="kota" class="form-control" value="{{ $pendaftar->kota }}">
                </div>

                <div class="col-md-6 d-flex align-items-center">
                    <label class="form-label mb-0">Nama Ayah</label>
                </div>
                <div class="col-md-6">
                    <input type="text" name="nama_ayah" class="form-control" value="{{ $pendaftar->nama_ayah }}">
                </div>

                <div class="col-md-6 d-flex align-items-center">
                    <label class="form-label mb-0">Nama Ibu</label>
                </div>
                <div class="col-md-6">
                    <input type="text" name="nama_ibu" class="form-control" value="{{ $pendaftar->nama_ibu }}">
                </div>

                <div class="col-md-6 d-flex align-items-center">
                    <label class="form-label mb-0">Asal SLTA</label>
                </div>
                <div class="col-md-6">
                    <input type="text" name="asal_slta" class="form-control" value="{{ $pendaftar->asal_slta }}">
                </div>

                <div class="col-md-6 d-flex align-items-center">
                    <label class="form-label mb-0">Ukuran Toga</label>
                </div>
                <div class="col-md-6">
                    <input type="text" name="ukuran_toga" class="form-control" value="{{ $pendaftar->ukuran_toga }}">
                </div>

                <div class="col-md-6 d-flex align-items-center">
                    <label class="form-label mb-0">Pembimbing 1</label>
                </div>
                <div class="col-md-6">
                    <input type="text" name="nama_pembimbing_1" class="form-control" value="{{ $pendaftar->nama_pembimbing_1 }}">
                </div>

                <div class="col-md-6 d-flex align-items-center">
                    <label class="form-label mb-0">Pembimbing 2</label>
                </div>
                <div class="col-md-6">
                    <input type="text" name="nama_pembimbing_2" class="form-control" value="{{ $pendaftar->nama_pembimbing_2 }}">
                </div>

                <div class="col-md-6 d-flex align-items-center">
                    <label class="form-label mb-0">Tema Skripsi</label>
                </div>
                <div class="col-md-6">
                    <input type="text" name="tema_skripsi" class="form-control" value="{{ $pendaftar->tema_skripsi }}">
                </div>
                <br>
                <div class="row g-3">
                    <div class="col-md-6 d-flex align-items-center">
                        <label class="form-label mb-0">Hasil Plagiasi</label>
                    </div>

                    <div class="col-md-6">
                        <div class="d-flex align-items-center">
                            <select name="status_hasil_plagiasi" class="form-control me-2">
                                <option value="disetujui" {{ $pendaftar->status_hasil_plagiasi == 'disetujui' ? 'selected' : '' }}>Disetujui</option>
                                <option value="belum disetujui" {{ $pendaftar->status_hasil_plagiasi == 'belum disetujui' ? 'selected' : '' }}>Belum Disetujui</option>
                            </select>

                            @if ($pendaftar->naskah)
                                @if ($pendaftar->naskah)
                                <a href="{{ asset($pendaftar->hasil_plagiasi) }}" target="_blank" class="btn btn-outline-secondary" title="Lihat File Naskah">
                                    <i class="fas fa-file-pdf fa-lg text-danger"></i>
                                </a>
                            @endif
                            @endif
                        </div>
                    </div>
                </div>
                <br>
                <div class="row g-3">
                    <div class="col-md-6 d-flex align-items-center">
                        <label class="form-label mb-0">Bukti Pembayaran</label>
                    </div>

                    <div class="col-md-6">
                        <div class="d-flex align-items-center">
                            <select name="status_bukti_pembayaran" class="form-control me-2">
                                <option value="disetujui" {{ $pendaftar->status_bukti_pembayaran == 'disetujui' ? 'selected' : '' }}>Disetujui</option>
                                <option value="belum disetujui" {{ $pendaftar->status_bukti_pembayaran == 'belum disetujui' ? 'selected' : '' }}>Belum Disetujui</option>
                            </select>

                            @if ($pendaftar->naskah)
                                @if ($pendaftar->naskah)
                                <a href="{{ asset($pendaftar->bukti_pembayaran) }}" target="_blank" class="btn btn-outline-secondary" title="Lihat File Naskah">
                                    <i class="fas fa-file-pdf fa-lg text-danger"></i>
                                </a>
                            @endif
                            @endif
                        </div>
                    </div>
                </div>
                <br>
                <div class="row g-3">
                    <div class="col-md-6 d-flex align-items-center">
                        <label class="form-label mb-0">Score Toefl</label>
                    </div>

                    <div class="col-md-6">
                        <div class="d-flex align-items-center">
                            <select name="status_skor_toefl" class="form-control me-2">
                                <option value="disetujui" {{ $pendaftar->status_skor_toefl == 'disetujui' ? 'selected' : '' }}>Disetujui</option>
                                <option value="belum disetujui" {{ $pendaftar->status_skor_toefl == 'belum disetujui' ? 'selected' : '' }}>Belum Disetujui</option>
                            </select>

                            @if ($pendaftar->naskah)
                                @if ($pendaftar->naskah)
                                <a href="{{ asset($pendaftar->skor_toefl) }}" target="_blank" class="btn btn-outline-secondary" title="Lihat File Naskah">
                                    <i class="fas fa-file-pdf fa-lg text-danger"></i>
                                </a>
                            @endif
                            @endif
                        </div>
                    </div>
                </div>
                <br>
                <div class="row g-3">
                    <div class="col-md-6 d-flex align-items-center">
                        <label class="form-label mb-0">Ijazah SMA</label>
                    </div>

                    <div class="col-md-6">
                        <div class="d-flex align-items-center">
                            <select name="status_ijazah_sma" class="form-control me-2">
                                <option value="disetujui" {{ $pendaftar->status_ijazah_sma == 'disetujui' ? 'selected' : '' }}>Disetujui</option>
                                <option value="belum disetujui" {{ $pendaftar->status_ijazah_sma == 'belum disetujui' ? 'selected' : '' }}>Belum Disetujui</option>
                            </select>

                            @if ($pendaftar->naskah)
                                @if ($pendaftar->naskah)
                                <a href="{{ asset($pendaftar->ijazah_sma) }}" target="_blank" class="btn btn-outline-secondary" title="Lihat File Naskah">
                                    <i class="fas fa-file-pdf fa-lg text-danger"></i>
                                </a>
                            @endif
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row g-3">
                    <div class="col-md-6 d-flex align-items-center">
                        <label class="form-label mb-0">KTP</label>
                    </div>

                    <div class="col-md-6">
                        <div class="d-flex align-items-center">
                            <select name="status_ktp" class="form-control me-2">
                                <option value="disetujui" {{ $pendaftar->status_ktp == 'disetujui' ? 'selected' : '' }}>Disetujui</option>
                                <option value="belum disetujui" {{ $pendaftar->status_ktp == 'belum disetujui' ? 'selected' : '' }}>Belum Disetujui</option>
                            </select>

                            @if ($pendaftar->naskah)
                                @if ($pendaftar->naskah)
                                <a href="{{ asset($pendaftar->ktp) }}" target="_blank" class="btn btn-outline-secondary" title="Lihat File Naskah">
                                    <i class="fas fa-file-pdf fa-lg text-danger"></i>
                                </a>
                            @endif
                            @endif
                        </div>
                    </div>
                </div>
                 <div class="row g-3">
                    <div class="col-md-6 d-flex align-items-center">
                        <label class="form-label mb-0">KK</label>
                    </div>

                    <div class="col-md-6">
                        <div class="d-flex align-items-center">
                            <select name="status_kk" class="form-control me-2">
                                <option value="disetujui" {{ $pendaftar->status_kk == 'disetujui' ? 'selected' : '' }}>Disetujui</option>
                                <option value="belum disetujui" {{ $pendaftar->status_kk == 'belum disetujui' ? 'selected' : '' }}>Belum Disetujui</option>
                            </select>

                            @if ($pendaftar->naskah)
                                @if ($pendaftar->naskah)
                                <a href="{{ asset($pendaftar->kk) }}" target="_blank" class="btn btn-outline-secondary" title="Lihat File Naskah">
                                    <i class="fas fa-file-pdf fa-lg text-danger"></i>
                                </a>
                            @endif
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row g-3">
                    <div class="col-md-6 d-flex align-items-center">
                        <label class="form-label mb-0">Surat Rekomendasi</label>
                    </div>

                    <div class="col-md-6">
                        <div class="d-flex align-items-center">
                            <select name="status_surat_rekomendasi" class="form-control me-2">
                                <option value="disetujui" {{ $pendaftar->status_surat_rekomendasi == 'disetujui' ? 'selected' : '' }}>Disetujui</option>
                                <option value="belum disetujui" {{ $pendaftar->status_surat_rekomendasi == 'belum disetujui' ? 'selected' : '' }}>Belum Disetujui</option>
                            </select>

                            @if ($pendaftar->naskah)
                                @if ($pendaftar->naskah)
                                <a href="{{ asset($pendaftar->surat_rekomendasi) }}" target="_blank" class="btn btn-outline-secondary" title="Lihat File Naskah">
                                    <i class="fas fa-file-pdf fa-lg text-danger"></i>
                                </a>
                            @endif
                            @endif
                        </div>
                    </div>
                </div>
                <div class="mt-4">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Simpan Perubahan
                    </button>
                </div>
            </div>

        </form>
    </div>
    <br>
    @include('layouts.footer')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
