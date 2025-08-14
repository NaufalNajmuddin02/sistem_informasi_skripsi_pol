<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Dosen</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body class="d-flex flex-column min-vh-100">
    @include('layouts.navbar-kaprodi')

    <form method="POST" action="{{ route('kaprodi.bulkUpdate') }}" id="bulkUpdateForm">
        @csrf

        <div class="container mt-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="mb-0">Manajemen Dosen</h4>
                        <div class="d-flex gap-2">
                            <button type="button" class="btn btn-primary" id="openBulkModal">
                                <i class="bi bi-pencil-square me-1"></i> Ubah Role & Kapasitas
                            </button>
                            <a href="{{ route('kaprodi.seminar') }}" class="btn btn-outline-primary d-flex align-items-center">
                                <i class="bi bi-people-fill me-2"></i> Pembagian Mahasiswa Bimbingan
                            </a>
                        </div>
                    </div>

                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @elseif(session('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-bordered align-middle text-left">
                            <thead class="table-primary">
                                <tr>
                                    <th><input type="checkbox" id="checkAll"></th>
                                    <th>Nama</th>
                                    <th>Prodi</th>
                                    <th>Role Aktif</th>
                                    <th>Kapasitas Saat Ini</th>
                                    <th>Kapasitas Terpakai</th> 
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($dosenList as $dosen)
                                <tr>
                                    <td>
                                        <input type="checkbox" name="selected_dosen[]" value="{{ $dosen->id }}" class="form-check-input">
                                    </td>
                                    <td>{{ $dosen->username }}</td>
                                    <td>{{ $dosen->dosen_prodi }}</td>
                                    <td>{{ ucfirst($dosen->role) }}</td>
                                    <td>{{ $dosen->kapasitas_bimbingan }}</td>
                                    <td>{{ $dosen->kapasitas_terpakai ?? 0 }}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6">Belum ada data dosen.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Update -->
        <div class="modal fade" id="bulkModal" tabindex="-1" aria-labelledby="bulkModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Ubah Role dan Kapasitas</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="new_role" class="form-label">Pilih Role Baru (Opsional):</label>
                            <select name="new_role" id="new_role" class="form-select">
                                <option value="">-- Pilih --</option>
                                <option value="dosen">Dosen</option>
                                <option value="dosen_penilai">Dosen Penilai</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="new_kapasitas" class="form-label">Kapasitas Bimbingan (Opsional):</label>
                            <input type="number" min="0" class="form-control" name="new_kapasitas" id="new_kapasitas">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">
                            <i class="bi bi-save me-1"></i> Simpan Perubahan
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    @include('layouts.footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $('#checkAll').on('change', function () {
            $('input[name="selected_dosen[]"]').prop('checked', this.checked);
        });

        $('#openBulkModal').on('click', function () {
            const selected = $('input[name="selected_dosen[]"]:checked');
            if (selected.length === 0) {
                alert('Silakan pilih minimal satu dosen untuk diubah.');
                return;
            }
            const modal = new bootstrap.Modal(document.getElementById('bulkModal'));
            modal.show();
        });

        // Validasi sebelum submit
        document.getElementById('bulkUpdateForm').addEventListener('submit', function (e) {
            const role = document.getElementById('new_role').value.trim();
            const kapasitas = document.getElementById('new_kapasitas').value.trim();

            if (!role && !kapasitas) {
                e.preventDefault();
                alert('Silakan isi minimal Role atau Kapasitas.');
            }
        });
    </script>
</body>
</html>
