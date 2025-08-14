<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SISTA - Jadwal Yudisium</title>
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
    @include('layouts.navbar-pembimbing')
    <!-- Main Content -->
    <div class="container my-4">
        <div class="d-flex align-items-center mb-3">
            <h1 class="me-3 mb-0">Edit Penilaian Penguji 2</h1>
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

    <form action="{{ route('dosen-pembimbing.updatePenguji2', $mahasiswa->id) }}" method="POST">
    @csrf
    @method('PUT')
        <div class="mb-3">
            <label class="form-label">Nama Mahasiswa:</label>
            <input type="text" name="nama_mahasiswa" value ="{{ $mahasiswa->nama_mahasiswa }}" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">NIM:</label>
            <input type="text" name="nim" class="form-control" value ="{{ $mahasiswa->nim }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Judul Tugas Akhir:</label>
            <input type="text" name="judul" value ="{{ $mahasiswa->judul }}" class="form-control" required>
        </div>
        <h3>1. Presentasi</h3>
        <div class="mb-3">
            <label class="form-label">Sikap, komunikasi, dan penampilan. <b> 5 (Bobot)</b></label>
            <input type="number" name="sikap_kp" value ="{{ $mahasiswa->sikap_penguji2/5 }}" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Mampu menjelaskan alasan pengambilan topik penelitian. <b> 5 (Bobot)</b></label>
            <input type="number" name="mampu_menjelaskan_topik_kp" value="{{ $mahasiswa->mampu_menjelaskan_topik_penguji2/5 }}" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Mampu menjelaskan setiap bagian/menu produk atau hasil. <b> 15 (Bobot)</b></label>
            <input type="number" name="mampu_menjelaskan_hasil_kp" value="{{ $mahasiswa->mampu_menjelaskan_hasil_penguji2/15 }}" class="form-control" required>
        </div>
        <h3>2. Produk</h3>
        <div class="mb-3">
            <label class="form-label">Produk dapat disimulasikan dan atau telah diimplementasikan. <b> 20 (Bobot)</b></label>
            <input type="number" name="simulasi_produk_kp" value="{{ $mahasiswa->simulasi_produk_penguji2/20 }}" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Produk telah diuji dengan baik .<b> 10 (Bobot)</b></label>
            <input type="number" name="pengujian_produk_kp" class="form-control" value="{{ $mahasiswa->pengujian_produk_penguji2/10 }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Produk bermanfaat dan mampu menyelesaikan masalah(solutif). <b> 15 (Bobot)</b></label>
            <input type="number" name="produk_bermanfaat_kp" class="form-control" value="{{ $mahasiswa->produk_bermanfaat_penguji2/15 }}"  required>
        </div>
         <div class="mb-3">
            <label class="form-label">Kejelasan proses bisnis dan komplesitas produk. <b> 10 (Bobot)</b></label>
            <input type="number" name="kejelasan_proses_kp" class="form-control" value="{{ $mahasiswa->kejelasan_proses_penguji2/10 }}" required>
        </div>
        <h3>3. Laporan</h3>
        <div class="mb-3">
            <label class="form-label">Susunan laporan sesuai format panduan. <b> 5 (Bobot)</b></label>
            <input type="number" name="susunan_laporan_kp" class="form-control" value="{{ $mahasiswa->susunan_laporan_penguji2/5 }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Isi laporan sesuai dengan produk penelitian. <b> 10 (Bobot)</b></label>
            <input type="number" name="isi_laporan_kp" class="form-control" value="{{ $mahasiswa->isi_laporan_penguji2/10 }}" required>
        </div>
         <div class="mb-3">
            <label class="form-label">Kualitas penulisan (gramatika, ejaan, sitasi, penulisan pustaka, dll). <b> 5 (Bobot)</b></label>
            <input type="number" name="kualitas_penulisan_kp" value="{{ $mahasiswa->kualitas_penulisan_penguji2/5 }}" class="form-control" required>
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

    </script>


@include('layouts.footer')
</body>
</html>