<?php

namespace App\Exports;

use App\Models\Seminar;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Illuminate\Support\Facades\Response;

class RekapSeminarXlsxExport
{
    public static function export($tahunAkademik)
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Header kolom
        $sheet->fromArray([
            [
                'Nama Mahasiswa',
                'Kelas',
                'Judul',
                'Dosen 1',
                'Dosen 2',
                'Ruangan',
                'Tanggal',
                'Jam',
                'Selesai',
                'Kategori',
                'Status',
                'Nilai Akhir'
            ]
        ], NULL, 'A1');

        // Ambil data
        $seminars = Seminar::with(['mahasiswa', 'dosenPenilai1', 'dosenPenilai2', 'kategoriProposal', 'penilaians'])
            ->when($tahunAkademik, function ($query, $tahunAkademik) {
                return $query->where('tahun_akademik', $tahunAkademik);
            })
            ->get();

        $row = 2;
        foreach ($seminars as $seminar) {
            $penilaian1 = $seminar->penilaians->where('peran_penilai', 'dosen1')->first();
            $penilaian2 = $seminar->penilaians->where('peran_penilai', 'dosen2')->first();

            $sheet->fromArray([
                $seminar->name ?? '-',
                $seminar->class,
                $seminar->script_title,
                $seminar->dosen_penilai_1_nama ?? '-',
                $seminar->dosen_penilai_2_nama ?? '-',
                $seminar->ruangan,
                $seminar->tanggal,
                $seminar->jam,
                $seminar->jam_selesai,
                $seminar->kategoriProposal->nama_kategori ?? '-',
                $seminar->status ?? '-',
                $seminar->nilai ?? '-',
            ], NULL, 'A' . $row++ );
        }

        // Simpan sementara ke memori
        $writer = new Xlsx($spreadsheet);
        $filename = 'rekap-seminar.xlsx';

        // Simpan ke memori dan buat response
        ob_start();
        $writer->save('php://output');
        $excelOutput = ob_get_clean();

        return Response::make($excelOutput, 200, [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'Content-Disposition' => "attachment; filename=\"$filename\"",
            'Cache-Control' => 'max-age=0',
        ]);
    }
}
