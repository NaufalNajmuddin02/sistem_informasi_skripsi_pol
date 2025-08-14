<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Lembar Bimbingan</title>
    <style>
        body {
            font-family: 'Times New Roman', Times, serif;
            font-size: 12pt;
            margin: 40px;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
            position: relative;
        }
        .header img {
            width: 80px;
            position: absolute;
            top: 0;
            left: 0;
        }
        h4{
            text-align: left;
            margin-left :100px;
            font-size: 12pt;
        }
        h3 {
            margin: 0;
            line-height: 1.4;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }
        th, td {
            border: 1px solid #000;
            padding: 6px;
            vertical-align: top;
        }
        th {
            background-color: #f0f0f0;
            text-align: center;
        }
        .no-border td {
            border: none;
            padding: 4px 0;
        }
        .signature-wrapper {
            width: 100%;
            margin-top: 50px;
            position: relative;
        }

        .signature-box {
            position: absolute;
            right: 0;
            text-align: left;
            line-height: 1.6;
        }


        .signature td {
            border: none;
            text-align: left;
        }
        .right {
            text-align: right;
        }
        .bold {
            font-weight: bold;
        }
        .indent-row td {
            padding-left: 20px;
        }
    </style>
</head>
<body>
    @php
        \Carbon\Carbon::setLocale('id');
    @endphp

    <div class="header">
        <div><img src="{{ $logoBase64 }}" alt="Logo"></div>
        <h4>D IV TEKNIK INFORMATIKA<br>POLITEKNIK HARAPAN BERSAMA</h4>
        <h3>LEMBAR BIMBINGAN TUGAS AKHIR</h3>
    </div>

    <table class="no-border">
        <tr>
            <td width="20%" class="bold">Nama</td>
            <td class="bold">: {{ $user->username }}</td>
        </tr>
        <tr>
            <td class="bold">NIM</td>
            <td class="bold">: {{ $user->nim }}</td>
        </tr>
        <tr>
            <td class="bold">No. Ponsel</td>
            <td class="bold">: {{ $user->no_hp }}</td>
        </tr>
        <tr class="indent-row">
            <td class="bold">Judul TA</td>
            <td class="bold">: {{ $seminar->script_title ?? '-' }}</td>
        </tr>
        <tr class="indent-row">
            <td class="bold">Dosen Pembimbing {{ $pembimbingKe }}</td>
            <td class="bold">: {{ $namaPembimbing }}</td>
        </tr>

    </table>


    <table>
        <thead>
            <tr>
                <th>No</th>
                <th style="width: 110px;">Tanggal</th>
                <th>Pemeriksaan</th>
                <th>Perbaikan Yang Perlu Dilakukan</th>
                <th>Paraf Pembimbing</th>
            </tr>
        </thead>
        <tbody>
            @foreach($bimbingans as $b)
            <tr>
                <td style="text-align: center;">{{ $loop->iteration }}</td>
                <td>{{ \Carbon\Carbon::parse($b->tanggal_format)->translatedFormat('j F Y') }}</td>
                <td>{{ $b->pemeriksaan }}</td>
                <td>{{ $b->perbaikan }}</td>
                <td></td>
            </tr>
            @endforeach
        </tbody>
    </table>
    

    <div class="signature-wrapper">
        <div class="signature-box">
            Tegal, {{ \Carbon\Carbon::now()->translatedFormat('j F Y') }}<br>
            Dosen Pembimbing {{ $pembimbingKe }}<br><br><br><br><br>
            <span style="text-decoration: underline;">{{ $namaPembimbing }}</span><br>
            NIPY.{{ substr($nipyPembimbing, 0, 2) }}.{{ substr($nipyPembimbing, 2, 3) }}.{{ substr($nipyPembimbing, 5) }}
        </div>
    </div>

</body>
</html>
