<?php

namespace App\Http\Controllers\mahasiswa\bimbingan;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Bimbingan;
use App\Models\NamaDosen;
use App\Models\LogBimbingan;


class PengajuanPembimbingController extends Controller
{
    public function create()
    {
        $dosens = NamaDosen::all();  // Ambil semua dosen dari tabel nama_dosen
        return view('mahasiswa.bimbingan.create-pembimbing', compact('dosens'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'kelas' => 'required|in:A,B,C,D,E',
            'tanggal_mulai' => 'required|date',
            'nama_dosen' => 'required|exists:nama_dosen,nama_dosen', // Validasi berdasarkan nama dosen
            'periode' => 'required|string|max:255',
            'file_surat' => 'required|mimes:pdf,doc,docx|max:20480',
        ]);

        // Ambil id_dosen berdasarkan nama dosen
        $dosen = NamaDosen::where('nama_dosen', $request->nama_dosen)->first();

        $filePath = $request->file('file_surat')->store('surat_permohonan', 'public');

        Bimbingan::create([
            'user_id' => Auth::id(),
            'nama' => $request->nama,
            'kelas' => $request->kelas,
            'tanggal_mulai' => $request->tanggal_mulai,
            'nama_dosen' => $request->nama_dosen,
            'periode' => $request->periode,
            'file_surat' => $filePath,
            'id_dosen' => $dosen->id, 
        ]);

        return redirect()->route('pengajuan-pembimbing')->with('success', 'Pengajuan berhasil dikirim!');
    }

    public function edit($id)
    {
        $bimbingan = Bimbingan::findOrFail($id);
        $dosens = NamaDosen::all();  // Ambil data dosen untuk dropdown
        return view('mahasiswa.bimbingan.edit-pembimbing', compact('bimbingan', 'dosens'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'kelas' => 'required|in:A,B,C,D,E',
            'tanggal_mulai' => 'required|date',
            'nama_dosen' => 'required|exists:nama_dosen,nama_dosen',
            'periode' => 'required|string|max:255',
        ]);

        // Ambil id_dosen berdasarkan nama dosen
        $dosen = NamaDosen::where('nama_dosen', $request->nama_dosen)->first();

        $bimbingan = Bimbingan::findOrFail($id);
        $bimbingan->update([
            'nama' => $request->nama,
            'kelas' => $request->kelas,
            'tanggal_mulai' => $request->tanggal_mulai,
            'nama_dosen' => $request->nama_dosen,
            'periode' => $request->periode,
            'id_dosen' => $dosen->id, // Menyimpan id_dosen yang benar
        ]);

        return redirect()->route('pengajuan-pembimbing')->with('success', 'Pengajuan berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $bimbingan = Bimbingan::findOrFail($id);
        $bimbingan->delete();

        return redirect()->route('pengajuan-pembimbing')->with('success', 'Pengajuan berhasil dihapus!');
    }

    public function pengajuanpembimbing()
    {
        $bimbingans = Bimbingan::where('user_id', Auth::id())->get();
        return view('mahasiswa.bimbingan.pengajuan-pembimbing', compact('bimbingans'));
    }

}

