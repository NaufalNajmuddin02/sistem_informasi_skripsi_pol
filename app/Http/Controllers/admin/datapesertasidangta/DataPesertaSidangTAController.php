<?php

namespace App\Http\Controllers\admin\datapesertasidangta;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class DataPesertaSidangTAController extends Controller
{
    public function index()
    {
        $prodiUser = auth()->user()->prodi;

        $mahasiswa = DB::table('users')
            ->leftJoin('seminars', 'users.id', '=', 'seminars.user_id')
            ->leftJoin('table_pendaftaran_t_a as pta', function ($join) {
                $join->on(DB::raw('users.nim COLLATE utf8mb4_unicode_ci'), '=', DB::raw('pta.nim COLLATE utf8mb4_unicode_ci'));
            })
            ->select(
                'users.id',
                'users.username',
                'users.nim',
                'seminars.script_title as judul',
                DB::raw("YEAR(pta.created_at) as tahun_pendaftaran"),
                DB::raw("CASE WHEN pta.nim IS NOT NULL THEN 'Sudah Mendaftar' ELSE 'Belum Mendaftar' END as status_pendaftaran")
            )
            ->where('users.role', '=', 'mahasiswa')
            ->where(DB::raw('users.prodi COLLATE utf8mb4_unicode_ci'), '=', DB::raw("'" . $prodiUser . "' COLLATE utf8mb4_unicode_ci"))
            ->get();

        // 🔹 Ambil daftar tahun unik dari pta.created_at
        $tahunList = DB::table('table_pendaftaran_t_a')
            ->selectRaw('DISTINCT YEAR(created_at) as tahun')
            ->orderBy('tahun', 'desc')
            ->pluck('tahun');

        return view('admin.sidangta.datapendaftarsidangta', compact('mahasiswa', 'tahunList'));
    }

}
