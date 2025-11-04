<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Manajemen Data Pendaftar Sidang TA</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
</head>
<body class="d-flex flex-column min-vh-100">
    @include('layouts.navbar-admin')

    <div class="container mt-5">

    <div class="mb-4">
    <label for="pilihTabel" class="form-label fw-bold">Pilih Jenis Aspek Penilaian</label>
        <select id="pilihTabel" class="form-select w-50">
            <option value="default" selected disabled>-- Pilih Jenis Aspek Penilaian --</option>
            <option value="all">-- Tampilkan Semua --</option>
            <option value="hki">Aspek Penilaian Bimbingan HKI</option>
            <option value="skripsi">Aspek Penilaian Bimbingan Skripsi</option>
            <option value="ilmiah">Aspek Penilaian Bimbingan Ilmiah</option>
            <option value="sidang_hki">Aspek Penilaian Sidang HKI</option>
            <option value="sidang_skripsi">Aspek Penilaian Sidang Skripsi</option>
            <option value="sidang_ilmiah">Aspek Penilaian Sidang Ilmiah</option>
        </select>
    </div>


    <div class="tabel-wrapper" id="tabel-hki">
        <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="mb-0">Aspek Penilaian Bimbingan HKI</h1>
        <a href="{{ route('penilaian.hki.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Tambah Aspek Penilaian
        </a>
        </div>
        <hr>
        <div class="table-responsive">
            <table class="table table-bordered align-middle">
                <thead class="table-primary">
                    <tr>
                        <th>No</th>
                        <th>Unsur yang Dinilai</th>
                        <th>Kriteria</th>
                        <th>Bobot</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($aspekPenilaian as $index => $aspek)
                        <tr>
                            <td>{{ $aspekPenilaian->firstItem() + $index }}</td>
                            <td>{{ $aspek->unsur_yang_dinilai }}</td>
                            <td>{{ $aspek->kriteria }}</td>
                            <td>{{ $aspek->bobot }}</td>
                            <td>
                                <a href="{{ route('penilaian.hki.edit', $aspek->id) }}" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i> Edit
                                </a>

                                <form action="{{ route('penilaian.hki.destroy', $aspek->id) }}" method="POST" class="d-inline"
                                    onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        <i class="fas fa-trash"></i> Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">Belum ada data</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <div class="d-flex justify-content-center">
                {{ $aspekPenilaian->links() }}
            </div>
        </div>
    </div>

    <div class="tabel-wrapper" id="tabel-skripsi">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h1 class="mb-0">Aspek Penilaian Bimbingan Skripsi</h1>
            <a href="{{ route('penilaian.skripsi.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Tambah Aspek Penilaian
            </a>
        </div>
        <hr>
        <div class="table-responsive">
            <table class="table table-bordered align-middle">
                <thead class="table-primary">
                    <tr>
                        <th>No</th>
                        <th>Unsur yang Dinilai</th>
                        <th>Kriteria</th>
                        <th>Bobot</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($aspekPenilaianSkripsi as $index => $aspek)
                        <tr>
                            <td>{{ $aspekPenilaianSkripsi->firstItem() + $index }}</td>
                            <td>{{ $aspek->unsur_yang_dinilai }}</td>
                            <td>{{ $aspek->kriteria }}</td>
                            <td>{{ $aspek->bobot }}</td>
                            <td>
                                <!-- Tombol Edit -->
                                <a href="{{ route('penilaian.skripsi.edit', $aspek->id) }}" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i> Edit
                                </a>

                                <!-- Tombol Hapus -->
                                <form action="{{ route('penilaian.skripsi.destroy', $aspek->id) }}" method="POST" class="d-inline"
                                    onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        <i class="fas fa-trash"></i> Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">Belum ada data</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <div class="d-flex justify-content-center">
                {{ $aspekPenilaianSkripsi->links() }}
            </div>
        </div>
    </div>


        
    <div class="tabel-wrapper" id="tabel-ilmiah">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h1 class="mb-0">Aspek Penilaian Bimbingan Ilmiah</h1>
            <a href="{{ route('penilaian.ilmiah.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Tambah Aspek Penilaian
            </a>
        </div>
        <hr>
        <div class="table-responsive">
            <table class="table table-bordered align-middle">
                <thead class="table-primary">
                    <tr>
                        <th>No</th>
                        <th>Unsur yang Dinilai</th>
                        <th>Kriteria</th>
                        <th>Bobot</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($aspekPenilaianIlmiah as $index => $aspek)
                        <tr>
                            <td>{{ $aspekPenilaianIlmiah->firstItem() + $index }}</td>
                            <td>{{ $aspek->unsur_yang_dinilai }}</td>
                            <td>{{ $aspek->kriteria }}</td>
                            <td>{{ $aspek->bobot }}</td>
                            <td>
                                <!-- Tombol Edit -->
                                <a href="{{ route('penilaian.ilmiah.edit', $aspek->id) }}" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i> Edit
                                </a>

                                <!-- Tombol Hapus -->
                                <form action="{{ route('penilaian.ilmiah.destroy', $aspek->id) }}" method="POST" class="d-inline"
                                    onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        <i class="fas fa-trash"></i> Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">Belum ada data</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <div class="d-flex justify-content-center">
                {{ $aspekPenilaianIlmiah->links() }}
            </div>
        </div>
    </div>


    <div class="tabel-wrapper" id="tabel-sidang_hki">
        <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="mb-0">Aspek Penilaian Sidang HKI</h1>
        <a href="{{ route('penilaian.sidang.hki.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Tambah Aspek Penilaian
        </a>
        </div>
        <hr>
        <div class="table-responsive">
            <table class="table table-bordered align-middle">
                <thead class="table-primary">
                    <tr>
                        <th>No</th>
                        <th>Unsur yang Dinilai</th>
                        <th>Kriteria</th>
                        <th>Bobot</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($aspekPenilaianSidangHKI as $index => $aspek)
                        <tr>
                            <td>{{ $aspekPenilaian->firstItem() + $index }}</td>
                            <td>{{ $aspek->unsur_yang_dinilai }}</td>
                            <td>{{ $aspek->kriteria }}</td>
                            <td>{{ $aspek->bobot }}</td>
                            <td>
                                <a href="{{ route('penilaian.sidang.hki.edit', $aspek->id) }}" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i> Edit
                                </a>

                                <form action="{{ route('penilaian.sidang.hki.destroy', $aspek->id) }}" method="POST" class="d-inline"
                                    onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        <i class="fas fa-trash"></i> Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">Belum ada data</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <div class="d-flex justify-content-center">
                {{ $aspekPenilaian->links() }}
            </div>
        </div>
    
    </div>

    <div class="tabel-wrapper" id="tabel-sidang_skripsi">
        <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="mb-0">Aspek Penilaian Sidang Skripsi</h1>
        <a href="{{ route('penilaian.sidang.skripsi.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Tambah Aspek Penilaian
        </a>
        </div>
        <hr>
        <div class="table-responsive">
            <table class="table table-bordered align-middle">
                <thead class="table-primary">
                    <tr>
                        <th>No</th>
                        <th>Unsur yang Dinilai</th>
                        <th>Kriteria</th>
                        <th>Bobot</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($aspekPenilaianSidangSkripsi as $index => $aspek)
                        <tr>
                            <td>{{ $aspekPenilaian->firstItem() + $index }}</td>
                            <td>{{ $aspek->unsur_yang_dinilai }}</td>
                            <td>{{ $aspek->kriteria }}</td>
                            <td>{{ $aspek->bobot }}</td>
                            <td>
                                <a href="{{ route('penilaian.sidang.skripsi.edit', $aspek->id) }}" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i> Edit
                                </a>

                                <form action="{{ route('penilaian.sidang.skripsi.destroy', $aspek->id) }}" method="POST" class="d-inline"
                                    onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        <i class="fas fa-trash"></i> Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">Belum ada data</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <div class="d-flex justify-content-center">
                {{ $aspekPenilaian->links() }}
            </div>
        </div>
    </div>

    <div class="tabel-wrapper" id="tabel-sidang_ilmiah">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h1 class="mb-0">Aspek Penilaian Sidang Ilmiah</h1>
            <a href="{{ route('penilaian.sidang.ilmiah.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Tambah Aspek Penilaian
            </a>
        </div>
        <hr>
        <div class="table-responsive">
            <table class="table table-bordered align-middle">
                <thead class="table-primary">
                    <tr>
                        <th>No</th>
                        <th>Unsur yang Dinilai</th>
                        <th>Kriteria</th>
                        <th>Bobot</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($aspekPenilaianSidangIlmiah as $index => $aspek)
                        <tr>
                            <td>{{ $aspekPenilaianSidangIlmiah->firstItem() + $index }}</td>
                            <td>{{ $aspek->unsur_yang_dinilai }}</td>
                            <td>{{ $aspek->kriteria }}</td>
                            <td>{{ $aspek->bobot }}</td>
                            <td>
                                <a href="{{ route('penilaian.sidang.ilmiah.edit', $aspek->id) }}" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <form action="{{ route('penilaian.sidang.ilmiah.destroy', $aspek->id) }}" method="POST" class="d-inline"
                                    onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        <i class="fas fa-trash"></i> Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">Belum ada data</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="d-flex justify-content-center">
                {{ $aspekPenilaianSidangIlmiah->links() }}
            </div>
        </div>
    </div> <!-- ✅ tutup di sini -->

    </div>
    </div>

    @include('layouts.footer')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

   <script>
        document.getElementById("pilihTabel").addEventListener("change", function() {
            let value = this.value;
            document.querySelectorAll(".tabel-wrapper").forEach(function(tbl) {
                tbl.style.display = "none";
            });

            if (value === "all") {
                document.querySelectorAll(".tabel-wrapper").forEach(function(tbl) {
                    tbl.style.display = "block";
                });
            } else if (value !== "default") {
                document.getElementById("tabel-" + value).style.display = "block";
            }
        });

        // Default: sembunyikan semua tabel dulu
        document.querySelectorAll(".tabel-wrapper").forEach(function(tbl) {
            tbl.style.display = "none";
        });
    </script>

</body>
</html>
