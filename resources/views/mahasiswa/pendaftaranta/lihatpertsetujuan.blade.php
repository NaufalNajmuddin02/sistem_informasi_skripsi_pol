<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Status Persetujuan Dokumen</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        /* supaya sudut tabel ikut melengkung */
        .table-rounded {
            border-radius: 8px;
            overflow: hidden;
        }
    </style>
</head>
<body class="d-flex flex-column min-vh-100">

@include('layouts.navbar')

<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">Status Persetujuan Dokumen Tugas Akhir</h2>
        <a href="{{ route('mahasiswa.edit.pendaftaran', $data->id) }}" class="btn btn-warning">
            ✏️ Edit Data
        </a>
    </div>

    @if($data)
        @php
            $statuses = [
                'Kartu Keluarga (KK)'  => $data->status_kk,
                'KTP'                  => $data->status_ktp,
                'Ijazah SMA'           => $data->status_ijazah_sma,
                'Skor TOEFL'           => $data->status_skor_toefl,
                'Hasil Plagiasi'       => $data->status_hasil_plagiasi,
                'Bukti Pembayaran'     => $data->status_bukti_pembayaran,
                'Surat Rekomendasi'    => $data->status_surat_rekomendasi ?? '-',
            ];
            $no = 1;
        @endphp

        <div class="card shadow">
            <div class="card-body p-0">
                <table class="table table-bordered table-striped table-rounded mb-0">
                    <thead class="table-light">
                    <tr>
                        <th class="text-center">NO</th>
                        <th>Nama Berkas</th>
                        <th class="text-center">Status</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($statuses as $nama => $status)
                        @php
                            $statusLower = strtolower($status);
                            $badgeClass = match($statusLower) {
                                'disetujui', 'approved' => 'bg-success',
                                'ditolak', 'rejected' => 'bg-danger',
                                'belum disetujui', 'pending', 'menunggu' => 'bg-warning text-dark',
                                default => 'bg-secondary',
                            };
                        @endphp
                        <tr>
                            <td class="text-center">{{ $no++ }}</td>
                            <td>{{ $nama }}</td>
                            <td class="text-center">
                                <span class="badge {{ $badgeClass }} px-3 py-2">
                                    {{ ucfirst($status) }}
                                </span>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @else
        <div class="alert alert-warning mt-4">
            Anda belum mengisi form pendaftaran tugas akhir.
        </div>
    @endif

    <br>
</div>

@include('layouts.footer')

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
