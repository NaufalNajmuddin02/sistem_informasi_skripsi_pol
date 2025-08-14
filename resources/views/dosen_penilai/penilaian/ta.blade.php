<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SISTA - Penilaian</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
    html, body {
        height: 100%;
        margin: 0;
    }

    body {
        display: flex;
        flex-direction: column;
    }

    main {
        flex: 1;
    }
</style>
</head>
<body>
    @include('layouts.navbar-penilai')
    <!-- Main Content -->
    <div class="container my-4">
        <div class="d-flex align-items-center mb-3">
            <h1 class="me-3 mb-0">Penilaian Penguji</h1>
        </div>
        <div class="mb-3">
            <label class="form-label">Sebagai:</label>
            <select name="penguji" class="form-select" id="selectPenguji" required>
                <option value="">-- Pilih Posisi --</option>
                <option value="1">Ketua Penguji</option>
                <option value="2">Penguji 1</option>
                <option value="3">Penguji 2</option>
            </select>
        </div>

        <br>
    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('dosen-penilai.ketua') }}" id="formPenilai1" style="display: none;">

        <h2>Form Ketua Penguji </h2>
    @csrf
        <div class="mb-3">
            <label class="form-label">Nama Mahasiswa:</label>
            <select id="nama_mahasiswa_ketua" name="nama_mahasiswa" class="form-control" required>
                <option value="" disabled selected>-- Pilih Mahasiswa --</option>
                @foreach($mahasiswa as $mhs)
                    <option 
                        value="{{ $mhs->nama }}" 
                        data-nim="{{ $mhs->nim }}" 
                        data-judul="{{ $mhs->judul_skripsi }}">
                        {{ $mhs->nama }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">NIM:</label>
            <input type="text" id="nim_ketua" name="nim" class="form-control" required readonly>
        </div>

        <div class="mb-3">
            <label class="form-label">Judul Tugas Akhir:</label>
            <input type="text" id="judul_ketua" name="judul" class="form-control" required readonly>
        </div>
        <h3>1. Presentasi</h3>
        <div class="mb-3">
            <label class="form-label">Sikap, komunikasi, dan penampilan. <b> 5 (Bobot)</b></label>
            <input type="number" name="sikap_kp" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Mampu menjelaskan alasan pengambilan topik penelitian. <b> 5 (Bobot)</b></label>
            <input type="number" name="mampu_menjelaskan_topik_kp" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Mampu menjelaskan setiap bagian/menu produk atau hasil. <b> 15 (Bobot)</b></label>
            <input type="number" name="mampu_menjelaskan_hasil_kp" class="form-control" required>
        </div>
        <h3>2. Produk</h3>
        <div class="mb-3">
            <label class="form-label">Produk dapat disimulasikan dan atau telah diimplementasikan. <b> 20 (Bobot)</b></label>
            <input type="number" name="simulasi_produk_kp" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Produk telah diuji dengan baik .<b> 10 (Bobot)</b></label>
            <input type="number" name="pengujian_produk_kp" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Produk bermanfaat dan mampu menyelesaikan masalah(solutif). <b> 15 (Bobot)</b></label>
            <input type="number" name="produk_bermanfaat_kp" class="form-control" required>
        </div>
         <div class="mb-3">
            <label class="form-label">Kejelasan proses bisnis dan komplesitas produk. <b> 10 (Bobot)</b></label>
            <input type="number" name="kejelasan_proses_kp" class="form-control" required>
        </div>
        <h3>3. Laporan</h3>
        <div class="mb-3">
            <label class="form-label">Susunan laporan sesuai format panduan. <b> 5 (Bobot)</b></label>
            <input type="number" name="susunan_laporan_kp" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Isi laporan sesuai dengan produk penelitian. <b> 10 (Bobot)</b></label>
            <input type="number" name="isi_laporan_kp" class="form-control" required>
        </div>
         <div class="mb-3">
            <label class="form-label">Kualitas penulisan (gramatika, ejaan, sitasi, penulisan pustaka, dll). <b> 5 (Bobot)</b></label>
            <input type="number" name="kualitas_penulisan_kp" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Status Sidang:</label>
            <select name="status_sidang_kp" class="form-control" required>
                <option value="">-- Pilih Status --</option>
                <option value="lolos">Lolos</option>
                <option value="tidak_lolos">Tidak Lolos</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>       
    <form method="POST" action="{{ route('dosen-penilai.penguji1') }}" id="formPenilai2" style="display: none;">
    <h2>Form Penguji 1</h2>
    @csrf
        <div class="mb-3">
            <label class="form-label">Nama Mahasiswa:</label>
            <select id="nama_mahasiswa_penguji1" name="nama_mahasiswa" class="form-control" required>
                <option value="" disabled selected>-- Pilih Mahasiswa --</option>
                @foreach($mahasiswa as $mhs)
                    <option 
                        value="{{ $mhs->nama }}" 
                        data-nim="{{ $mhs->nim }}" 
                        data-judul="{{ $mhs->judul_skripsi }}">
                        {{ $mhs->nama }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">NIM:</label>
            <input type="text" id="nim_penguji1" name="nim" class="form-control" required readonly>
        </div>

        <div class="mb-3">
            <label class="form-label">Judul Tugas Akhir:</label>
            <input type="text" id="judul_penguji1" name="judul" class="form-control" required readonly>
        </div>
        <h3>1. Presentasi</h3>
        <div class="mb-3">
            <label class="form-label">Sikap, komunikasi, dan penampilan. <b> 5 (Bobot)</b></label>
            <input type="text" name="sikap_p1" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Mampu menjelaskan alasan pengambilan topik penelitian. <b> 5 (Bobot)</b></label>
            <input type="text" name="mampu_menjelaskan_topik_p1" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Mampu menjelaskan setiap bagian/menu produk atau hasil. <b> 15 (Bobot)</b></label>
            <input type="text" name="mampu_menjelaskan_hasil_p1" class="form-control" required>
        </div>
        <h3>2. Produk</h3>
        <div class="mb-3">
            <label class="form-label">Produk dapat disimulasikan dan atau telah diimplementasikan. <b> 20 (Bobot)</b></label>
            <input type="text" name="simulasi_produk_p1" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Produk telah diuji dengan baik .<b> 10 (Bobot)</b></label>
            <input type="text" name="pengujian_produk_p1" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Produk bermanfaat dan mampu menyelesaikan masalah(solutif). <b> 15 (Bobot)</b></label>
            <input type="text" name="produk_bermanfaat_p1" class="form-control" required>
        </div>
         <div class="mb-3">
            <label class="form-label">Kejelasan proses bisnis dan komplesitas produk. <b> 10 (Bobot)</b></label>
            <input type="text" name="kejelasan_proses_p1" class="form-control" required>
        </div>
        <h3>3. Laporan</h3>
        <div class="mb-3">
            <label class="form-label">Susunan laporan sesuai format panduan. <b> 5 (Bobot)</b></label>
            <input type="text" name="susunan_laporan_p1" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Isi laporan sesuai dengan produk penelitian. <b> 10 (Bobot)</b></label>
            <input type="text" name="isi_laporan_p1" class="form-control" required>
        </div>
         <div class="mb-3">
            <label class="form-label">Kualitas penulisan (gramatika, ejaan, sitasi, penulisan pustaka, dll). <b> 5 (Bobot)</b></label>
            <input type="text" name="kualitas_penulisan_p1" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>       

    <form method="POST" action="{{ route('dosen-penilai.penguji2') }}" id="formPenilai3" style="display: none;">
        <h2>Form Penguji 2</h2>
    @csrf
        <div class="mb-3">
            <label class="form-label">Nama Mahasiswa:</label>
            <select id="nama_mahasiswa_penguji2" name="nama_mahasiswa" class="form-control" required>
                <option value="" disabled selected>-- Pilih Mahasiswa --</option>
                @foreach($mahasiswa as $mhs)
                    <option 
                        value="{{ $mhs->nama }}" 
                        data-nim="{{ $mhs->nim }}" 
                        data-judul="{{ $mhs->judul_skripsi }}">
                        {{ $mhs->nama }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">NIM:</label>
            <input type="text" id="nim_penguji2" name="nim" class="form-control" required readonly>
        </div>

        <div class="mb-3">
            <label class="form-label">Judul Tugas Akhir:</label>
            <input type="text" id="judul_penguji2" name="judul" class="form-control" required readonly>
        </div>
        <h3>1. Presentasi</h3>
        <div class="mb-3">
            <label class="form-label">Sikap, komunikasi, dan penampilan. <b> 5 (Bobot)</b></label>
            <input type="text" name="sikap_p2" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Mampu menjelaskan alasan pengambilan topik penelitian. <b> 5 (Bobot)</b></label>
            <input type="text" name="mampu_menjelaskan_topik_p2" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Mampu menjelaskan setiap bagian/menu produk atau hasil. <b> 15 (Bobot)</b></label>
            <input type="text" name="mampu_menjelaskan_hasil_p2" class="form-control" required>
        </div>
        <h3>2. Produk</h3>
        <div class="mb-3">
            <label class="form-label">Produk dapat disimulasikan dan atau telah diimplementasikan. <b> 20 (Bobot)</b></label>
            <input type="text" name="simulasi_produk_p2" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Produk telah diuji dengan baik .<b> 10 (Bobot)</b></label>
            <input type="text" name="pengujian_produk_p2" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Produk bermanfaat dan mampu menyelesaikan masalah(solutif). <b> 15 (Bobot)</b></label>
            <input type="text" name="produk_bermanfaat_p2" class="form-control" required>
        </div>
         <div class="mb-3">
            <label class="form-label">Kejelasan proses bisnis dan komplesitas produk. <b> 10 (Bobot)</b></label>
            <input type="text" name="kejelasan_proses_p2" class="form-control" required>
        </div>
        <h3>3. Laporan</h3>
        <div class="mb-3">
            <label class="form-label">Susunan laporan sesuai format panduan. <b> 5 (Bobot)</b></label>
            <input type="text" name="susunan_laporan_p2" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Isi laporan sesuai dengan produk penelitian. <b> 10 (Bobot)</b></label>
            <input type="text" name="isi_laporan_p2" class="form-control" required>
        </div>
         <div class="mb-3">
            <label class="form-label">Kualitas penulisan (gramatika, ejaan, sitasi, penulisan pustaka, dll). <b> 5 (Bobot)</b></label>
            <input type="text" name="kualitas_penulisan_p2" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>    
    </div>

    

    <!-- Bootstrap JS and Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
     <script>
    document.getElementById('selectPenguji').addEventListener('change', function() {
        const value = this.value;

        // Sembunyikan semua form terlebih dahulu
        document.getElementById('formPenilai1').style.display = 'none';
        document.getElementById('formPenilai2').style.display = 'none';
        document.getElementById('formPenilai3').style.display = 'none';

        // Tampilkan form sesuai pilihan
        if (value === '1') {
            document.getElementById('formPenilai1').style.display = 'block';
        } else if (value === '2') {
            document.getElementById('formPenilai2').style.display = 'block';
        } else if (value === '3') {
            document.getElementById('formPenilai3').style.display = 'block';
        }
    });
</script>
<script>
document.getElementById('nama_mahasiswa_ketua').addEventListener('change', function() {
    const opt = this.options[this.selectedIndex];
    document.getElementById('nim_ketua').value = opt.dataset.nim || '';
    document.getElementById('judul_ketua').value = opt.dataset.judul || '';
});
</script>

<!-- Penguji 1 -->
<script>
document.getElementById('nama_mahasiswa_penguji1').addEventListener('change', function() {
    const opt = this.options[this.selectedIndex];
    document.getElementById('nim_penguji1').value = opt.dataset.nim || '';
    document.getElementById('judul_penguji1').value = opt.dataset.judul || '';
});
</script>

<!-- Penguji 2 -->
<script>
document.getElementById('nama_mahasiswa_penguji2').addEventListener('change', function() {
    const opt = this.options[this.selectedIndex];
    document.getElementById('nim_penguji2').value = opt.dataset.nim || '';
    document.getElementById('judul_penguji2').value = opt.dataset.judul || '';
});
</script>

    </script>


@include('layouts.footer')
</body>
</html>