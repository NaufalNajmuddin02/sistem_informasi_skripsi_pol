<?php

namespace App\Http\Controllers\kaprodi\validasi_skripsi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ValidasiSkripsiKaprodiController extends Controller
{
    public function indexDospem1()
    {
        $user = Auth::user();

        // Ambil semua skripsi di mana user adalah dosen pembimbing 1
        $skripsiList = \App\Models\ValidasiSkripsi::where('dosen_pembimbing_1', $user->username)->get();

        return view('kaprodi.validasi_skripsi.index', compact('skripsiList'));
    }

    public function approveDospem1($id)
    {
        $skripsi = \App\Models\ValidasiSkripsi::findOrFail($id);
        $user = Auth::user();

        // Pastikan user adalah dospem 1
        if ($skripsi->dosen_pembimbing_1 === $user->username) {
            $skripsi->status_dospem_1 = 'disetujui';
            $skripsi->save();
            return redirect()->back()->with('success', 'Berkas berhasil disetujui.');
        }

        return redirect()->back()->with('error', 'Anda tidak memiliki izin untuk menyetujui berkas ini.');
    }
    public function indexDospem2()
    {
        $user = Auth::user();

        // Ambil semua skripsi di mana user adalah dosen pembimbing 2
        $skripsiList = \App\Models\ValidasiSkripsi::where('dosen_pembimbing_2', $user->username)->get();

        return view('kaprodi.validasi_skripsi.index_dospem2', compact('skripsiList'));
    }

    public function approveDospem2($id)
    {
        $skripsi = \App\Models\ValidasiSkripsi::findOrFail($id);
        $user = Auth::user();

        // Pastikan user adalah dospem 2
        if ($skripsi->dosen_pembimbing_2 === $user->username) {
            $skripsi->status_dospem_2 = 'disetujui';
            $skripsi->save();
            return redirect()->back()->with('success', 'Berkas berhasil disetujui sebagai Pembimbing 2.');
        }

        return redirect()->back()->with('error', 'Anda tidak memiliki izin untuk menyetujui berkas ini.');
    }

}
