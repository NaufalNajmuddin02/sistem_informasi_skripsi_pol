<?php

namespace App\Http\Controllers\admin\aspekpenilaianbimbingan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\PenilaianBimbinganSkripsi;

class AspekPenilaianBimbinganSkripsiAdminController extends Controller
{
    public function create()
    {
        return view('admin.aspekpenilaianbimbinganskripsi.create');
    }

    public function store(Request $request)
{
    $request->validate([
        'unsur_yang_dinilai' => 'required|string|max:255',
        'kriteria' => 'required|string|max:255',
        'bobot' => 'required|integer|min:1|max:20',
    ]);

    PenilaianBimbinganSkripsi::create($request->all());

    return redirect()->route('penilaian.hki.index')
                     ->with('success', 'Data berhasil ditambahkan!');
}

    public function update(Request $request, $id)
    {
        $request->validate([
            'unsur_yang_dinilai' => 'required|string|max:255',
            'kriteria' => 'required|string|max:255',
            'bobot' => 'required|integer|min:1|max:20',
        ]);

        $aspek = PenilaianBimbinganSkripsi::findOrFail($id);
        $aspek->update($request->all());

        return redirect()->route('penilaian.hki.index')
                        ->with('success', 'Aspek penilaian berhasil diperbarui');
    }

    public function destroy($id)
    {
        $aspek = PenilaianBimbinganSkripsi::findOrFail($id);
        $aspek->delete();

        return redirect()->route('penilaian.hki.index')
                        ->with('success', 'Aspek penilaian berhasil dihapus');
    }
    public function edit($id)
    {
        $aspek = PenilaianBimbinganSkripsi::findOrFail($id);
        return view('admin.aspekpenilaianbimbinganskripsi.edit', compact('aspek'));
    }
}