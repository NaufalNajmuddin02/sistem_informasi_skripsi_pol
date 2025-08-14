<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SISTA - Surat Rekomendasi Sidang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Times New Roman', Times, serif,  Arial,;
            background-color: #f8f9fa;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .container {
            flex: 1 0 auto;
        }

        .recommendation-frame {
            background: white;
            padding: 40px 60px; /* Top & Bottom: 40px, Left & Right: 60px */
            border: 2px solid #000;
            max-width: 800px;
            margin: 50px auto 80px auto;
            box-shadow: 0px 0px 10px rgba(0,0,0,0.15);
        }


        .center {
            text-align: center;
        }

        .info-table {
            display: table;
            width: 100%;
            margin-left: 0;
        }

        .info-row {
            display: table-row;
        }

        .info-label, .info-value {
            display: table-cell;
            padding: 4px 0;
        }

        .info-label {
            width: 200px;
        }

        .signatures-wrapper {
            display: flex;
            justify-content: space-between;
            margin-top: 70px;
        }

        .signature-box {
            width: 200px;
        }

        .text-start {
            text-align: left;
            padding-left: 0;
        }

        footer {
            flex-shrink: 0;
            margin-top: 100px;
        }
    </style>
</head>
<body>

    @include('layouts.navbar')

    <div class="container">
        <div class="card mb-4">
            <div class="card-body d-flex justify-content-end">
                <a href="{{ route('rekomendasi.download', $seminar->id) }}" class="btn btn-success">
                    <i class="fas fa-file-download"></i> Download PDF
                </a>
            </div>
        </div>
        @if ($rekomendasiDosen1 && $rekomendasiDosen2)
            <div class="recommendation-frame">
                <div class="center mb-5">
                    <h3><strong>HALAMAN REKOMENDASI</strong></h3>
                </div>

                <p>Pembimbing Tugas Akhir memberikan rekomendasi kepada :</p>

                <div class="info-table mb-3">
                    <div class="info-row">
                        <div class="info-label">Nama</div>
                        <div class="info-value">: {{ $seminar->user->username }}</div>
                    </div>
                    <div class="info-row">
                        <div class="info-label">NIM</div>
                        <div class="info-value">: {{ $seminar->user->nim }}</div>
                    </div>
                    <div class="info-row">
                        <div class="info-label">Program Studi</div>
                        <div class="info-value">: {{ $seminar->user->prodi }}</div>
                    </div>
                    <div class="info-row">
                        <div class="info-label">Judul Tugas Akhir</div>
                        <div class="info-value">: {{ $seminar->script_title }}</div>
                    </div>
                </div>

                @php
                    $year = date('Y');
                    $month = date('n');

                    // Menentukan tahun akademik berdasarkan bulan
                    $tahun_awal = ($month >= 8) ? $year : $year - 1;
                    $tahun_akhir = $tahun_awal + 1;
                    $tahun_akademik = $tahun_awal . '/' . $tahun_akhir;

                    // Menentukan semester (ganjil/genap)
                    if ($month >= 8 || $month <= 1) {
                        $semester = 'Ganjil';
                    } else {
                        $semester = 'Genap';
                    }
                @endphp

                <p>
                    Mahasiswa tersebut telah dinyatakan selesai melaksanakan bimbingan dan dapat
                    mengikuti Ujian Tugas Akhir pada tahun akademik {{ $tahun_akademik }} {{ $semester }}.
                </p>

                <div class="signatures-wrapper">
                    <div class="signature-box">
                        <div class="text-start">
                            <br>
                            Pembimbing I<br><br><br><br><br>
                        </div>
                        <div class="text-start">
                            <span style="text-decoration: underline;">
                                {{ $seminar->dosenPenilai1->username ?? 'Nama Lengkap, Gelar' }}
                            </span><br>
                            NIPY. {{ substr($seminar->dosenPenilai1->nim ?? '-', 0, 2) }}.
                            {{ substr($seminar->dosenPenilai1->nim ?? '-', 2, 3) }}.
                            {{ substr($seminar->dosenPenilai1->nim ?? '-', 5) }}
                        </div>
                    </div>

                    <div class="signature-box">
                        <div class="text-start">
                            Tegal, {{ date('j F Y') }}<br>
                            Pembimbing II<br><br><br><br><br>
                        </div>
                        <div class="text-start">
                            <span style="text-decoration: underline;">
                                {{ $seminar->dosenPenilai2->username ?? 'Nama Lengkap, Gelar' }}
                            </span><br>
                            NIPY. {{ substr($seminar->dosenPenilai2->nim ?? '-', 0, 2) }}.
                            {{ substr($seminar->dosenPenilai2->nim ?? '-', 2, 3) }}.
                            {{ substr($seminar->dosenPenilai2->nim ?? '-', 5) }}
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="alert alert-warning mt-5" role="alert">
                Surat rekomendasi belum dapat ditampilkan karena kedua dosen pembimbing belum memberikan rekomendasi.
            </div>
        @endif

    </div>

    @include('layouts.footer')

</body>
</html>
