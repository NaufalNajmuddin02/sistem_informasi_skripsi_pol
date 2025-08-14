<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BatasWaktuPengajuan;

class BatasWaktuController extends Controller
{
    public function index()
    {
        $batasList = BatasWaktuPengajuan::orderBy('tahun_akademik', 'desc')->get();
        return view('admin.batas.index', compact('batasList'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tahun_akademik' => 'required|string',
            'tanggal_batas' => 'required|date|after_or_equal:today',
        ]);

        BatasWaktuPengajuan::updateOrCreate(
            ['tahun_akademik' => $request->tahun_akademik],
            ['tanggal_batas' => $request->tanggal_batas]
        );

        return redirect()->route('admin.batas.index')->with('success', 'Batas waktu berhasil disimpan untuk tahun akademik tersebut!');
    }

}
