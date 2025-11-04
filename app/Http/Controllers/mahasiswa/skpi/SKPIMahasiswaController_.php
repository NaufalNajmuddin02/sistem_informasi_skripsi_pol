<?php

namespace App\Http\Controllers\mahasiswa\skpi;

use App\Http\Controllers\Controller;
use App\Models\SKPI;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class SKPIMahasiswaController_ extends Controller
{
    public function create()
    {
        $skpi = SKPI::where('user_id', Auth::id())->first();
        $alreadyUploaded = (bool) $skpi;

        return view('mahasiswa.skpi.create', compact('alreadyUploaded', 'skpi'));
    }

    public function store(Request $request)
    {
        // Validasi
        $rules = [];
        for ($i = 1; $i <= 20; $i++) {
            $rules["nama_sertifikat$i"] = 'nullable|string|max:255';
            $rules["file_sertifikat$i"] = 'nullable|file|mimes:pdf,png,jpg,jpeg|max:2048';
        }
        $request->validate($rules);

        $skpi = new SKPI();
        $skpi->user_id = Auth::id();

        for ($i = 1; $i <= 20; $i++) {
            $namaField = "nama_sertifikat$i";
            $fileField = "file_sertifikat$i";
            $nilaiField = "nilai_sertifikat$i";

            if ($request->filled($namaField)) {
                $skpi->$namaField = $request->$namaField;
            }

            if ($request->hasFile($fileField)) {
                $folder = "skpi/" . Auth::id();
                $path = $request->file($fileField)->store($folder, 'public');
                $skpi->$fileField = $path;
            }

            $skpi->$nilaiField = 0;
        }

        $skpi->save();

        return redirect()->route('mahasiswa.skpi')->with('success', 'Data SKPI berhasil disimpan!');
    }

    public function edit()
    {
        $skpi = SKPI::where('user_id', Auth::id())->firstOrFail();
        return view('mahasiswa.skpi.edit', compact('skpi'));
    }

    public function update(Request $request)
    {
        $skpi = SKPI::where('user_id', Auth::id())->firstOrFail();

        $rules = [];
        for ($i = 1; $i <= 20; $i++) {
            $rules["nama_sertifikat$i"] = 'nullable|string|max:255';
            $rules["file_sertifikat$i"] = 'nullable|file|mimes:pdf,png,jpg,jpeg|max:2048';
        }
        $request->validate($rules);

        for ($i = 1; $i <= 20; $i++) {
            $namaField = "nama_sertifikat$i";
            $fileField = "file_sertifikat$i";

            // update nama
            if ($request->filled($namaField)) {
                $skpi->$namaField = $request->$namaField;
            }

            // update file
            if ($request->hasFile($fileField)) {
                // hapus file lama
                if ($skpi->$fileField && Storage::disk('public')->exists($skpi->$fileField)) {
                    Storage::disk('public')->delete($skpi->$fileField);
                }

                $folder = "skpi/" . Auth::id();
                $path = $request->file($fileField)->store($folder, 'public');
                $skpi->$fileField = $path;
            }
        }

        $skpi->save();

        return redirect()->route('mahasiswa.skpi')->with('success', 'Data SKPI berhasil diperbarui!');
    }
}
