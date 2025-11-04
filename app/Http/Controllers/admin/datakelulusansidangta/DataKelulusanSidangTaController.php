<?php

namespace App\Http\Controllers\admin\datakelulusansidangta;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class DataKelulusanSidangTaController extends Controller
{
    //
    public function index(Request $request)
    {
        $prodiUser = auth()->user()->prodi;

        // Ambil tahun dari request (jika ada)
        $tahunFilter = $request->get('tahun');

        $mahasiswa = DB::table('users')
            ->where('users.role', 'mahasiswa')
            ->where('users.prodi', $prodiUser)
            ->leftJoin('penilaian_dosen_penilai as pdp', 'users.id', '=', 'pdp.mahasiswa_id')
            ->select(
                'users.id',
                'users.username',
                'users.nim',
                DB::raw("YEAR(pdp.created_at) as tahun"), // 🟢 ambil tahun dari created_at
                DB::raw("CASE WHEN pdp.status = 'lulus' THEN 'Lulus' ELSE 'Belum Lulus' END as status_kelulusan")
            )
            ->when($tahunFilter, function ($query) use ($tahunFilter) {
                return $query->whereYear('pdp.created_at', $tahunFilter);
            })
            ->get();

        // Ambil semua tahun unik untuk dropdown
        $tahunList = DB::table('penilaian_dosen_penilai')
            ->select(DB::raw('YEAR(created_at) as tahun'))
            ->distinct()
            ->orderByDesc('tahun')
            ->pluck('tahun');

        return view('admin.sidangta.datakelulusansidangta', compact('mahasiswa', 'tahunList', 'tahunFilter'));
    }

}
