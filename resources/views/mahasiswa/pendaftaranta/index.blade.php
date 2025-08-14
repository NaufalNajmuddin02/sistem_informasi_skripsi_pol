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
            <input type="text" class="form-control" id="email" name="email" />
        </div>
        <div class="mb-3">
            <label class="form-label" for="nomor_wa">Nomor WA</label>
            <input type="text" class="form-control" id="nomor_wa" name="nomor_wa" />
        </div>
        <div class="mb-3">
            <label class="form-label d-block">Jenis Laporan Skripsi <span class="text-danger">*</span></label>
            
            <div class="form-check">
                <input class="form-check-input" type="radio" name="jenis_laporan" id="laporan_hki" value="Dengan Luaran HKI" required />
                <label class="form-check-label" for="laporan_hki">Dengan Luaran HKI</label>
            </div>
            
            <div class="form-check">
                <input class="form-check-input" type="radio" name="jenis_laporan" id="laporan_artikel" value="Dengan Luaran Artikel Ilmiah" />
                <label class="form-check-label" for="laporan_artikel">Dengan Luaran Artikel Ilmiah</label>
            </div>
            
            <div class="form-check">
                <input class="form-check-input" type="radio" name="jenis_laporan" id="laporan_biasa" value="Tanpa Luaran (Laporan skripsi biasa)" />
                <label class="form-check-label" for="laporan_biasa">Tanpa Luaran (Laporan skripsi biasa)</label>
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label" for="nik_ktp">NIK KTP</label>
            <input type="text" class="form-control" id="nik_ktp" name="nik_ktp" />
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
            <label class="form-label">Asal SLTA <span class="text-danger">*</span></label>
            <div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="asal_slta" id="sma_ipa" value="SMA/MA-IPA" required />
                    <label class="form-check-label" for="sma_ipa">SMA/MA-IPA</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="asal_slta" id="sma_ips" value="SMA/MA-IPS" />
                    <label class="form-check-label" for="sma_ips">SMA/MA-IPS</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="asal_slta" id="smk_tkj" value="SMK-TKJ" />
                    <label class="form-check-label" for="smk_tkj">SMK-TKJ</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="asal_slta" id="smk_rpl" value="SMK-RPL" />
                    <label class="form-check-label" for="smk_rpl">SMK-RPL</label>
                </div>
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label">Ukuran Toga (jika wisuda) <span class="text-danger">*</span></label>
            <div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="ukuran_toga" id="xs" value="XS" required />
                    <label class="form-check-label" for="xs">XS</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="ukuran_toga" id="s" value="S" />
                    <label class="form-check-label" for="s">S</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="ukuran_toga" id="m" value="M" />
                    <label class="form-check-label" for="m">M</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="ukuran_toga" id="l" value="L" />
                    <label class="form-check-label" for="l">L</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="ukuran_toga" id="xl" value="XL" />
                    <label class="form-check-label" for="xl">XL</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="ukuran_toga" id="xxl" value="XXL" />
                    <label class="form-check-label" for="xxl">XXL</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="ukuran_toga" id="xxxl" value="XXXL" />
                    <label class="form-check-label" for="xxxl">XXXL</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="ukuran_toga" id="xxxxl" value="XXXXL" />
                    <label class="form-check-label" for="xxxxl">XXXXL</label>
                </div>
            </div>
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
            <label class="form-label d-block">Tema Skripsi <span class="text-danger">*</span></label>
            
            <div class="form-check">
                <input class="form-check-input" type="radio" name="tema_skripsi" id="tema_ai" value="Applied AI" required>
                <label class="form-check-label" for="tema_ai">Applied AI</label>
            </div>
            
            <div class="form-check">
                <input class="form-check-input" type="radio" name="tema_skripsi" id="tema_sd" value="Software Development">
                <label class="form-check-label" for="tema_sd">Software Development</label>
            </div>
            
            <div class="form-check">
                <input class="form-check-input" type="radio" name="tema_skripsi" id="tema_gd" value="Game Development">
                <label class="form-check-label" for="tema_gd">Game Development</label>
            </div>
            
            <div class="form-check">
                <input class="form-check-input" type="radio" name="tema_skripsi" id="tema_da" value="Data Analytic">
                <label class="form-check-label" for="tema_da">Data Analytic</label>
            </div>
            
            <div class="form-check">
                <input class="form-check-input" type="radio" name="tema_skripsi" id="tema_cs" value="Cyber Security">
                <label class="form-check-label" for="tema_cs">Cyber Security</label>
            </div>
            
            <div class="form-check">
                <input class="form-check-input" type="radio" name="tema_skripsi" id="tema_iot" value="IOT">
                <label class="form-check-label" for="tema_iot">IOT</label>
            </div>
        </div>

        


        <!-- Upload File -->
        <div class="mb-3">
            <label class="form-label">Naskah</label>
            <input type="file" name="naskah" class="form-control" required>
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
</div>

@include('layouts.footer')

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
