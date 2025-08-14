<?php

namespace App\Http\Controllers\dosen_penilai\validasi_skripsi;

use App\Http\Controllers\Controller;
use App\Models\ValidasiSkripsiPenguji;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ValidasiPengujiController extends Controller
{
    //
    public function approve($id, $field)
    {
        $allowedFields = ['status_ketua', 'status_penguji1', 'status_penguji2'];

        if (!in_array($field, $allowedFields)) {
            return back()->with('error', 'Aksi tidak valid.');
        }

        $data = ValidasiSkripsiPenguji::findOrFail($id);

        // Validasi: hanya boleh menyetujui jika nama login cocok
        $user = Auth::user()->username;
        $isAllowed =
            ($field == 'status_ketua' && $data->ketua_penguji === $user) ||
            ($field == 'status_penguji1' && $data->penguji1 === $user) ||
            ($field == 'status_penguji2' && $data->penguji2 === $user);

        if (!$isAllowed) {
            return back()->with('error', 'Anda tidak berhak memvalidasi skripsi ini.');
        }

        $data->$field = 'disetujui';
        $data->save();

        return back()->with('success', 'Skripsi telah disetujui.');
    }
    public function index()
    {
        $username = Auth::user()->username;

    // Ambil semua skripsi di mana dosen login terdaftar sebagai ketua atau penguji
        $skripsiList = ValidasiSkripsiPenguji::where('ketua_penguji', $username)
        ->orWhere('penguji1', $username)
        ->orWhere('penguji2', $username)
        ->get();

        return view('dosen_penilai.validasi_skripsi.index', compact('skripsiList'));
    }
}
