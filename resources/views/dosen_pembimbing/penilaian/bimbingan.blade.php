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
@include('layouts.navbar-pembimbing')

<div class="container my-4">
    <h3>Daftar Mahasiswa Bimbingan Saya</h3>

    <!-- Dropdown Pilihan Pembimbing -->
    <div class="mb-3">
        <label for="selectPembimbing" class="form-label">Pilih Peran Pembimbing:</label>
        <select id="selectPembimbing" class="form-select w-auto">
            <option value="1" selected>Pembimbing 1</option>
            <option value="2">Pembimbing 2</option>
        </select>
    </div>

    <!-- Input Pencarian -->
<div class="mb-3">
    <input type="text" id="searchInput" class="form-control w-50" placeholder="Cari nama mahasiswa...">
</div>


    <!-- Tabel Pembimbing 1 -->
    <div id="tablePembimbing1">
        <h4 class="mt-4">Sebagai Dosen Pembimbing 1</h4>
        <div class="table-responsive">
            <table class="table table-bordered align-middle">
                <thead class="table-primary">
                    <tr>
                        <th>No</th>
                        <th>Nama Mahasiswa</th>
                        <th>Kelas</th>
                        <th>Judul Skripsi</th>
                        <th>Nilai</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($mahasiswaPembimbing1 as $index => $mhs)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $mhs->mahasiswa->username }}</td>
                            <td>{{ $mhs->class }}</td>
                            <td>{{ $mhs->script_title }}</td>
                            <td>{{ $mhs->total_dosbing1/5 ?? '-' }}</td>
                            <td>
                                <a href="#" class="btn btn-primary btn-sm"
                                   data-bs-toggle="modal"
                                   data-bs-target="#formPenilaianModal"
                                   data-id="{{ $mhs->mahasiswa->id }}"
                                   data-nama="{{ $mhs->mahasiswa->username }}"
                                   data-pembimbing="1">
                                    <i class="fas fa-edit"></i> Edit / Beri Penilaian
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">Tidak ada mahasiswa</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Tabel Pembimbing 2 -->
    <div id="tablePembimbing2" style="display:none;">
        <h4 class="mt-4">Sebagai Dosen Pembimbing 2</h4>
        <div class="table-responsive">
            <table class="table table-bordered align-middle">
                <thead class="table-primary">
                    <tr>
                        <th>No</th>
                        <th>Nama Mahasiswa</th>
                        <th>Kelas</th>
                        <th>Judul Skripsi</th>
                        <th>Nilai </th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($mahasiswaPembimbing2 as $index => $mhs)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $mhs->mahasiswa->username }}</td>
                            <td>{{ $mhs->class }}</td>
                            <td>{{ $mhs->script_title }}</td>
                            <td>{{ $mhs->total_dosbing2/5 ?? '-' }}</td>
                            <td>
                                <a href="#" class="btn btn-primary btn-sm"
                                   data-bs-toggle="modal"
                                   data-bs-target="#formPenilaianModal"
                                   data-id="{{ $mhs->mahasiswa->id }}"
                                   data-nama="{{ $mhs->mahasiswa->username }}"
                                   data-pembimbing="2">
                                    <i class="fas fa-edit"></i> Edit / Beri Penilaian
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">Tidak ada mahasiswa</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Penilaian -->
<div class="modal fade" id="formPenilaianModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="{{ route('penilaian.store') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Form Penilaian - <span id="namaMahasiswa"></span></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <!-- Hidden inputs -->
                    <input type="hidden" name="mahasiswa_id" id="mahasiswaId">
                    <input type="hidden" name="peran_pembimbing" id="pembimbingKe">

                    <!-- Dropdown jenis penilaian -->
                    <div class="mb-3">
                        <label for="jenisPenilaian" class="form-label">Jenis Penilaian</label>
                        <select name="jenis_penilaian" id="jenisPenilaian" class="form-select" required>
                            <option value="hki">HKI</option>
                            <option value="skripsi">Skripsi</option>
                            <option value="ilmiah">Ilmiah</option>
                        </select>
                    </div>

                    <!-- Tabel Kriteria -->
                    <div class="table-responsive">
                        <table class="table table-bordered align-middle">
                            <thead class="table-primary">
                                <tr>
                                    <th>No</th>
                                    <th>Kriteria</th>
                                    <th>Bobot</th>
                                    <th>Nilai (1 - 5)</th>
                                </tr>
                            </thead>
                            <tbody id="tbodyKriteria">
                                @foreach($kriteria as $index => $krit)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $krit->kriteria }}</td>
                                    <td>
                                    {{ $krit->bobot }}
                                    <input type="hidden" name="bobot[{{ $krit->id }}]" value="{{ $krit->bobot }}">
                                </td>
                                <td>
                                    <select name="nilai[{{ $krit->id }}]" class="form-select" required>
                                        <option value="">-- Pilih Nilai --</option>
                                        @for($i = 1; $i <= 5; $i++)
                                            <option value="{{ $i }}">{{ $i }}</option>
                                        @endfor
                                    </select>
                                </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success">Simpan Penilaian</button>
                </div>
            </form>
        </div>
    </div>
</div>

@include('layouts.footer')

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
$(document).ready(function(){

    // Switch tabel pembimbing
    $('#selectPembimbing').on('change', function(){
        if($(this).val() === '1'){
            $('#tablePembimbing1').show();
            $('#tablePembimbing2').hide();
        } else {
            $('#tablePembimbing1').hide();
            $('#tablePembimbing2').show();
        }
    });

    $('#searchInput').on('keyup', function(){
        let filter = $(this).val().toLowerCase();

        // Tentukan tabel aktif
        let activeTable = $('#tablePembimbing1').is(':visible') ? '#tablePembimbing1' : '#tablePembimbing2';

        // Filter baris tabel berdasarkan nama mahasiswa (kolom ke-2)
        $(`${activeTable} tbody tr`).each(function(){
            let nama = $(this).find('td:nth-child(2)').text().toLowerCase();
            if(nama.includes(filter)){
                $(this).show();
            } else {
                $(this).hide();
            }
        });
    });

    // Isi data mahasiswa di modal
    $('#formPenilaianModal').on('show.bs.modal', function(event){
        var button = $(event.relatedTarget);
        var id = button.data('id');
        var nama = button.data('nama');
        var pembimbing = button.data('pembimbing'); // 1 atau 2

        $('#mahasiswaId').val(id);
        $('#namaMahasiswa').text(nama);
        $('#pembimbingKe').val(pembimbing);
    });

    // Ganti kriteria berdasarkan dropdown jenis_penilaian
    $('#jenisPenilaian').on('change', function(){
    var jenis = $(this).val();
    $.ajax({
        url: "{{ route('penilaian.getKriteria') }}", // route ke controller
        type: "GET",
        data: { jenis: jenis }, // kirim jenis via query string
        success: function(data){
            var html = '';
            data.forEach((krit, index) => {
                html += `
                <tr>
                    <td>${index + 1}</td>
                    <td>${krit.kriteria}</td>
                    <td>
                        ${krit.bobot}
                        <input type="hidden" name="bobot[${krit.id}]" value="${krit.bobot}">
                        <input type="hidden" name="kriteria_id[${krit.id}]" value="${krit.id}">
                    </td>
                    <td>
                        <select name="nilai[${krit.id}]" class="form-select" required>
                            <option value="">-- Pilih Nilai --</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                        </select>
                    </td>
                </tr>`;
            });
            $('#tbodyKriteria').html(html);
        },
        error: function(xhr){
            alert("Gagal mengambil kriteria");
        }
    });
});

});
</script>

</body>
</html>
