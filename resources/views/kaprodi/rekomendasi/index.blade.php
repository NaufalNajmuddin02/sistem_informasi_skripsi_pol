<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Rekomendasi Seminar</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" />
</head>
<body class="d-flex flex-column min-vh-100">
  @include('layouts.navbar-kaprodi')

  <div class="container mt-4">
    <div class="d-flex align-items-center mb-3">
      <h1 class="me-3 mb-0">Daftar Rekomendasi Mahasiswa</h1>
      <span class="text-muted">Membuat rekomendasi sidang mahasiswa</span>
    </div>
    <hr>

    <!-- Card Search -->
    <div class="card mb-3 shadow-sm">
      <div class="card-body py-2 px-3">
        <form action="{{ route('kaprodi.rekomendasi.index') }}" method="GET" class="row g-2 align-items-center">
          <div class="col-md-9 col-sm-12">
            <input
              type="text"
              name="search"
              class="form-control"
              placeholder="Cari mahasiswa atau judul skripsi..."
              value="{{ request('search') }}"
            />
          </div>
          <div class="col-md-3 col-sm-12">
            <button type="submit" class="btn btn-outline-primary w-100">
              <i class="bi bi-search"></i> Cari
            </button>
          </div>
        </form>
      </div>
    </div>


    <!-- Looping Data Seminar -->
    @foreach ($seminars as $seminar)
      <div class="card mb-4 shadow-sm">
        <div class="card-body">
          <h5 class="card-title">{{ $seminar->name }}</h5>
          <p class="card-text text-muted">{{ $seminar->script_title }}</p>

          <form action="{{ url('/rekomendasi/store/' . $seminar->id) }}" method="POST">
            @csrf

            @if ($seminar->dosen_penilai_1 == auth()->id())
              <div class="mb-3">
                <label for="rekomendasi_1_{{ $seminar->id }}" class="form-label">Rekomendasi Dosen 1:</label>
                <select name="rekomendasi_1" id="rekomendasi_1_{{ $seminar->id }}" class="form-select">
                  <option value="menunggu" {{ $seminar->rekomendasi_dosen_1 == 'menunggu' ? 'selected' : '' }}>Menunggu</option>
                  <option value="direkomendasikan" {{ $seminar->rekomendasi_dosen_1 == 'direkomendasikan' ? 'selected' : '' }}>Direkomendasikan</option>
                </select>
              </div>
            @elseif ($seminar->dosen_penilai_2 == auth()->id())
              <div class="mb-3">
                <label for="rekomendasi_2_{{ $seminar->id }}" class="form-label">Rekomendasi Dosen 2:</label>
                <select name="rekomendasi_2" id="rekomendasi_2_{{ $seminar->id }}" class="form-select">
                  <option value="menunggu" {{ $seminar->rekomendasi_dosen_2 == 'menunggu' ? 'selected' : '' }}>Menunggu</option>
                  <option value="direkomendasikan" {{ $seminar->rekomendasi_dosen_2 == 'direkomendasikan' ? 'selected' : '' }}>Direkomendasikan</option>
                </select>
              </div>
            @endif

            <div class="d-grid d-md-flex justify-content-md-end">
              <button type="submit" class="btn btn-primary">
                <i class="bi bi-save"></i> Simpan
              </button>
            </div>
          </form>
        </div>
      </div>
    @endforeach

  </div>

  @include('layouts.footer')

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
