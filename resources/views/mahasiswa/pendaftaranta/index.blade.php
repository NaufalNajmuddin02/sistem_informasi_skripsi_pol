<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Berkas Tugas Akhir</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="d-flex flex-column min-vh-100">

@include('layouts.navbar')

<div class="container mt-5">
    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if ($data) 
        <div class="alert alert-info">
            Kamu sudah mengisi form pendaftaran sidang.
        </div>
    @else
        <h2>Upload Berkas Tugas Akhir</h2>
        <form action="{{ route('berkas.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

        <div class="mb-3">
                <label class="form-label">NIM</label>
                <input type="text" class="form-control" value="{{ Auth::user()->nim }}" readonly name="nim" />
            </div>

            <div class="mb-3">
                <label class="form-label">Nama</label>
                <input type="text" class="form-control" value="{{ Auth::user()->username }}" readonly name="nama" />
            </div>
            <div class="mb-3">
                <label class="form-label" for="judul_skripsi">Judul Skripsi</label>
                <input type="text" class="form-control" id="judul_skripsi" name="judul_skripsi" />
            </div>
            <div class="mb-3">
                <label class="form-label" for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="contoh@email.com" required />
            </div>

            <div class="mb-3">
                <label class="form-label" for="nomor_wa">Nomor WA</label>
                <input
                    type="text"
                    class="form-control"
                    id="nomor_wa"
                    name="nomor_wa"
                    inputmode="numeric"
                    pattern="[0-9]{1,13}"
                    maxlength="13"
                    placeholder="Contoh: 081234567890"
                    required
                />
            </div>

            <div class="mb-3">
                <label class="form-label d-block" for="jenis_laporan">Jenis Laporan Skripsi <span class="text-danger">*</span></label>
                <select class="form-select" id="jenis_laporan" name="jenis_laporan" required>
                    <option value="" disabled selected>Pilih Jenis Laporan</option>
                    <option value="Dengan Luaran HKI">Dengan Luaran HKI</option>
                    <option value="Dengan Luaran Artikel Ilmiah">Dengan Luaran Artikel Ilmiah</option>
                    <option value="Tanpa Luaran (Laporan skripsi biasa)">Tanpa Luaran (Laporan skripsi biasa)</option>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label" for="nik_ktp">NIK KTP</label>
                <input
                    type="text"
                    class="form-control"
                    id="nik_ktp"
                    name="nik_ktp"
                    inputmode="numeric"
                    pattern="[0-9]{1,16}"
                    maxlength="16"
                    placeholder="Masukkan NIK"
                    required
                />
            </div>

            <div class="mb-3">
                <label class="form-label" for="tanggal_lahir">Tanggal Lahir</label>
                <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" required />
            </div>

            <div class="mb-3">
                <label class="form-label" for="alamat">Alamat</label>
                <input type="text" class="form-control" id="alamat" name="alamat" />
            </div>
            <div class="mb-3">
                <label class="form-label" for="kota">Kota</label>
                <input type="text" class="form-control" id="kota" name="kota" />
            </div>
            <div class="mb-3">
                <label class="form-label" for="nama_ayah">Nama Ayah</label>
                <input type="text" class="form-control" id="nama_ayah" name="nama_ayah" />
            </div>
            <div class="mb-3">
                <label class="form-label" for="nama_ibu">Nama Ibu</label>
                <input type="text" class="form-control" id="nama_ibu" name="nama_ibu" />
            </div>
            <div class="mb-3">
                <label class="form-label" for="asal_slta">Asal SLTA <span class="text-danger">*</span></label>
                <select class="form-select" id="asal_slta" name="asal_slta" required>
                    <option value="" disabled selected>Pilih Asal SLTA</option>
                    <option value="SMA/MA-IPA">SMA/MA-IPA</option>
                    <option value="SMA/MA-IPS">SMA/MA-IPS</option>
                    <option value="SMK-TKJ">SMK-TKJ</option>
                    <option value="SMK-RPL">SMK-RPL</option>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label" for="ukuran_toga">Ukuran Toga (jika wisuda) <span class="text-danger">*</span></label>
                <select class="form-select" id="ukuran_toga" name="ukuran_toga" required>
                    <option value="" disabled selected>Pilih Ukuran Toga</option>
                    <option value="XS">XS</option>
                    <option value="S">S</option>
                    <option value="M">M</option>
                    <option value="L">L</option>
                    <option value="XL">XL</option>
                    <option value="XXL">XXL</option>
                    <option value="XXXL">XXXL</option>
                    <option value="XXXXL">XXXXL</option>
                </select>
            </div>


            <!-- Nama Pembimbing 1 -->
            <div class="mb-3">
                <label for="nama_pembimbing_1" class="form-label">Nama Pembimbing 1</label>
                <input type="text" name="pembimbing_1" class="form-control" 
        value="{{ old('pembimbing_1', $seminar->dosenPenilai1->username ?? '') }}" readonly>
            </div>

            <!-- Nama Pembimbing 2 -->
            <div class="mb-3">
                <label for="nama_pembimbing_2" class="form-label">Nama Pembimbing 2</label>
                <input type="text" name="pembimbing_2" class="form-control" 
        value="{{ old('pembimbing_2', $seminar->dosenPenilai2->username ?? '') }}" readonly>
            </div>

            <div class="mb-3">
                <label class="form-label d-block" for="tema_skripsi">Tema Skripsi <span class="text-danger">*</span></label>
                <select class="form-select" id="tema_skripsi" name="tema_skripsi" required>
                    <option value="" disabled selected>Pilih Tema Skripsi</option>
                    <option value="Applied AI">Applied AI</option>
                    <option value="Software Development">Software Development</option>
                    <option value="Game Development">Game Development</option>
                    <option value="Data Analytic">Data Analytic</option>
                    <option value="Cyber Security">Cyber Security</option>
                    <option value="IOT">IOT</option>
                </select>
            </div>


            <div class="mb-3">
                <label class="form-label">Hasil Plagiasi</label>
                <input type="file" name="hasil_plagiasi" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Bukti Pembayaran</label>
                <input type="file" name="bukti_pembayaran" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Skor TOEFL</label>
                <input type="file" name="skor_toefl" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Ijazah SMA</label>
                <input type="file" name="ijazah_sma" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">KTP</label>
                <input type="file" name="ktp" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Kartu Keluarga (KK)</label>
                <input type="file" name="kk" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Surat Rekomendasi</label>
                <input type="file" name="surat_rekomendasi" class="form-control" required>
            </div>

            <div class="d-flex justify-content-end mb-5">
                <button type="button" class="btn btn-secondary me-2" onclick="window.history.back();">Batalkan</button>
                <button type="submit" class="btn btn-primary">Kirim</button>
            </div>
        </form>
    @endif
    
</div>

@include('layouts.footer')

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
