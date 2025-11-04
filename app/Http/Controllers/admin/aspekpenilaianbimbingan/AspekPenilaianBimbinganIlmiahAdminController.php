<?php

namespace App\Http\Controllers\admin\aspekpenilaianbimbingan;

use App\Http\Controllers\Controller;
use App\Models\PenilaianBimbinganIlmiah;
use Illuminate\Http\Request;

class AspekPenilaianBimbinganIlmiahAdminController extends Controller
{
    public function create()
    {
        return view('admin.aspekpenilaianbimbinganilmiah.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'unsur_yang_dinilai' => 'required|string|max:255',
            'kriteria' => 'required|string|max:255',
            'bobot' => 'required|integer|min:1|max:20',
        ]);

        PenilaianBimbinganIlmiah::create($request->all());

        return redirect()->route('penilaian.hki.index')
                         ->with('success', 'Data berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $aspek = PenilaianBimbinganIlmiah::findOrFail($id);
        return view('admin.aspekpenilaianbimbinganilmiah.edit', compact('aspek'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'unsur_yang_dinilai' => 'required|string|max:255',
            'kriteria' => 'required|string|max:255',
            'bobot' => 'required|integer|min:1|max:20',
        ]);

        $aspek = PenilaianBimbinganIlmiah::findOrFail($id);
        $aspek->update($request->all());

        return redirect()->route('penilaian.hki.index')
                         ->with('success', 'Aspek penilaian berhasil diperbarui');
    }

    public function destroy($id)
    {
        $aspek = PenilaianBimbinganIlmiah::findOrFail($id);
        $aspek->delete();

        return redirect()->route('penilaian.hki.index')
                         ->with('success', 'Aspek penilaian berhasil dihapus');
    }
}
