<?php

namespace App\Http\Controllers\mahasiswa\skpi;

use App\Http\Controllers\Controller;
use App\Models\SKPI;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SKPIMahasiswaController_ extends Controller
{
    //
    public function create(){
        $alreadyUploaded = SKPI::where('user_id', Auth::user()->id)->exists();

        return view('mahasiswa.skpi.create', compact('alreadyUploaded'));
    }
    public function store(Request $request)
    {
        // 1) Validasi hanya file
        $rules = [];
        for ($i = 1; $i <= 10; $i++) {
            $rules["sertifikat_$i"] = 'required|file|mimes:pdf,png,jpg,jpeg|max:2048';
        }
        $validated = $request->validate($rules);

        // 2) Simpan file & path-nya
        $skpi = new SKPI();
        $skpi->user_id = Auth::user()->id;         // id mahasiswa yang login

        foreach ($validated as $key => $file) {
            // Contoh: sertifikat_1 → storage/app/public/skpi/{user_id}/sertifikat_1/xxxx.pdf
            $folder = "skpi/" . auth()->id() . "/$key";
            $path = $file->store($folder, 'public');
            // kolom di DB: sertifikat1, sertifikat2, ...
            $col = str_replace('sertifikat_', 'sertifikat', $key);
            $skpi->$col = $path;
        }

        // nilai_* otomatis 0 (sesuai default di migration)
        $skpi->save();

        return back()->with('success', 'Sertifikat berhasil di-upload!');
    }
}
