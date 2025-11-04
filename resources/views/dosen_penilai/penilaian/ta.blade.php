    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>SISTA - Penilaian Penguji</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    </head>
    <body class="d-flex flex-column min-vh-100">

    @include('layouts.navbar-penilai')

    <div class="container my-4">
        <h3>Daftar Mahasiswa Ujian (Sebagai Penguji)</h3>

        <!-- Dropdown Pilihan Peran Penguji -->
        <div class="mb-3">
            <label for="selectPenguji" class="form-label">Pilih Peran:</label>
            <select id="selectPenguji" class="form-select w-auto">
                <option value="1" selected>Ketua Penguji</option>
                <option value="2">Penguji 1</option>
                <option value="3">Penguji 2</option>
            </select>
        </div>

         <!-- SINGLE Search Input (unik) -->
        <div class="mb-3">
            <label class="form-label mb-0 d-block">&nbsp;</label>
            <input type="text" id="searchInput" class="form-control" placeholder="Cari nama atau NIM mahasiswa...">
        </div>

        <!-- Tabel Ketua Penguji -->
        <div id="tableKetua">
            <h4 class="mt-4">Sebagai Ketua Penguji</h4>
            <div class="table-responsive">
                <table class="table table-bordered align-middle">
                    <thead class="table-primary">
                    <tr>
                        <th>No</th>
                        <th>Nama Mahasiswa</th>
                        <th>NIM</th>
                        <th>Judul</th>
                        <th>Nilai</th>
                        <th>Nilai Akhir</th>
                        <th>Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($ketuaPenguji as $index => $jadwal)
                        <tr>
                            <td>{{ $index+1 }}</td>
                            <td>{{ $jadwal->user->username }}</td>
                            <td>{{ $jadwal->nim }}</td>
                            <td>{{ $jadwal->judul }}</td>
                            <td>{{ $jadwal->total_ketua/5 }}</td>
                            <td>{{ number_format($jadwal->nilai_akhir, 2) }}</td>
                            <td>
                                <!-- Tombol Nilai -->
                                <a href="#" 
                                class="btn btn-primary btn-sm btn-nilai"
                                data-bs-toggle="modal"
                                data-bs-target="#modalPenilaian"
                                data-mahasiswa-id="{{ $jadwal->user->id }}"
                                data-nim="{{ $jadwal->nim }}"
                                data-peran="1">
                                <i class="fas fa-edit"></i> Nilai
                                </a>


                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="7" class="text-center">Tidak ada jadwal</td></tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Tabel Penguji 1 -->
        <div id="tablePenguji1" style="display:none;">
            <h4 class="mt-4">Sebagai Penguji 1</h4>
            <div class="table-responsive">
                <table class="table table-bordered align-middle">
                    <thead class="table-primary">
                    <tr>
                        <th>No</th>
                        <th>Nama Mahasiswa</th>
                        <th>NIM</th>
                        <th>Judul</th>
                        <th>Nilai</th>
                        <th>Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($penguji1 as $index => $jadwal)
                        <tr>
                            <td>{{ $index+1 }}</td>
                            <td>{{ $jadwal->user->username }}</td>
                            <td>{{ $jadwal->nim }}</td>
                            <td>{{ $jadwal->judul }}</td>
                            <td>{{ $jadwal->total_penguji1/5 }}</td>
                            <td>
                                <!-- Tombol Nilai -->
                                <a href="#" 
                                class="btn btn-primary btn-sm btn-nilai"
                                data-bs-toggle="modal"
                                data-bs-target="#modalPenilaian"
                                data-mahasiswa-id="{{ $jadwal->user->id }}"
                                data-nim="{{ $jadwal->nim }}"
                                data-peran="2">
                                <i class="fas fa-edit"></i> Nilai
                                </a>

                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="7" class="text-center">Tidak ada jadwal</td></tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Tabel Penguji 2 -->
        <div id="tablePenguji2" style="display:none;">
            <h4 class="mt-4">Sebagai Penguji 2</h4>
            <div class="table-responsive">
                <table class="table table-bordered align-middle">
                    <thead class="table-primary">
                    <tr>
                        <th>No</th>
                        <th>Nama Mahasiswa</th>
                        <th>NIM</th>
                        <th>Judul</th>
                        <th>Nilai</th>
                        <th>Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($penguji2 as $index => $jadwal)
                        <tr>
                            <td>{{ $index+1 }}</td>
                            <td>{{ $jadwal->user->username }}</td>
                            <td>{{ $jadwal->nim }}</td>
                            <td>{{ $jadwal->judul }}</td>
                            <td>{{ $jadwal->total_penguji2/5 }}</td>
                            <td>
                                <!-- Tombol Nilai -->
                                <a href="#" 
                                class="btn btn-primary btn-sm btn-nilai"
                                data-bs-toggle="modal"
                                data-bs-target="#modalPenilaian"
                                data-mahasiswa-id="{{ $jadwal->user->id }}"
                                data-nim="{{ $jadwal->nim }}"
                                data-peran="3">
                                <i class="fas fa-edit"></i> Nilai
                                </a>

                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="7" class="text-center">Tidak ada jadwal</td></tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal Penilaian -->
    <div class="modal fade" id="modalPenilaian" tabindex="-1" aria-labelledby="modalPenilaianLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl"> 
        <div class="modal-content">
        <form method="POST" action="{{ route('penilaian.simpan.sidangpenilai') }}">
            @csrf
            <input type="hidden" name="mahasiswa_id" id="mahasiswaId">
            <input type="hidden" name="peran_penguji" id="peranPenguji">
            <div class="modal-header">
            <h5 class="modal-title" id="modalPenilaianLabel">Form Penilaian</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">

            <div class="mb-3">
                <label for="jenisSidang" class="form-label">Jenis Sidang</label>
                <select id="jenisSidang" name="jenis_sidang" class="form-select">
                <option value="hki">HKI</option>
                <option value="ilmiah">Ilmiah</option>
                <option value="skripsi">Skripsi</option>
                </select>
            </div>

            <!-- Tempat muncul kriteria -->
            <div id="kriteriaContainer"></div>
            <div class="mb-3" id="statusKelulusanContainer" style="display:none;">
                <label for="statusKelulusan" class="form-label">Status Kelulusan</label>
                <select id="statusKelulusan" name="status_kelulusan" class="form-select">
                    <option value="lulus">Lulus</option>
                    <option value="belum lulus">Belum Lulus</option>
                </select>
            </div>
            </div>
            <div class="modal-footer">
            <button type="submit" class="btn btn-success">Simpan Nilai</button>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
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
        // Switch tabel penguji
        $('#selectPenguji').on('change', function(){
            let val = $(this).val();
            $('#tableKetua').hide();
            $('#tablePenguji1').hide();
            $('#tablePenguji2').hide();

            if(val === '1'){
                $('#tableKetua').show();
            } else if(val === '2'){
                $('#tablePenguji1').show();
            } else {
                $('#tablePenguji2').show();
            }
        });
    });
    </script>
    <script>
    $(document).ready(function(){
        // Saat dropdown jenis sidang diubah
        $('#jenisSidang').on('change', function(){
            let jenis = $(this).val();
            $.get("{{ route('penilaian.kriteria.sidangpenilai') }}", { jenis: jenis }, function(data){
                let html = `
                    <table class="table table-bordered">
                    <thead>
                        <tr>
                        <th>Unsur Yang Dinilai</th>
                        <th>Kriteria</th>
                        <th>Bobot</th>
                        <th>Nilai</th>
                        </tr>
                    </thead>
                    <tbody>`;
                data.forEach(function(item, index){
                    html += `
                    <tr>
                        <td>${item.unsur_yang_dinilai}</td>
                        <td>${item.kriteria}</td>
                        <td>
                        ${item.bobot}
                        <input type="hidden" name="bobot[${index}]" value="${item.bobot}">
                        </td>
                        <td>
                        <select name="nilai[${index}]" class="form-select">
                            ${[1,2,3,4,5].map(val => `<option value="${val}">${val}</option>`).join('')}
                        </select>
                        </td>
                    </tr>`;
                });

                html += `</tbody></table>`;
                $('#kriteriaContainer').html(html);
            });
        });

        // Trigger default saat modal dibuka
        $('#modalPenilaian').on('shown.bs.modal', function(){
            $('#jenisSidang').trigger('change');
        });
    });
      $(document).on('click', '.btn-nilai', function(){
        let mahasiswaId = $(this).data('mahasiswa-id');
        let peran = $(this).data('peran');

        $('#mahasiswaId').val(mahasiswaId);
        $('#peranPenguji').val(peran);

        if(peran == 1){
            $('#statusKelulusanContainer').show();
        } else {
            $('#statusKelulusanContainer').hide();
        }
    });


    </script>

<script>
$(document).ready(function(){
    $('#searchInput').on('keyup', function(){
        let filter = $(this).val().toLowerCase();

        // Cek tabel yang sedang tampil
        let activeTable;
        if($('#tableKetua').is(':visible')) {
            activeTable = '#tableKetua';
        } else if($('#tablePenguji1').is(':visible')) {
            activeTable = '#tablePenguji1';
        } else {
            activeTable = '#tablePenguji2';
        }

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
});
</script>

    </body>
    </html>
