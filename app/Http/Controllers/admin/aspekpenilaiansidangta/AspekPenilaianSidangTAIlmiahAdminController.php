<?php

namespace App\Http\Controllers\admin\aspekpenilaiansidangta;

use App\Http\Controllers\Controller;
use App\Models\PenilaianSidangTAIlmiah;
use Illuminate\Http\Request;

class AspekPenilaianSidangTAIlmiahAdminController extends Controller
{
    //
     public function create()
    {
        return view('admin.aspekpenilaiansidangilmiah.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'unsur_yang_dinilai' => 'required|string|max:255',
            'kriteria' => 'required|string|max:255',
            'bobot' => 'required|integer|min:1|max:20',
        ]);

        PenilaianSidangTAIlmiah::create($request->all());

        return redirect()->route('penilaian.hki.index')->with('success', 'Data berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $aspek = PenilaianSidangTAIlmiah::findOrFail($id);
        return view('admin.aspekpenilaiansidangilmiah.edit', compact('aspek'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'unsur_yang_dinilai' => 'required|string|max:255',
            'kriteria' => 'required|string|max:255',
            'bobot' => 'required|integer|min:1|max:20',
        ]);

        $aspek = PenilaianSidangTAIlmiah::findOrFail($id);
        $aspek->update($request->all());

        return redirect()->route('penilaian.hki.index')->with('success', 'Aspek penilaian berhasil diperbarui');
    }

    public function destroy($id)
    {
        $aspek = PenilaianSidangTAIlmiah::findOrFail($id);
        $aspek->delete();

        return redirect()->route('penilaian.hki.index')->with('success', 'Aspek penilaian berhasil dihapus');
    }
}
