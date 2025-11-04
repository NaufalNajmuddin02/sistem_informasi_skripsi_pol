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
    <h2>Upload Berkas Tugas Akhir</h2>  
    <form action="{{ route('mahasiswa.update.pendaftaran', $data->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    
    <!-- Tampilkan error validasi -->
    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
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
            <input type="text" class="form-control" id="judul_skripsi" name="judul_skripsi" value="{{ $data->judul_skripsi }}" />
        </div>
        
        <div class="mb-3">
            <label class="form-label" for="email">Email</label>
            <input type="text" class="form-control" id="email" name="email" value="{{ $data->email }}" />
        </div>
        <div class="mb-3">
            <label class="form-label" for="nomor_wa">Nomor WA</label>
            <input type="text" class="form-control" id="nomor_wa" name="nomor_wa" value="{{ $data->nomor_wa }}" />
        </div>
        @php
            $currentJenisLaporan = old('jenis_laporan', $data->jenis_laporan ?? '');
        @endphp

        <div class="form-group mb-3">
            <label for="jenis_laporan" class="form-label d-block mb-2">Jenis Laporan</label>
            <select name="jenis_laporan" id="jenis_laporan" class="form-select" required>
                <option value="" disabled {{ $currentJenisLaporan == null ? 'selected' : '' }}>Pilih Jenis Laporan</option>
                <option value="Dengan Luaran HKI"   {{ $currentJenisLaporan == 'Dengan Luaran HKI' ? 'selected' : '' }}>Dengan Luaran HKI</option>
                <option value="Tanpa Luaran HKI"   {{ $currentJenisLaporan == 'Tanpa Luaran HKI' ? 'selected' : '' }}>Tanpa Luaran HKI</option>
                <option value="Lainnya"            {{ $currentJenisLaporan == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
            </select>
        </div>




        <div class="mb-3">
            <label class="form-label" for="nik_ktp">NIK KTP</label>
            <input type="text" class="form-control" id="nik_ktp" name="nik_ktp" value="{{ $data->nik_ktp }}" />
        </div>
        <div class="mb-3">
            <label class="form-label" for="tanggal_lahir">Tanggal Lahir</label>
            <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" 
                value="{{ old('tanggal_lahir', isset($data->tanggal_lahir) ? \Carbon\Carbon::parse($data->tanggal_lahir)->format('Y-m-d') : '') }}" />
        </div>

        <div class="mb-3">
            <label class="form-label" for="alamat">Alamat</label>
            <input type="text" class="form-control" id="alamat" name="alamat" value="{{ $data->alamat }}" />
        </div>
        <div class="mb-3">
            <label class="form-label" for="kota">Kota</label>
            <input type="text" class="form-control" id="kota" name="kota" value="{{ $data->kota }}" />
        </div>
        <div class="mb-3">
            <label class="form-label" for="nama_ayah">Nama Ayah</label>
            <input type="text" class="form-control" id="nama_ayah" name="nama_ayah" value="{{ $data->nama_ayah }}" />
        </div>
        <div class="mb-3">
            <label class="form-label" for="nama_ibu">Nama Ibu</label>
            <input type="text" class="form-control" id="nama_ibu" name="nama_ibu" value="{{ $data->nama_ibu }}" />
        </div>
       @php
            $currentAsalSlta = old('asal_slta', $data->asal_slta ?? '');
        @endphp

        <div class="mb-3">
            <label for="asal_slta" class="form-label d-block mb-2">Asal SLTA <span class="text-danger">*</span></label>
            <select name="asal_slta" id="asal_slta" class="form-select" required>
                <option value="" disabled {{ $currentAsalSlta == '' ? 'selected' : '' }}>Pilih Asal SLTA</option>
                <option value="SMA/MA-IPA" {{ $currentAsalSlta == 'SMA/MA-IPA' ? 'selected' : '' }}>SMA/MA-IPA</option>
                <option value="SMA/MA-IPS" {{ $currentAsalSlta == 'SMA/MA-IPS' ? 'selected' : '' }}>SMA/MA-IPS</option>
                <option value="SMK-TKJ"    {{ $currentAsalSlta == 'SMK-TKJ'    ? 'selected' : '' }}>SMK-TKJ</option>
                <option value="SMK-RPL"    {{ $currentAsalSlta == 'SMK-RPL'    ? 'selected' : '' }}>SMK-RPL</option>
            </select>
        </div>

       @php
            $currentUkuranToga = old('ukuran_toga', $data->ukuran_toga ?? '');
        @endphp

        <div class="mb-3">
            <label for="ukuran_toga" class="form-label d-block mb-2">Ukuran Toga (jika wisuda) <span class="text-danger">*</span></label>
            <select name="ukuran_toga" id="ukuran_toga" class="form-select" required>
                <option value="" disabled {{ $currentUkuranToga == '' ? 'selected' : '' }}>Pilih Ukuran Toga</option>
                <option value="XS"    {{ $currentUkuranToga == 'XS'    ? 'selected' : '' }}>XS</option>
                <option value="S"     {{ $currentUkuranToga == 'S'     ? 'selected' : '' }}>S</option>
                <option value="M"     {{ $currentUkuranToga == 'M'     ? 'selected' : '' }}>M</option>
                <option value="L"     {{ $currentUkuranToga == 'L'     ? 'selected' : '' }}>L</option>
                <option value="XL"    {{ $currentUkuranToga == 'XL'    ? 'selected' : '' }}>XL</option>
                <option value="XXL"   {{ $currentUkuranToga == 'XXL'   ? 'selected' : '' }}>XXL</option>
                <option value="XXXL"  {{ $currentUkuranToga == 'XXXL'  ? 'selected' : '' }}>XXXL</option>
                <option value="XXXXL" {{ $currentUkuranToga == 'XXXXL' ? 'selected' : '' }}>XXXXL</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label" for="pembimbing_1">Nama Pembimbing 1</label>
            <input type="text" class="form-control" id="pembimbing_1" name="pembimbing_1" 
value="{{ $data->nama_pembimbing_1 }}" />
        </div>
        <div class="mb-3">
            <label class="form-label" for="pembimbing_2">Nama Pembimbing 2</label>
            <input type="text" class="form-control" id="pembimbing_2" name="pembimbing_2" 
value="{{ $data->nama_pembimbing_2 }}" />
        </div>
        @php
            $currentTema = old('tema_skripsi', $data->tema_skripsi ?? '');
        @endphp

        <div class="mb-3">
            <label for="tema_skripsi" class="form-label d-block mb-2">Tema Skripsi <span class="text-danger">*</span></label>
            <select name="tema_skripsi" id="tema_skripsi" class="form-select" required>
                <option value="" disabled {{ $currentTema == '' ? 'selected' : '' }}>Pilih Tema Skripsi</option>
                <option value="Applied AI"            {{ $currentTema == 'Applied AI' ? 'selected' : '' }}>Applied AI</option>
                <option value="Software Development"  {{ $currentTema == 'Software Development' ? 'selected' : '' }}>Software Development</option>
                <option value="Game Development"      {{ $currentTema == 'Game Development' ? 'selected' : '' }}>Game Development</option>
                <option value="Data Analytic"         {{ $currentTema == 'Data Analytic' ? 'selected' : '' }}>Data Analytic</option>
                <option value="Cyber Security"        {{ $currentTema == 'Cyber Security' ? 'selected' : '' }}>Cyber Security</option>
                <option value="IOT"                   {{ $currentTema == 'IOT' ? 'selected' : '' }}>IOT</option>
            </select>
        </div>


        {{-- Hasil Plagiasi --}}
        <div class="mb-3">
            <label class="form-label">Hasil Plagiasi</label>
            @if (!empty($data->hasil_plagiasi))
                <p><a href="{{ asset($data->hasil_plagiasi) }}" target="_blank">Lihat Hasil Plagiasi</a></p>
            @endif
            <input type="file" name="hasil_plagiasi" class="form-control">
        </div>

        {{-- Bukti Pembayaran --}}
        <div class="mb-3">
            <label class="form-label">Bukti Pembayaran</label>
            @if (!empty($data->bukti_pembayaran))
                <p><a href="{{ asset($data->bukti_pembayaran) }}" target="_blank">Lihat Bukti Pembayaran</a></p>
            @endif
            <input type="file" name="bukti_pembayaran" class="form-control">
        </div>

        {{-- Skor TOEFL --}}
        <div class="mb-3">
            <label class="form-label">Skor TOEFL</label>
            @if (!empty($data->skor_toefl))
                <p><a href="{{ asset($data->skor_toefl) }}" target="_blank">Lihat Skor TOEFL</a></p>
            @endif
            <input type="file" name="skor_toefl" class="form-control">
        </div>

        {{-- Ijazah SMA --}}
        <div class="mb-3">
            <label class="form-label">Ijazah SMA</label>
            @if (!empty($data->ijazah_sma))
                <p><a href="{{ asset($data->ijazah_sma) }}" target="_blank">Lihat Ijazah SMA</a></p>
            @endif
            <input type="file" name="ijazah_sma" class="form-control">
        </div>

        {{-- KTP --}}
        <div class="mb-3">
            <label class="form-label">KTP</label>
            @if (!empty($data->ktp))
                <p><a href="{{ asset($data->ktp) }}" target="_blank">Lihat KTP</a></p>
            @endif
            <input type="file" name="ktp" class="form-control">
        </div>

        {{-- KK --}}
        <div class="mb-3">
            <label class="form-label">Kartu Keluarga (KK)</label>
            @if (!empty($data->kk))
                <p><a href="{{ asset($data->kk) }}" target="_blank">Lihat KK</a></p>
            @endif
            <input type="file" name="kk" class="form-control">
        </div>
          {{-- KK --}}
        <div class="mb-3">
            <label class="form-label">Surat Rekomendasi (KK)</label>
            @if (!empty($data->kk))
                <p><a href="{{ asset($data->surat_rekomendasi) }}" target="_blank">Lihat KK</a></p>
            @endif
            <input type="file" name="surat_rekomendasi" class="form-control">
        </div>
       <div class="d-flex justify-content-end mb-5">
        <button type="submit" class="btn btn-primary">Update Data</button>
    </div>
    </form>
</div>
@include('layouts.footer')

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
