<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Manajemen Data Pengguna</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
</head>
<body class="d-flex flex-column min-vh-100">

    @include('layouts.navbar-admin')

    <div class="container mt-5">
        <div class="d-flex align-items-center mb-3">
            <h1 class="me-3 mb-0">Manajemen Data Pengguna</h1>
            <span class="text-muted">Edit Data User</span>
        </div>
        <hr>

        <form method="GET" action="{{ route('data.index') }}" class="mb-4">
            <div class="row g-2 align-items-center">
                <div class="col-md-3">
                    <select name="role" class="form-select">
                        @foreach($roles as $role)
                            <option value="{{ $role }}" {{ $selectedRole == $role ? 'selected' : '' }}>{{ ucfirst($role) }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-5">
                    <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Cari pengguna..." />
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="fas fa-search"></i> Cari
                    </button>
                </div>
                <div class="col-md-2">
                    <a href="{{ route('data.create') }}" class="btn btn-success w-100">
                        <i class="fas fa-user-plus"></i> Tambah Pengguna
                    </a>
                </div>
            </div>
        </form>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="table-responsive">
            <table class="table table-bordered align-middle">
                <thead class="table-primary">
                    <tr>
                        <th>Username</th>
                        <th>Email</th>
                        @if($selectedRole == 'mahasiswa')
                            <th>NIM</th>
                            <th>Kelas</th>
                            <th>Semester</th>
                        @else
                            <th>NIPY</th>
                            <th>Prodi</th>
                            <th>Jabatan Fungsional</th>
                        @endif
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                    <tr>
                        <td>{{ $user->username }}</td>
                        <td>{{ $user->email }}</td>

                        @if($selectedRole == 'mahasiswa')
                            <td>{{ $user->nim }}</td>
                            <td>{{ $user->kelas }}</td>
                            <td>{{ $user->semester }}</td>
                        @else
                            <td>{{ $user->nim }}</td> <!-- Tetap pakai field `nim`, hanya label berubah ke NIPY -->
                            <td>{{ $user->prodi }}</td>
                            <td>{{ $user->jabfung }}</td>
                        @endif

                        <td>
                            <a href="{{ route('data.edit', $user->id) }}" class="btn btn-warning btn-sm">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                        </td>
                    </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center">Tidak ada data pengguna.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="d-flex justify-content-center">
                {{ $users->links() }}
            </div>
        </div>
    </div>

    @include('layouts.footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
