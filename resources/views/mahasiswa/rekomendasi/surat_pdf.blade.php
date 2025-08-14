<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Surat Rekomendasi Sidang</title>
    <style>
        body {
            font-family: 'Times New Roman', Times, serif;
        }

        .center {
            text-align: center;
        }

        .recommendation-frame {
            padding: 20px;
            margin: 20px;
        }

        .info-table {
            width: 100%;
            margin-top: 20px;
        }

        .info-table th, .info-table td {
            text-align: left;
            padding: 5px;
            font-weight: normal; 
        }


        .signatures-wrapper {
            margin-top: 50px;
            width: 100%;
            display: table;
            table-layout: fixed;
        }

        .signature-box {
            display: table-cell;
            width: 45%; 
            vertical-align: top;
            text-align: left;
            padding: 0 20px; 
        }


        @media print {
            .signatures-wrapper {
                margin-top: 50px;
                width: 100%;
                display: table;
                table-layout: fixed;
            }

            .signature-box {
                display: table-cell;
                width: 50%;
                vertical-align: top;
                text-align: center;
                break-inside: avoid;
                page-break-inside: avoid;
            }

            body, .recommendation-frame {
                margin: 0;
                padding: 0;
            }
        }


    </style>
</head>
<body>
    <div class="center">
        <h3>HALAMAN REKOMENDASI</h3>
    </div>

    <div class="recommendation-frame">
        <p>Pembimbing Tugas Akhir memberikan rekomendasi kepada:</p>
        <table class="info-table">
            <tr>
                <th>Nama</th>
                <td>: {{ $seminar->user->username }}</td>
            </tr>
            <tr>
                <th>NIM</th>
                <td>: {{ $seminar->user->nim }}</td>
            </tr>
            <tr>
                <th>Program Studi</th>
                <td>: {{ $seminar->user->prodi }}</td>
            </tr>
            <tr>
                <th>Judul Tugas Akhir</th>
                <td>: {{ $seminar->script_title }}</td>
            </tr>
        </table>
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
                <br><br>
                Pembimbing I<br><br><br><br><br>
                <span style="text-decoration: underline;">
                    {{ $seminar->dosenPenilai1->username ?? 'Nama Lengkap, Gelar' }}
                </span><br>
                NIPY. {{ substr($seminar->dosenPenilai1->nim ?? '-', 0, 2) }}.
                {{ substr($seminar->dosenPenilai1->nim ?? '-', 2, 3) }}.
                {{ substr($seminar->dosenPenilai1->nim ?? '-', 5) }}
            </div>
            <div class="signature-box">
                Tegal, {{ date('j F Y') }}<br><br>
                Pembimbing II<br><br><br><br><br>
                <span style="text-decoration: underline;">
                    {{ $seminar->dosenPenilai2->username ?? 'Nama Lengkap, Gelar' }}
                </span><br>
                NIPY. {{ substr($seminar->dosenPenilai2->nim ?? '-', 0, 2) }}.
                {{ substr($seminar->dosenPenilai2->nim ?? '-', 2, 3) }}.
                {{ substr($seminar->dosenPenilai2->nim ?? '-', 5) }}
            </div>
        </div>

    </div>
</body>
</html>