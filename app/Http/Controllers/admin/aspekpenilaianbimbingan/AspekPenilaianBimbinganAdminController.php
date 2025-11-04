<?php

namespace App\Http\Controllers\admin\aspekpenilaianbimbingan;

use App\Http\Controllers\Controller;
use App\Models\PenilaianBimbinganHKI;
use App\Models\PenilaianBimbinganIlmiah;
use App\Models\PenilaianBimbinganSkripsi;
use App\Models\PenilaianSidangTAHKI;
use App\Models\PenilaianSidangTAIlmiah;
use App\Models\PenilaianSidangTASkripsi;
use Illuminate\Http\Request;

class AspekPenilaianBimbinganAdminController extends Controller
{
    //
     public function index(Request $request)
    {
        // Ambil semua data dari tabel nilai_bimbingan_hki
        $aspekPenilaian = PenilaianBimbinganHKI::orderBy('id', 'asc')->paginate(15);
        $aspekPenilaianSkripsi = PenilaianBimbinganSkripsi::orderBy('id', 'asc')->paginate(15);
        $aspekPenilaianIlmiah = PenilaianBimbinganIlmiah::orderBy('id', 'asc')->paginate(15);
        $aspekPenilaianSidangHKI = PenilaianSidangTAHKI::orderBy('id', 'asc')->paginate(15);
        $aspekPenilaianSidangSkripsi = PenilaianSidangTASkripsi::orderBy('id', 'asc')->paginate(15);
        $aspekPenilaianSidangIlmiah = PenilaianSidangTAIlmiah::orderBy('id', 'asc')->paginate(15);

        // Kirim ke view
        return view('admin.aspekpenilaianbimbinganhki.index', compact('aspekPenilaian','aspekPenilaianSkripsi','aspekPenilaianIlmiah','aspekPenilaianSidangHKI','aspekPenilaianSidangSkripsi','aspekPenilaianSidangIlmiah'));
    }

     public function create()
    {
        return view('admin.aspekpenilaianbimbinganhki.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'unsur_yang_dinilai' => 'required|string|max:255',
            'kriteria' => 'required|string|max:255',
            'bobot' => 'required|integer',
        ]);

        PenilaianBimbinganHKI::create($request->all());

        return redirect()->route('penilaian.hki.index')->with('success', 'Data berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $aspek = PenilaianBimbinganHKI::findOrFail($id);
        return view('admin.aspekpenilaianbimbinganhki.edit', compact('aspek'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'unsur_yang_dinilai' => 'required|string|max:255',
            'kriteria' => 'required|string|max:255',
            'bobot' => 'required|integer|min:1|max:20',
        ]);

        $aspek = PenilaianBimbinganHKI::findOrFail($id);
        $aspek->update($request->all());

        return redirect()->route('penilaian.hki.index')->with('success', 'Aspek penilaian berhasil diperbarui');
    }

    public function destroy($id)
    {
        $aspek = PenilaianBimbinganHKI::findOrFail($id);
        $aspek->delete();

        return redirect()->route('penilaian.hki.index')->with('success', 'Aspek penilaian berhasil dihapus');
    }
}
