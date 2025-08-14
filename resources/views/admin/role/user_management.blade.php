<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Manajemen Role Pengguna</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
</head>
<body class="d-flex flex-column min-vh-100">
    @include('layouts.navbar-admin')

    <div class="container mt-5">
        <div class="d-flex align-items-center mb-3">
            <h1 class="me-3 mb-0">Manajemen Role Dosen</h1>
            <span class="text-muted">Halaman untuk memperbarui role</span>
        </div>
        <hr>
        <form method="POST" action="{{ route('users.bulkUpdateRole') }}" id="bulkRoleForm">
            @csrf

            {{-- Tombol di kanan atas tabel --}}
            <div class="d-flex justify-content-end mb-3">
                <button type="button" class="btn btn-primary" id="openModalBtn">
                    <i class="fas fa-user-edit me-1"></i> Ubah Role Pengguna Terpilih
                </button>
            </div>

            <div class="table-responsive">
                <table class="table table-bordered align-middle">
                    <thead class="table-primary">
                        <tr>
                            <th><input type="checkbox" id="checkAll"> Pilih</th>
                            <th><i class="fas fa-user"></i> Username</th>
                            <th><i class="fas fa-envelope"></i> Email</th>
                            <th><i class="fas fa-user-tag"></i> Role Sekarang</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                        <tr>
                            <td>
                                <input type="checkbox" name="selected_users[]" value="{{ $user->id }}" class="form-check-input">
                            </td>
                            <td>{{ $user->username }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ ucfirst($user->role) }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- Modal --}}
            <div class="modal fade" id="roleModal" tabindex="-1" aria-labelledby="roleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Ubah Role</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                        </div>
                        <div class="modal-body">
                            <label for="selectedRole" class="form-label">Pilih Role Baru:</label>
                            <select name="new_role" id="selectedRole" class="form-select" required>
                                <option value="">-- Pilih Role --</option>
                                <option value="admin">Admin</option>
                                <option value="dosen">Dosen</option>
                                <option value="kaprodi">Kaprodi</option>
                                <option value="dosen_penilai">Dosen Penilai</option>
                                <option value="dosen_pembimbing">Dosen Pembimbing</option>
                            </select>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success">
                                <i class="fas fa-save me-1"></i> Simpan Perubahan
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>



        <div class="d-flex justify-content-center mt-3">
            {{ $users->links() }}
        </div>
    </div>
    @include('layouts.footer')


    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById('checkAll').addEventListener('change', function () {
            document.querySelectorAll('input[name="selected_users[]"]').forEach(cb => cb.checked = this.checked);
        });

        document.getElementById('openModalBtn').addEventListener('click', function () {
            const selected = document.querySelectorAll('input[name="selected_users[]"]:checked');
            if (selected.length === 0) {
                alert("Silakan pilih minimal satu pengguna untuk mengubah role.");
                return;
            }
            new bootstrap.Modal(document.getElementById('roleModal')).show();
        });
    </script>

</body>
</html>