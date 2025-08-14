<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Seminar;
use Illuminate\Http\Request;
use App\Exports\RekapSeminarXlsxExport;

class RekapSeminarAdminController extends Controller
{
    public function index(Request $request)
    {
        $tahunAkademik = $request->input('tahun_akademik');
        $keyword = $request->input('keyword');

        $seminars = Seminar::with(['mahasiswa', 'dosenPenilai1', 'dosenPenilai2', 'kategoriProposal', 'penilaians'])
            ->when($tahunAkademik, fn($q) => $q->where('tahun_akademik', $tahunAkademik))
            ->when($keyword, fn($q) => $q->where('name', 'like', "%{$keyword}%"))
            ->paginate(20);

        $tahunList = Seminar::select('tahun_akademik')->distinct()->pluck('tahun_akademik');

        return view('admin.rekap_seminar_admin', compact('seminars', 'tahunList', 'tahunAkademik', 'keyword'));
    }


    public function export(Request $request)
    {
        $tahunAkademik = $request->input('tahun_akademik');
        return RekapSeminarXlsxExport::export($tahunAkademik);
    }
}