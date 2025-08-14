<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Manajemen Proposal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body class="d-flex flex-column min-vh-100">
    @include('layouts.navbar-kaprodi')

    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h1 class="me-3 mb-0">Manajemen Proposal</h1>
            <form method="GET" action="{{ route('view') }}" class="d-flex gap-2">
                <select name="tahun_akademik" class="form-select">
                    <option value="">Pilih Tahun Akademik</option>
                    @foreach ($listTahunAkademik as $tahun)
                        <option value="{{ $tahun }}" {{ request('tahun_akademik') == $tahun ? 'selected' : '' }}>{{ $tahun }}</option>
                    @endforeach
                </select>
                <input type="text" name="search" class="form-control" placeholder="Cari Mahasiswa..." value="{{ request('search') }}">
                <button type="submit" class="btn btn-danger"><i class="bi bi-search"></i></button>
            </form>
        </div>
        <hr>

        {{-- Batas Pengajuan --}}
        <div class="card mb-4">
            <div class="card-header bg-danger text-white">
                <i class="bi bi-clock"></i> Atur Batas Pengajuan
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead class="table-light">
                        <tr>
                            <th>Kelas</th>
                            <th>Tahun Akademik</th>
                            <th>Batas Pengajuan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($mapels as $mapel)
                            <tr>
                                <form method="POST" action="{{ route('proposal.setDeadline.kaprodi') }}">
                                    @csrf
                                    <input type="hidden" name="mapel_id" value="{{ $mapel->id }}">
                                    <td>{{ $mapel->kelas }}</td>
                                    <td>{{ $mapel->tahun_akademik }}</td>
                                    <td><input type="date" name="batas_pengajuan" class="form-control" value="{{ $mapel->batas_pengajuan }}" required></td>
                                    <td><button type="submit" class="btn btn-success btn-sm"><i class="bi bi-save"></i> Simpan</button></td>
                                </form>
                            </tr>
                        @empty
                            <tr><td colspan="4" class="text-center">Tidak ada data mapel</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <hr>

        {{-- Tabel Proposal --}}
        @if($proposals->isEmpty())
            <div class="alert alert-warning text-center">Tidak ada data proposal</div>
        @else
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>Nama</th>
                            <th>Kelas</th>
                            <th>Judul</th>
                            <th>Tanggal</th>
                            <th>Kategori</th>
                            <th>Detail</th>
                            <th>Status</th>
                            <th>Komentar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($proposals as $proposal)
                            <tr>
                                <td>{{ $proposal->name }}</td>
                                <td>{{ $proposal->class }}</td>
                                <td>{{ Str::limit($proposal->script_title, 30) }}</td>
                                <td>{{ $proposal->submission_date }}</td>
                                <td>{{ $proposal->kategori->nama_kategori ?? '-' }}</td>
                                <td><button class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalDetail{{ $proposal->id }}"><i class="bi bi-eye"></i></button></td>
                                <td>
                                    <select class="form-select form-select-sm update-status" data-id="{{ $proposal->id }}">
                                        <option value="Menunggu" {{ $proposal->status == 'Menunggu' ? 'selected' : '' }}>Menunggu</option>
                                        <option value="Diterima" {{ $proposal->status == 'Diterima' ? 'selected' : '' }}>Diterima</option>
                                        <option value="Ditolak" {{ $proposal->status == 'Ditolak' ? 'selected' : '' }}>Ditolak</option>
                                    </select>
                                </td>
                                <td><button class="btn btn-outline-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#modalComment{{ $proposal->id }}"><i class="bi bi-chat-dots"></i></button></td>
                            </tr>

                            {{-- Modal Detail --}}
                            <div class="modal fade" id="modalDetail{{ $proposal->id }}" tabindex="-1">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Detail Proposal</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            <strong>Judul:</strong> {{ $proposal->script_title }}<br>
                                            <strong>Abstrak:</strong><p>{{ strip_tags($proposal->abstract) }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Modal Komentar --}}
                            <div class="modal fade" id="modalComment{{ $proposal->id }}" tabindex="-1">
                                <div class="modal-dialog modal-dialog-scrollable">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Komentar untuk {{ $proposal->name }}</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            @if(session('success') && old('proposal_id') == $proposal->id)
                                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                                    {{ session('success') }}
                                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                </div>
                                            @endif
                                            @if ($proposal->comments->count())
                                                <h6>Komentar Sebelumnya:</h6>
                                                <ul class="list-group mb-3">
                                                    @foreach ($proposal->comments as $comment)
                                                        <li class="list-group-item">
                                                            <strong>{{ $comment->user->username ?? 'Dosen' }}</strong><br>
                                                            {{ $comment->comment }}
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            @endif
                                            <form method="POST" action="{{ route('proposal.addComment.kaprodi') }}">
                                                @csrf
                                                <input type="hidden" name="proposal_id" value="{{ $proposal->id }}">
                                                <div class="mb-3">
                                                    <label for="comment" class="form-label">Komentar Anda</label>
                                                    <textarea name="comment" class="form-control" rows="4">{{ old('proposal_id') == $proposal->id ? old('comment') : ($proposal->comments->where('user_id', Auth::id())->first()->comment ?? '') }}</textarea>
                                                </div>
                                                <div class="d-flex justify-content-end">
                                                    <button type="submit" class="btn btn-primary"><i class="bi bi-send"></i> Simpan Komentar</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-center">
                {{ $proposals->appends(request()->query())->links('vendor.pagination.bootstrap-4') }}
            </div>
        @endif
    </div>

    @include('layouts.footer')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            $('.update-status').change(function () {
                const id = $(this).data('id');
                const status = $(this).val();
                $.post("{{ route('update') }}", {
                    _token: "{{ csrf_token() }}",
                    id, status
                }).done(() => alert("Status berhasil diperbarui!"));
            });
        });
    </script>
    @if(session('success') && old('proposal_id'))
    <script>
        window.onload = function () {
            var modalId = "modalComment{{ old('proposal_id') }}";
            var modal = new bootstrap.Modal(document.getElementById(modalId));
            modal.show();
        };
    </script>
    @endif
</body>
</html>
