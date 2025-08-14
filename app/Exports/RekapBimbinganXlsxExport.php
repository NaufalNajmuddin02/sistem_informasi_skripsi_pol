<?php

namespace App\Exports;

use App\Models\Seminar;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Illuminate\Support\Facades\Response;

class RekapBimbinganXlsxExport
{
    public static function export($tahunAkademik)
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->fromArray([
            ['Nama Mahasiswa', 'Kelas', 'Judul', 'Dosen Pembimbing 1', 'Jumlah Bimbingan 1', 'Dosen Pembimbing 2', 'Jumlah Bimbingan2', 'Tahun Akademik']
        ], NULL, 'A1');

        $seminars = Seminar::with('bimbingan')
            ->when($tahunAkademik, function ($query) use ($tahunAkademik) {
                return $query->where('tahun_akademik', $tahunAkademik);
            })
            ->get();

        $row = 2;
        foreach ($seminars as $seminar) {
            $jumlah1 = $seminar->bimbingan->where('nama_dosen', $seminar->dosen_penilai_1_nama)->count();
            $jumlah2 = $seminar->bimbingan->where('nama_dosen', $seminar->dosen_penilai_2_nama)->count();

            $sheet->fromArray([
                $seminar->name,
                $seminar->class,
                $seminar->script_title,
                $seminar->dosen_penilai_1_nama,
                $jumlah1,
                $seminar->dosen_penilai_2_nama,
                $jumlah2,
                $seminar->tahun_akademik
            ], NULL, 'A' . $row++);
        }

        $writer = new Xlsx($spreadsheet);
        $filename = 'rekap-bimbingan.xlsx';

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
