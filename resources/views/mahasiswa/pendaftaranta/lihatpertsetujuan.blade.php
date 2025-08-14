<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Status Persetujuan Dokumen</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>
<body class="d-flex flex-column min-vh-100">

@include('layouts.navbar')

<div class="container mt-5">
    <h2 class="mb-4">Status Persetujuan Dokumen Tugas Akhir</h2>

    @if($data)
        <div class="mb-3 text-end">
            <a href="{{ route('mahasiswa.edit.pendaftaran', $data->id) }}" class="btn btn-warning">
                ✏️ Edit Data
            </a>
        </div>

        @php
            $statuses = [
                'Kartu Keluarga (KK)' => $data->status_kk,
                'KTP' => $data->status_ktp,
                'Ijazah SMA' => $data->status_ijazah_sma,
                'Skor TOEFL' => $data->status_skor_toefl,
                'Naskah Skripsi' => $data->status_naskah,
                'Hasil Plagiasi' => $data->status_hasil_plagiasi,
                'Bukti Pembayaran' => $data->status_bukti_pembayaran,
                'Surat Rekomendasi' => $data->status_surat_rekomendasi ?? '-', // Gunakan field yang sesuai
            ];
        @endphp

        <div class="row g-3">
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

                <div class="col-12">

                    <div class="card shadow-sm h-100">
                        <div class="card-body">
                            <h5 class="card-title"><i class="fas fa-file-alt text-primary"></i> {{ $nama }}</h5>
                            <p class="card-text mt-3">
                                <span class="badge {{ $badgeClass }} px-3 py-2">
                                    {{ ucfirst($status) }}
                                </span>
                            </p>
                        </div>
                    </div>
                </div>
            @endforeach
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
