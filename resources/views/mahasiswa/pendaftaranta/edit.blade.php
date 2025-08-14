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

        <div class="form-group">
            <label>Jenis Laporan</label>
            
            <div class="form-check">
                <input type="radio" name="jenis_laporan" id="laporan_hki" value="Dengan Luaran HKI" class="form-check-input" @checked($currentJenisLaporan == 'Dengan Luaran HKI')>
                <label for="laporan_hki" class="form-check-label">Dengan Luaran HKI</label>
            </div>

            <div class="form-check">
                <input type="radio" name="jenis_laporan" id="laporan_nonhki" value="Tanpa Luaran HKI" class="form-check-input" @checked($currentJenisLaporan == 'Tanpa Luaran HKI')>
                <label for="laporan_nonhki" class="form-check-label">Tanpa Luaran HKI</label>
            </div>

            <div class="form-check">
                <input type="radio" name="jenis_laporan" id="laporan_lainnya" value="Lainnya" class="form-check-input" @checked($currentJenisLaporan == 'Lainnya')>
                <label for="laporan_lainnya" class="form-check-label">Lainnya</label>
            </div>
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
            <label class="form-label">Asal SLTA <span class="text-danger">*</span></label>
            <div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="asal_slta" id="sma_ipa" value="SMA/MA-IPA" 
                        @checked($currentAsalSlta == 'SMA/MA-IPA') />
                    <label class="form-check-label" for="sma_ipa">SMA/MA-IPA</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="asal_slta" id="sma_ips" value="SMA/MA-IPS" 
                        @checked($currentAsalSlta == 'SMA/MA-IPS') />
                    <label class="form-check-label" for="sma_ips">SMA/MA-IPS</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="asal_slta" id="smk_tkj" value="SMK-TKJ" 
                        @checked($currentAsalSlta == 'SMK-TKJ') />
                    <label class="form-check-label" for="smk_tkj">SMK-TKJ</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="asal_slta" id="smk_rpl" value="SMK-RPL" 
                        @checked($currentAsalSlta == 'SMK-RPL') />
                    <label class="form-check-label" for="smk_rpl">SMK-RPL</label>
                </div>
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label">Ukuran Toga (jika wisuda) <span class="text-danger">*</span></label>
            <div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="ukuran_toga" id="xs" value="XS"  />
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
        <div class="mb-3">
            <label class="form-label d-block">Tema Skripsi <span class="text-danger">*</span></label>
            @php
                $currentTema = old('tema_skripsi', $data->tema_skripsi ?? '');
            @endphp

            @foreach (['Applied AI', 'Software Development', 'Game Development', 'Data Analytic', 'Cyber Security', 'IOT'] as $tema)
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="tema_skripsi" 
                        id="tema_{{ Str::slug($tema, '_') }}" 
                        value="{{ $tema }}" 
                        @checked($currentTema == $tema)>
                    <label class="form-check-label" for="tema_{{ Str::slug($tema, '_') }}">
                        {{ $tema }}
                    </label>
                </div>
            @endforeach
        </div>

        <!-- Upload File -->
       <div class="mb-3">
        <label class="form-label">Naskah</label>
        @if (!empty($data->naskah))
            <p><a href="{{ asset($data->naskah) }}" target="_blank">Lihat Naskah</a></p>
        @endif
        <input type="file" name="naskah" class="form-control">
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
