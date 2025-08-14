<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SISTA - Proposal Skripsi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>
<body class="d-flex flex-column min-vh-100">
    @include('layouts.navbar')
    <!-- Main Content -->
    <div class="container my-4">
        <div class="d-flex align-items-center mb-3">
            <h1 class="me-3 mb-0">PERMOHONAN PEMBIMBING</h1>
            <span class="text-muted">Permohonan Dosen</span>
        </div>
        <hr>
        
        <div class="row mb-3">
            <div class="col-md-8 d-flex gap-2 align-items-center">
                <select class="form-select" style="width: auto;">
                    <option value="">-- Semua --</option>
                    <option value="diajukan">Diajukan</option>
                    <option value="diterima">Diterima</option>
                    <option value="ditolak">Ditolak</option>
                </select>
                <input type="text" class="form-control" placeholder="Cari" style="width: 300px;">
                <button class="btn btn-success"><i class="fas fa-search"></i></button>
                <button class="btn btn-info text-white"><i class="fas fa-sync-alt"></i></button>
            </div>
            <div class="col-md-4 text-end">
                <div class="btn-group">
                    <a href="{{ route('bimbingan.create') }}" class="btn btn-success"><i class="fas fa-plus"></i> Tambah</a>
                </div>
            </div>
        </div>

        <table class="table table-striped table-bordered">
            <thead class="table-success">
                <tr>
                    <th style="width: 50px;">No</th>
                    <th>Nama</th>
                    <th>Nama Dosen</th>
                    <th>Kelas</th>
                    <th>Periode</th>
                    <th>Tanggal Mulai</th>
                    <th>File Surat</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @if($bimbingans->isEmpty())
                    <tr>
                        <td colspan="9" class="text-center text-muted p-4">Data Kosong</td>
                    </tr>
                @else
                    @foreach ($bimbingans as $index => $bimbingan)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{$bimbingan->nama}}</td>
                            <td>{{ $bimbingan->nama_dosen }}</td>
                            <td>{{ $bimbingan->kelas }}</td>
                            <td>{{ $bimbingan->periode }}</td>
                            <td>{{ \Carbon\Carbon::parse($bimbingan->tanggal_mulai)->format('d-m-Y') }}</td>
                            <td>
                                <button class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#fileModal{{$bimbingan->id}}">
                                    Lihat
                                </button>

                                <!-- Modal -->
                                <div class="modal fade" id="fileModal{{$bimbingan->id}}" tabindex="-1" aria-labelledby="fileModalLabel{{$bimbingan->id}}" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="fileModalLabel{{$bimbingan->id}}">Preview File Surat</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body text-center">
                                                @if(pathinfo($bimbingan->file_surat, PATHINFO_EXTENSION) == 'pdf')
                                                    <iframe src="{{ asset('storage/' . $bimbingan->file_surat) }}" width="100%" height="500px"></iframe>
                                                @else
                                                    <p>File tidak dapat ditampilkan. Silakan <a href="{{ asset('storage/' . $bimbingan->file_surat) }}" target="_blank">unduh di sini</a>.</p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="badge 
                                    @if($bimbingan->status == 'Diterima') bg-success
                                    @elseif($bimbingan->status == 'Ditolak') bg-danger
                                    @else bg-secondary
                                    @endif">
                                    {{ $bimbingan->status }}
                                </span>
                            </td>
                            <td>
                                <a href="{{ route('bimbingans.edit', $bimbingan->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                <form action="{{ route('bimbingans.destroy', $bimbingan->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Hapus pengajuan ini?')">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>

        <nav aria-label="Page navigation" class="d-flex justify-content-end">
            <ul class="pagination">
                <li class="page-item"><a class="page-link" href="#">«</a></li>
                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item"><a class="page-link" href="#">»</a></li>
            </ul>
        </nav>
    </div>

    @include('layouts.footer')

    <!-- Bootstrap JS and Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $(".update-status").change(function() {
                var bimbinganId = $(this).data("id");
                var newStatus = $(this).val();

                $.ajax({
                    url: "{{ route('bimbingan.updateStatus') }}",
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        id: bimbinganId,
                        status: newStatus
                    },
                    success: function(response) {
                        alert("Status berhasil diperbarui!");
                    },
                    error: function(xhr) {
                        alert("Terjadi kesalahan saat memperbarui status!");
                    }
                });
            });
        });
    </script>
</body>
</html>