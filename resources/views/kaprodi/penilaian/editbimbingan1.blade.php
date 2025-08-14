<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SISTA - Penilaian</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>
<body class="d-flex flex-column min-vh-100">
    @include('layouts.navbar-kaprodi')
    <!-- Main Content -->
    <div class="container my-4">
        <div class="d-flex align-items-center mb-3">
            <h1 class="me-3 mb-0">Edit Penilaian Pembimbing 1</h1>
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

    <form method="POST" action="{{ route('penilaian.updatepembimbing1', $mahasiswa->id) }}" id="formPembimbing1">
    @method('PUT')
    @csrf
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

        <h3>1. Proses Pelaksana</h3>
        <div class="mb-3">
            <label class="form-label">Pelaksanaan bimbingan sesuai surat kesepakatan. <b> 5 (Bobot)</b></label>
            <input type="text" name="pelaksanaan_bimbingan_p1" value ="{{ $mahasiswa->pelaksanaan_bimbingan_p1/5 }}" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Daya kritis/kreativitas. <b> 10 (Bobot)</b></label>
            <input type="text" name="daya_kritis_p1" class="form-control" value ="{{ $mahasiswa->daya_kritis_p1/10 }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Sikap/perilaku. <b> 5 (Bobot)</b></label>
            <input type="text" name="sikap_p1" class="form-control" value ="{{ $mahasiswa->sikap_perilaku_p1/5 }}" required>
        </div>
        <h3>2. Tujuan dan Manfaat</h3>
        <div class="mb-3">
            <label class="form-label">Tujuan utama penelitian jelas<. <b> 5 (Bobot)</b></label>
            <input type="text" name="tujuan_utama_p1" class="form-control" value ="{{ $mahasiswa->tujuan_utama_p1/5 }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Topik penelitian memiliki manfaat atau kontribusi yang jelas ke masyarakat atau ilmu pengetahuan .<b> 15 (Bobot)</b></label>
            <input type="text" name="topik_penelitian_p1" class="form-control" value ="{{ $mahasiswa->topik_penelitian_p1/15 }}" required>
        </div>
        <h3>3. Latar belakang, referensi, dan teori</h3>
        <div class="mb-3">
            <label class="form-label">Latar belakang masalah dan referensi pustaka sesuai dengan topik penelitian. <b> 5 (Bobot)</b></label>
            <input type="text" name="latar_belakang_p1" class="form-control" value ="{{ $mahasiswa->latar_belakang_p1/5 }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Teori yang dijelaskan secara lengkap. <b> 5 (Bobot)</b></label>
            <input type="text" name="teori_p1" class="form-control"  value ="{{ $mahasiswa->teori_yang_dijelaskan_p1/5 }}" required>
        </div>
        <h3>4. Desain/Metode</h3>
        <div class="mb-3">
            <label class="form-label">Desain dan perancangan sistem atau metode yang digunakan diuraikan dengan rinci, jelasm dan sistematis. <b> 15 (Bobot)</b></label>
            <input type="text" name="desain_dan_perancangan_p1" class="form-control" value ="{{ $mahasiswa->desain_dan_perancangan_p1/15 }}" required>
        </div>
        <h3>5. Hasil dan Pembahasan</h3>
        <div class="mb-3">
            <label class="form-label">Hasil sesuai dengan perancangan. <b> 5 (Bobot)</b></label>
            <input type="text" name="hasil_p1" class="form-control" value ="{{ $mahasiswa->hasil_p1/5 }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Pengujian dilakukan dengan metode yang tepat. <b> 5 (Bobot)</b></label>
            <input type="text" name="pengujian_p1" class="form-control" value ="{{ $mahasiswa->pengujian_p1/5 }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Hasil penelitian ditulis dengan detail disertai pembahasan yang komprehensif. <b> 15 (Bobot)</b></label>
            <input type="text" name="hasil_penelitian_p1" class="form-control" value ="{{ $mahasiswa->hasil_penelitian_p1/15 }}" required>
        </div>
        <h3>6. Kesimpulan dan Saran</h3>
        <div class="mb-3">
            <label class="form-label">Kesimpulan sesuai dengan tujuan dengan berdasarkan hasil pengujian dan pembahsan yang telah dilakukan. <b> 5 (Bobot)</b></label>
            <input type="text" name="kesimpulan_p1" class="form-control" value ="{{ $mahasiswa->kesimpulan_p1/5 }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Saran penelitian memuat future work yang relevan dengna mangacu hasil dan pembahasan . <b> 5 (Bobot)</b></label>
            <input type="text" name="saran_penelitian_p1" class="form-control" value ="{{ $mahasiswa->saran_penelitian_p1/5 }}" required>
        </div>


        <button type="submit" class="btn btn-primary">Simpan</button>

    </form>
    </div>

    @include('layouts.footer')

    <!-- Bootstrap JS and Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    <!-- <script>
        document.getElementById("selectPembimbing").addEventListener("change", function () {
            var selected = this.value;
            var form1 = document.getElementById("formPembimbing1");
            var form2 = document.getElementById("formPembimbing2");

            // Reset semua dulu
            form1.style.display = "none";
            form2.style.display = "none";

            // Tampilkan sesuai pilihan
            if (selected === "1") {
                form1.style.display = "block";
            } else if (selected === "2") {
                form2.style.display = "block";
            }
        });
    </script> -->
    <script>
    // Untuk Pembimbing 1
    document.getElementById('nama_mahasiswa_pembimbing1').addEventListener('change', function () {
        const selected = this.options[this.selectedIndex];
        document.getElementById('nim_pembimbing1').value = selected.getAttribute('data-nim');
        document.getElementById('judul_pembimbing1').value = selected.getAttribute('data-judul');
    });

    // Untuk Pembimbing 2
    document.getElementById('nama_mahasiswa_pembimbing2').addEventListener('change', function () {
        const selected = this.options[this.selectedIndex];
        document.getElementById('nim_pembimbing2').value = selected.getAttribute('data-nim');
        document.getElementById('judul_pembimbing2').value = selected.getAttribute('data-judul');
    });
</script>



</body>
</html>