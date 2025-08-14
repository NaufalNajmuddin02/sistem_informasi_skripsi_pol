<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SISTA</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
    <style>
    html, body {
        height: 100%;
        margin: 0;
    }

    body {
        display: flex;
        flex-direction: column;
    }

    main {
        flex: 1;
    }
</style>
</head>
<body>
    @include('layouts.navbar-penilai')
    <!-- Main Content -->
    <div class="container my-4">
        <div class="d-flex align-items-center mb-3">
            <h1 class="me-3 mb-0">Penilaian Penguji</h1>
        </div>
        <div class="mb-3">
            <label class="form-label">Sebagai:</label>
            <select name="penguji" class="form-select" id="selectPenguji" required>
                <option value="">-- Pilih Posisi --</option>
                <option value="1">Ketua Penguji</option>
                <option value="2">Penguji 1</option>
                <option value="3">Penguji 2</option>
            </select>
        </div>

        <br>
        <button id="exportTable1" class="btn btn-success mb-3" style="display:none;"><i class="fas fa-file-excel"></i> Export ke Excel</button>
        <table class="table table-striped table-bordered" id="daftar1" style="display: none;">
            <thead class="table-primary">
                <tr>
                    <th>Nama Mahasiswa</th>
                    <th>Judul</th>
                    <th>Total Nilai</th>
                    <th>Total Nilai Keseluruhan</th>
                    <th>Grade</th>
                    <th>Status Sidang</th>
                    <th>Action</th>
   
                </tr>
            </thead>
            <tbody>
                @forelse($daftartabel1 as $item)
                @php
                $nilai = $item->total_score / 13.5;
                if ($nilai > 80) {
                    $grade = 'A';
                } elseif ($nilai >= 71) {
                    $grade = 'B';
                } elseif ($nilai >= 61) {
                    $grade = 'C';
                } else {
                    $grade = 'D';
                }
            @endphp
                    <tr>
                        <td>{{ $item->nama_mahasiswa}}</td>
                        <td>{{ $item->judul}}</td>
                        <td>{{ $item->total_nilai_kp }}</td>
                        <td>{{ $item->total_score/13.5 }}</td>
                        <td>{{ $grade }}</td>
                        <td>{{ $item->status_sidang_kp }}</td>
                        <td>
                            <a href="{{ route('dosen-penilai.penilaian.ketua.edit', $item->id) }}" class="btn btn-sm btn-warning">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                        </td>


                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted p-4">Belum ada data</td>
                    </tr>
                @endforelse
            </tbody>

        </table>
        <button id="exportTable2" class="btn btn-success mb-3" style="display:none;"><i class="fas fa-file-excel"></i> Export ke Excel</button>

        <table class="table table-striped table-bordered" id="daftar2" style="display: none;">
            <thead class="table-primary">
                <tr>
                    <th>Nama Mahasiswa</th>
                    <th>Judul</th>
                    <th>Total Nilai</th>
               
                      <th>Action</th>
                   
                </tr>
            </thead>
            <tbody>
                @forelse($daftartabel2 as $item)
                    <tr>
                        <td>{{ $item->nama_mahasiswa}}</td>
                        <td>{{ $item->judul}}</td>
                        <td>{{ $item->total_nilai_kp }}</td>
                        <td>
                            <a href="{{ route('dosen-penilai.penilaian.penguji1.edit', $item->id) }}" class="btn btn-sm btn-warning">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                        </td>


                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted p-4">Belum ada data</td>
                    </tr>
                @endforelse
            </tbody>

        </table>
                <button id="exportTable3" class="btn btn-success mb-3" style="display:none;"><i class="fas fa-file-excel"></i> Export ke Excel</button>

        <table class="table table-striped table-bordered" id="daftar3" style="display: none;">
            <thead class="table-primary">
                <tr>
                    <th>Nama Mahasiswa</th>
                    <th>Judul</th>
                    <th>Total Nilai</th>
                  
                    <th>Action</th>
                   
                </tr>
            </thead>
            <tbody>
                @forelse($daftartabel3 as $item)
                    <tr>
                        <td>{{ $item->nama_mahasiswa}}</td>
                        <td>{{ $item->judul}}</td>
                        <td>{{ $item->total_nilai_kp }}</td>
                
                        <td>
                            <a href="{{ route('dosen-penilai.penilaian.penguji2.edit', $item->id) }}" class="btn btn-sm btn-warning">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                        </td>


                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted p-4">Belum ada data</td>
                    </tr>
                @endforelse
            </tbody>

        </table>
    </div>

    

    <!-- Bootstrap JS and Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    <script>
        function exportTableToExcel(tableId, filename = 'data.xlsx') {
            const table = document.getElementById(tableId);
            const wb = XLSX.utils.table_to_book(table, { sheet: "Sheet1" });
            XLSX.writeFile(wb, filename);
        }

        document.getElementById('selectPenguji').addEventListener('change', function () {
            const value = this.value;
            const table1 = document.getElementById('daftar1');
            const table2 = document.getElementById('daftar2');
            const table3 = document.getElementById('daftar3');

            const exportBtn = document.getElementById('exportTable1');

            table1.style.display = 'none';
            table2.style.display = 'none';
            table3.style.display = 'none';
            exportBtn.style.display = 'none';

            if (value === '1') {
                table1.style.display = 'table';
                exportBtn.style.display = 'inline-block';
                exportBtn.onclick = () => exportTableToExcel('daftar1', 'KetuaPenguji1.xlsx');
            } else if (value === '2') {
                table2.style.display = 'table';
                exportBtn.style.display = 'inline-block';
                exportBtn.onclick = () => exportTableToExcel('daftar2', 'Penguji1.xlsx');
            } else if (value === '3') {
                table3.style.display = 'table';
                exportBtn.style.display = 'inline-block';
                exportBtn.onclick = () => exportTableToExcel('daftar3', 'Penguji2.xlsx');
            }
        });
    </script>



    </script>


@include('layouts.footer')
</body>
</html>