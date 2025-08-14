<?php

namespace App\Http\Controllers\mahasiswa\BerkasAkhir;

use App\Http\Controllers\Controller;
use App\Models\Seminar;
use App\Models\ValidasiSkripsi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RevisiMahasiswaController extends Controller
{
    
    public function create(){
        $user = Auth::user(); 
        $nama= $user->username;
        $seminar = Seminar::where('user_id', $user->id)->first();
        $dosen1 = $seminar->dosen_penilai_1_nama ?? '';
        $dosen2 = $seminar->dosen_penilai_2_nama ?? '';
        $judul = $seminar->script_title ?? '';

        return view('mahasiswa.berkasAkhir.create', compact('dosen1','dosen2','nama','judul'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul_skripsi' => 'required|string',
            'kelas' => 'required|string',
            'file_skripsi' => 'required|file|mimes:pdf,doc,docx|max:20480',
        ]);

        $filePath = $request->file('file_skripsi')->store('berkas-akhir', 'public');

        ValidasiSkripsi::create([
            'user_id' => Auth::id(),
            'nama' => Auth::user()->username,
            'judul_skripsi' => $request->judul_skripsi,
            'kelas' => $request->kelas,
            'file_skripsi' => $filePath,
            'dosen_pembimbing_1' => $request->dospem1,
            'dosen_pembimbing_2' => $request->dospem2,
        ]);

        return redirect()->route('mahasiswa.berkas-akhir')->with('success', 'Berkas berhasil dikirim.');
    }
    public function index()
    {
        $user = Auth::user();

        $berkas = ValidasiSkripsi::where('user_id', $user->id)->first();

        if (!$berkas) {
            // Arahkan ke route create() yang benar
            return redirect()->route('mahasiswa.berkas-akhir.create');
        }

        return view('mahasiswa.berkasAkhir.index', compact('berkas'));
    }
    public function update(Request $request, $id)
    {
        $berkas = ValidasiSkripsi::findOrFail($id);

        $request->validate([
            'judul_skripsi' => 'required|string',
            'kelas' => 'required|string',
            'file_skripsi' => 'nullable|file|mimes:pdf,doc,docx|max:20480',
        ]);

        if ($request->hasFile('file_skripsi')) {
            $filePath = $request->file('file_skripsi')->store('berkas-akhir', 'public');
            $berkas->file_skripsi = $filePath;
        }

        $berkas->judul_skripsi = $request->judul_skripsi;
        $berkas->kelas = $request->kelas;
        $berkas->save();

        return redirect()->route('mahasiswa.berkas-akhir')->with('success', 'Berkas berhasil diperbarui.');
    }


}
