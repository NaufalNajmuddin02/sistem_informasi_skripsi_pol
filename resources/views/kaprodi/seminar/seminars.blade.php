<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Seminar Mahasiswa</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body class="d-flex flex-column min-vh-100">
    @include('layouts.navbar-kaprodi')

    <div class="container mt-5">
        <h2 class="mb-4">Daftar Seminar Mahasiswa</h2>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <!-- Filter Form -->
        <form method="GET" class="row g-3 mb-3">
            <div class="col-md-4">
                <select name="tahun" class="form-select" onchange="this.form.submit()">
                    <option value="">-- Pilih Tahun --</option>
                    @foreach($tahunList as $th)
                        <option value="{{ $th }}" {{ $tahun == $th ? 'selected' : '' }}>{{ $th }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4">
                <select name="status" class="form-select" onchange="this.form.submit()">
                    <option value="">-- Semua Status --</option>
                    <option value="belum" {{ $status == 'belum' ? 'selected' : '' }}>Belum Dibagi</option>
                    <option value="sudah" {{ $status == 'sudah' ? 'selected' : '' }}>Sudah Dibagi</option>
                </select>
            </div>
        </form>

        <!-- Table Seminar -->
        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle">
                <thead class="table-primary text-center">
                    <tr>
                        <th>Nama Mahasiswa</th>
                        <th>Kelas</th>
                        <th>Judul Skripsi</th>
                        <th>Kategori</th>
                        <th>Dosen Penilai 1</th>
                        <th>Dosen Penilai 2</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($seminars as $seminar)
                        <tr>
                            <td>{{ $seminar->name }}</td>
                            <td>{{ $seminar->class }}</td>
                            <td>{{ $seminar->script_title }}</td>
                            <td>{{ $seminar->kategoriProposal->nama_kategori ?? '-' }}</td>
                            <td>{{ $seminar->dosen_penilai_1_nama ?? '-' }}</td>
                            <td>{{ $seminar->dosen_penilai_2_nama ?? '-' }}</td>
                            <td class="text-center">
                                @if (!$seminar->dosen_penilai_1 && !$seminar->dosen_penilai_2)
                                    <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#modalPenilai{{ $seminar->id }}">
                                        <i class="fas fa-edit"></i> Atur Penilai
                                    </button>
                                @else
                                    <span class="text-success">Sudah Dibagi</span>
                                @endif
                            </td>
                        </tr>

                        <!-- Modal Penilai -->
                        <div class="modal fade" id="modalPenilai{{ $seminar->id }}" tabindex="-1" aria-labelledby="modalLabel{{ $seminar->id }}" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <form action="{{ route('kaprodi.seminar.assign') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="assignments[0][seminar_id]" value="{{ $seminar->id }}">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="modalLabel{{ $seminar->id }}">
                                                Atur Dosen Penilai untuk {{ $seminar->name }}
                                            </h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label class="form-label">Dosen Penilai 1</label>
                                                <select name="assignments[0][penilai_1]" class="form-select penilai-1" data-seminar="{{ $seminar->id }}" required>
                                                    <option value="">-- Pilih Dosen 1 --</option>
                                                    @foreach($dosenList as $dosen)
                                                        @if($dosen->kapasitas_bimbingan > 0)
                                                            <option value="{{ $dosen->id }}">{{ $dosen->username }} ({{ $dosen->kapasitas_bimbingan }})</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Dosen Penilai 2</label>
                                                <select name="assignments[0][penilai_2]" class="form-select penilai-2" data-seminar="{{ $seminar->id }}" required>
                                                    <option value="">-- Pilih Dosen 2 --</option>
                                                    @foreach($dosenList as $dosen)
                                                        @if($dosen->kapasitas_bimbingan > 0)
                                                            <option value="{{ $dosen->id }}">{{ $dosen->username }} ({{ $dosen->kapasitas_bimbingan }})</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-success">
                                                <i class="fas fa-save me-1"></i> Simpan
                                            </button>
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                Batal
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- End Modal -->
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-3">
            {{ $seminars->appends(request()->query())->links() }}
        </div>
    </div>

    @include('layouts.footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.penilai-1').forEach(function(select1) {
            select1.addEventListener('change', function () {
                const seminarId = this.dataset.seminar;
                const selectedValue = this.value;

                // Ambil dropdown penilai 2 yang sesuai seminar
                const select2 = document.querySelector(`.penilai-2[data-seminar='${seminarId}']`);

                // Tampilkan semua opsi dulu
                select2.querySelectorAll('option').forEach(opt => {
                    opt.hidden = false;
                });

                // Sembunyikan opsi yang sama dengan yang dipilih di penilai 1
                if (selectedValue) {
                    const optionToHide = select2.querySelector(`option[value='${selectedValue}']`);
                    if (optionToHide) {
                        optionToHide.hidden = true;
                        // Jika dosen yang sama sedang dipilih, reset dropdown penilai 2
                        if (select2.value === selectedValue) {
                            select2.value = '';
                        }
                    }
                }
            });
        });
    });
</script>

</body>
</html>
