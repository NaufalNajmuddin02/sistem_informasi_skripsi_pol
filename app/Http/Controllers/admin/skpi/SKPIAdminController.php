<?php

namespace App\Http\Controllers\admin\skpi;

use App\Http\Controllers\Controller;
use App\Models\SKPI;
use Illuminate\Http\Request;

class SKPIAdminController extends Controller
{
    //
    public function index(){
        $daftartabel = SKPI::with('user')->get();
        return view('admin.skpi.index', compact('daftartabel'));
    }
    public function edit($id)
    {
        // $skpi sudah otomatis berisi 1 baris hasil route-model-binding
        // Tinggal eager-load relasinya:
        $skpi = SKPI::with('user')->findOrFail($id); // ✅ 
        return view('admin.skpi.edit', compact('skpi'));
    }
    public function update(Request $request, $id)
    {
        // 1. Validasi input: semua nilai boleh kosong, tapi jika diisi harus 0-100
        $rules = [];
        for ($i = 1; $i <= 10; $i++) {
            $rules["nilai_sertifikat$i"] = 'nullable|integer|min:0|max:100';
        }

        $validated = $request->validate($rules);

        // 2. Ambil data SKPI
        $skpi = SKPI::findOrFail($id);

        // 3. Simpan nilai-nilai yang sudah divalidasi
        for ($i = 1; $i <= 10; $i++) {
            $col = "nilai_sertifikat$i";
            if (array_key_exists($col, $validated)) {
                $skpi->$col = $validated[$col];
            }
        }

        $skpi->save();

        // 4. Redirect kembali dengan pesan sukses
        return redirect()
            ->route('admin.skpi.edit', $skpi->id)
            ->with('success', 'Nilai berhasil diperbarui.');
    }

}
