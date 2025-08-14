<?php

namespace App\Http\Controllers\admin\sidangta;

use App\Http\Controllers\Controller;
use App\Models\PenilaianTugasAkhir;
use Illuminate\Http\Request;

class PenilaianTAControler extends Controller
{
    public function index(){
        $daftartabel = PenilaianTugasAkhir::all();
        return view('admin.penilaian.index',compact('daftartabel'));
    }
    public function destroy($id) {
        $peserta = PenilaianTugasAkhir::findOrFail($id);
        $peserta->delete();
        return redirect()->route('admin.daftarnilaita')->with('success', 'Data berhasil dihapus.');
    }
}
