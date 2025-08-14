<?php

namespace App\Http\Controllers\kaprodi;

use App\Http\Controllers\Controller;
use App\Models\YudisiumJadwal;
use Illuminate\Http\Request;

class JadwalYudisiumKaprodiController extends Controller
{
    //
    public function create(){
        return view('kaprodi.jadwal.jadwal-yudisium');
    }
    public function store(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'waktu_mulai' => 'required',
            'waktu_selesai' => 'required',
            'ruangan' => 'required|string',
        ]);

        YudisiumJadwal::create([
            'tanggal' => $request->tanggal,
            'waktu_mulai' => $request->waktu_mulai,
            'waktu_selesai' => $request->waktu_selesai,
            'ruangan' => $request->ruangan,
            'keterangan' => $request->keterangan,
            'created_by' => auth()->id(),
        ]);

        return redirect()->route('yudisium.index')->with('success', 'Jadwal berhasil ditambahkan');
    }
    public function index()
    {
        $jadwal = YudisiumJadwal::with('creator')->latest()->get();
        return view('kaprodi.jadwal.index-jadwal-yudisium', compact('jadwal'));
    }
    public function edit($id)
    {
        $jadwal = YudisiumJadwal::findOrFail($id);
        return view('kaprodi.jadwal.edit-jadwal-yudisium', compact('jadwal'));
    }

    public function destroy($id)
    {
        $jadwal = YudisiumJadwal::findOrFail($id);
        $jadwal->delete();

        return redirect()->route('yudisium.index')->with('success', 'Jadwal berhasil dihapus.');
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'waktu_mulai' => 'required',
            'waktu_selesai' => 'required',
            'ruangan' => 'required|string|max:100',
            'keterangan' => 'nullable|string',
        ]);

        $jadwal = \App\Models\YudisiumJadwal::findOrFail($id);

        $jadwal->update([
            'tanggal' => $request->tanggal,
            'waktu_mulai' => $request->waktu_mulai,
            'waktu_selesai' => $request->waktu_selesai,
            'ruangan' => $request->ruangan,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->route('yudisium.index')->with('success', 'Jadwal yudisium berhasil diperbarui.');
    }
}
