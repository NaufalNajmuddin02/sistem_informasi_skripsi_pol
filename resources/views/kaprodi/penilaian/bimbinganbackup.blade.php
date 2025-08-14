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
    @include('layouts.navbar-kaprodi')
    <!-- Main Content -->
    <div class="container my-4">
        <div class="d-flex align-items-center mb-3">
            <h1 class="me-3 mb-0">Penilaian Penguji</h1>
        </div>
        <div class="mb-3">
            <label class="form-label">Sebagai:</label>
            <select name="penguji" class="form-select" id="selectPenguji" required>
                <option value="">-- Pilih Posisi --</option>
                <option value="1">Ketua Penguji 1</option>
                <option value="2">Penguji 1</option>
                <option value="3">Penguji 2</option>
            </select>
        </div>

        <br>
    
    

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