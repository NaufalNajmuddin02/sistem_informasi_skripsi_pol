<?php

namespace App\Http\Controllers\kaprodi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Seminar;
use App\Exports\RekapBimbinganXlsxExport;


class RekapBimbinganController extends Controller
{
    public function index(Request $request)
    {
        $tahunAkademik = $request->input('tahun_akademik');
        $keyword = $request->input('keyword');

        $seminars = Seminar::with(['bimbingan', 'mahasiswa'])
            ->when($tahunAkademik, function ($query, $tahunAkademik) {
                $query->where('tahun_akademik', $tahunAkademik);
            })
            ->when($keyword, function ($query, $keyword) {
                $query->where('name', 'like', "%$keyword%");
            })
            ->paginate(20);

        $tahunList = Seminar::select('tahun_akademik')->distinct()->pluck('tahun_akademik');

        return view('kaprodi.rekap_bimbingan', compact('seminars', 'tahunList', 'tahunAkademik', 'keyword'));
    }


    public function export(Request $request)
    {
        $tahunAkademik = $request->input('tahun_akademik');
        return RekapBimbinganXlsxExport::export($tahunAkademik);
    }
}
