<?php

namespace App\Http\Controllers\admin\sidangta;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\PenilaianTugasAkhir;
use App\Http\Controllers\Controller;
use App\Models\PenilaianDosenPenilai;

class PenilaianTAControler extends Controller
{
    public function index()
    {
       $daftartabel = PenilaianDosenPenilai::with([
            'mahasiswa',
            'ketuaPenguji',
            'penguji1',
            'penguji2',
            'pembimbing.dosbing1',
            'pembimbing.dosbing2',
            'seminar'
        ])->get();

        return view('admin.penilaian.index', compact('daftartabel'));
    }
    public function destroy($id) {
        $peserta = PenilaianDosenPenilai::findOrFail($id);
        $peserta->delete();
        return redirect()->route('admin.daftarnilaita')->with('success', 'Data berhasil dihapus.');
    }
}
