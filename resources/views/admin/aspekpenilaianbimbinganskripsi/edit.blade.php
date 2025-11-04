<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Edit Penilaian Bimbingan Skripsi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
</head>
<body class="d-flex flex-column min-vh-100">
    @include('layouts.navbar-admin')

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h3 class="card-title mb-4">Edit Penilaian Bimbingan Skripsi</h3>

                        @if(session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif

                        <form action="{{ route('penilaian.skripsi.update', $aspek->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label">Unsur Yang Dinilai</label>
                                <div class="col-sm-9">
                                    <input type="text" name="unsur_yang_dinilai" 
                                           value="{{ old('unsur_yang_dinilai', $aspek->unsur_yang_dinilai) }}" 
                                           class="form-control" required>
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label">Kriteria</label>
                                <div class="col-sm-9">
                                    <input type="text" name="kriteria" 
                                           value="{{ old('kriteria', $aspek->kriteria) }}" 
                                           class="form-control" required>
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label">Bobot</label>
                                <div class="col-sm-9">
                                    <select name="bobot" class="form-control" required>
                                        @for ($i = 1; $i <= 20; $i++)
                                            <option value="{{ $i }}" {{ $aspek->bobot == $i ? 'selected' : '' }}>
                                                {{ $i }}
                                            </option>
                                        @endfor
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-9 offset-sm-3">
                                    <a href="{{ route('penilaian.hki.index') }}" class="btn btn-secondary">
                                        <i class="fas fa-arrow-left"></i> Batal
                                    </a>
                                    <button type="submit" class="btn btn-success">
                                        <i class="fas fa-save"></i> Update
                                    </button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('layouts.footer')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
