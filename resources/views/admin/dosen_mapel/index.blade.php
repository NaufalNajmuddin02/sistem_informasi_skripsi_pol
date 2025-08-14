<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembagian Mahasiswa ke Mata Kuliah</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- Custom CSS -->
    <style>
        .card-custom {
            margin-bottom: 1rem;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            height: 100%;
            position: relative;
        }

        .card-body {
            flex-grow: 1;
        }

        .badge-custom {
            font-size: 0.9rem;
            margin-top: 0.5rem;
        }

        .btn-tambah-mahasiswa {
            position: absolute;
            top: 10px;
            right: 10px;
            z-index: 10;
        }

        @media (max-width: 768px) {
            .card-custom {
                width: 100%;
                margin-bottom: 1rem;
            }
        }

        @media (min-width: 768px) {
            .card-custom {
                margin-bottom: 1.5rem;
            }
        }
    </style>
</head>
<body class="d-flex flex-column min-vh-100">
    @include('layouts.navbar-admin')
    <div class="container mt-4">
        <div class="d-flex align-items-center mb-3">
            <h1 class="me-3 mb-0">Daftar Dosen Mata Kuliah</h1>
            <span class="text-muted">Pembagian mahasiswa untuk dosen mata pelajaran</span>
        </div>
        <hr>
        <div class="card-body">
            <form method="GET" action="{{ route('dosen_mapel.index') }}">
                <div class="input-group">
                    <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Cari mata kuliah atau dosen...">
                    <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i> Cari</button>
                </div>
            </form>
        </div>
        <br>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="row">
            @foreach ($mapel as $m)
            <div class="col-12">
                <div class="card card-custom">
                    <button class="btn btn-outline-primary btn-sm btn-tambah-mahasiswa" 
                        data-mapel="{{ $m->id }}" 
                        data-mapel-name="{{ $m->nama_mapel }}" 
                        data-kelas="{{ $m->kelas }}">
                        <i class="fas fa-plus"></i> Tambah Mahasiswa
                    </button>
                    <div class="card-body">
                        <h5 class="card-title fw-bold">
                            <i class="fas fa-chalkboard-teacher"></i> {{ $m->nama_mapel }}
                        </h5>
                        <h6 class="text-muted">
                            <i class="fas fa-chalkboard-teacher"></i> Dosen: {{ $m->dosen_nama }}
                        </h6>
                        <h6 class="text-muted">
                            <i class="fas fa-users"></i> Kelas: {{ $m->kelas }}
                        </h6>
                    </div>
                </div>
            </div>
            @endforeach
            <div class="d-flex justify-content-center mt-3">
                {{ $mapel->links() }}
            </div>
        </div>
    </div>

    <!-- Modal Pilih Mahasiswa -->
    <div class="modal fade" id="modalMahasiswa" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLabel">Tambah Mahasiswa ke <span id="namaMapel"></span> - Kelas <span id="kelasMapel"></span></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="formTambahMahasiswa" action="{{ route('pembagian.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="mapel_id" id="mapelId">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead class="table-primary">
                                    <tr>
                                        <th>
                                            <div class="form-check">
                                                <input type="checkbox" id="checkAll" class="form-check-input">
                                                <label for="checkAll" class="form-check-label ms-1">Pilih Semua</label>
                                            </div>
                                        </th>
                                        <th>Nama Mahasiswa</th>
                                        <th>Kelas</th>
                                    </tr>
                                </thead>
                                <tbody id="listMahasiswa">
                                    <!-- Data Mahasiswa dimuat dengan AJAX -->
                                </tbody>
                            </table>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success">Simpan Pembagian</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @include('layouts.footer')

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function () {
            $('.btn-tambah-mahasiswa').click(function () {
                let mapelId = $(this).data('mapel');
                let mapelName = $(this).data('mapel-name');
                let kelas = $(this).data('kelas');

                $('#mapelId').val(mapelId);
                $('#namaMapel').text(mapelName);
                $('#kelasMapel').text(kelas);

                // Reset check all setiap kali modal dibuka
                $('#checkAll').prop('checked', false);

                // Load mahasiswa dengan AJAX
                $.ajax({
                url: "{{ route('get.mahasiswa') }}",
                type: "GET",
                data: {
                    mapel_id: mapelId,
                    kelas: kelas // kirim kelas ke controller
                },
                success: function (data) {
                    let mahasiswaHtml = "";
                    if (data.length === 0) {
                        mahasiswaHtml = `<tr><td colspan="3" class="text-center text-danger">Semua mahasiswa sudah ditambahkan atau dipilih oleh dosen lain.</td></tr>`;
                    } else {
                        data.forEach(m => {
                            mahasiswaHtml += ` 
                                <tr>
                                    <td><input type="checkbox" name="mahasiswa_ids[]" value="${m.id}" class="form-check-input mahasiswa-checkbox"></td>
                                    <td>${m.username}</td>
                                    <td>${m.kelas}</td>
                                </tr>`;
                        });
                    }
                    $('#listMahasiswa').html(mahasiswaHtml);
                }
            });


                $('#modalMahasiswa').modal('show');
            });

            // Fitur cek semua
            $('#checkAll').on('change', function () {
                const isChecked = $(this).is(':checked');
                $('#listMahasiswa input[type="checkbox"]').prop('checked', isChecked);
            });
        });
    </script>
</body>
</html>
