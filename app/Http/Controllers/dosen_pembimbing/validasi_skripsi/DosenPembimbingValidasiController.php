<?php

namespace App\Http\Controllers\dosen_pembimbing\validasi_skripsi;

use App\Http\Controllers\Controller;
use App\Models\ValidasiSkripsi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DosenPembimbingValidasiController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $skripsiList = ValidasiSkripsi::where('dosen_pembimbing_1', $user->username)->get();

        return view('dosen_pembimbing.validasi_skripsi.index', compact('skripsiList'));
    }

    public function approve($id)
    {
        $user = Auth::user();
        $skripsi = ValidasiSkripsi::findOrFail($id);

        if ($skripsi->dosen_pembimbing_1 === $user->username) {
            $skripsi->status_dospem_1 = 'disetujui';
            $skripsi->save();

            return redirect()->back()->with('success', 'Skripsi disetujui oleh dosen pembimbing 1.');
        }

        return redirect()->back()->with('error', 'Anda tidak berhak menyetujui skripsi ini.');
    }
    public function indexDospem2()
    {
        $user = Auth::user();

        $skripsiList = ValidasiSkripsi::where('dosen_pembimbing_2', $user->username)->get();

        return view('dosen_pembimbing.validasi_skripsi.index_dospem2', compact('skripsiList'));
    }

    public function approveDospem2($id)
    {
        $user = Auth::user();
        $skripsi = ValidasiSkripsi::findOrFail($id);

        if ($skripsi->dosen_pembimbing_2 === $user->username) {
            $skripsi->status_dospem_2 = 'disetujui';
            $skripsi->save();

            return redirect()->back()->with('success', 'Skripsi berhasil disetujui oleh Dosen Pembimbing 2.');
        }

        return redirect()->back()->with('error', 'Anda tidak memiliki izin untuk menyetujui berkas ini.');
    }
}
