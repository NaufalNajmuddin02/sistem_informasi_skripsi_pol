<?php

namespace App\Exports;

use App\Models\Proposal;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Illuminate\Support\Facades\Response;

class ProposalExport
{
    public static function export($tahunAkademik = null, $namaDosen = null, $status = null)
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Header
        $sheet->fromArray([
            [
                'Nama',
                'NIM',
                'Dosen Pengampu',
                'Kelas',
                'Tanggal Pengajuan',
                'Judul Skripsi',
                'Kategori',
                'Tahun Akademik',
                'Status',
                'Abstrak',
                'Link'
            ]
        ], null, 'A1');

        // Ambil semua data berdasarkan filter
        $proposals = Proposal::with('user', 'kategori')
            ->when($tahunAkademik, fn($q) => $q->where('tahun_akademik', $tahunAkademik))
            ->when($namaDosen, fn($q) => $q->where('nama_dosen', 'like', "%$namaDosen%"))
            ->when($status, fn($q) => $q->where('status', $status))
            ->orderByDesc('created_at')
            ->get();

        $row = 2;
        foreach ($proposals as $proposal) {
            $sheet->fromArray([
                $proposal->name,
                $proposal->user->nim ?? '-',
                $proposal->nama_dosen,
                $proposal->class,
                $proposal->submission_date,
                $proposal->script_title,
                $proposal->kategori->nama_kategori ?? '-',
                $proposal->tahun_akademik,
                $proposal->status,
                strip_tags($proposal->abstract), // Hindari tag HTML
                $proposal->link ?? '-',
            ], null, 'A' . $row++);
        }

        $writer = new Xlsx($spreadsheet);
        $filename = 'daftar-proposal.xlsx';

        ob_start();
        $writer->save('php://output');
        $output = ob_get_clean();

        return Response::make($output, 200, [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'Content-Disposition' => "attachment; filename=\"$filename\"",
            'Cache-Control' => 'max-age=0',
        ]);
    }
}
