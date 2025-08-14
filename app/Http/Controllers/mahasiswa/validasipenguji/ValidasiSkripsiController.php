<?php

namespace App\Http\Controllers\mahasiswa\validasipenguji;

use App\Http\Controllers\Controller;
use App\Models\admin\JadwalTAModel;
use App\Models\Seminar;
use App\Models\ValidasiSkripsiPenguji;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ValidasiSkripsiController extends Controller
{
    //
    public function create()
    {
        $user = Auth::user();

        $berkas = ValidasiSkripsiPenguji::where('user_id', $user->id)->first();

        if ($berkas) {
            // Sudah pernah input → tampilkan detail/index
            return view('mahasiswa.validasi_skripsi_penguji.index', compact('berkas'));
        } else {
            // Belum input → ambil info awal & tampilkan form input
            $jadwal = JadwalTAModel::with(['ketuaPenguji', 'penguji1', 'penguji2'])
                        ->where('user_id', $user->id)
                        ->first();

            $nama = $user->username;
            $judul = $jadwal->judul ?? '-';
            $ketua = $jadwal->ketuaPenguji->username ?? '-';
            $dosen1 = $jadwal->penguji1->username ?? '-';
            $dosen2 = $jadwal->penguji2->username ?? '-';

            return view('mahasiswa.validasi_skripsi_penguji.create', compact('nama', 'judul', 'ketua', 'dosen1', 'dosen2'));
        }
    }
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string',
            'kelas' => 'required|string',
            'judul_skripsi' => 'required|string',
            'ketua' => 'required|string',
            'penguji1' => 'required|string',
            'penguji2' => 'required|string',
            'file_skripsi' => 'required|file|mimes:pdf,doc,docx|max:20480',
        ]);

        $user = Auth::user();

        $filePath = $request->file('file_skripsi')->store('skripsi', 'public');

        ValidasiSkripsiPenguji::create([
            'user_id' => $user->id,
            'nama' => $request->nama,
            'judul_skripsi' => $request->judul_skripsi,
            'kelas' => $request->kelas,
            'file_skripsi' => $filePath,
            'ketua_penguji' => $request->ketua,
            'penguji1' => $request->penguji1,
            'penguji2' => $request->penguji2,
            'status_ketua' => 'belum disetujui',
            'status_penguji1' => 'belum disetujui',
            'status_penguji2' => 'belum disetujui',
        ]);

        return redirect()->back()->with('success', 'Berkas berhasil dikumpulkan dan menunggu validasi dosen.');
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'kelas' => 'required|string',
            'judul_skripsi' => 'required|string',
            'file_skripsi' => 'nullable|file|mimes:pdf,doc,docx|max:20480',
        ]);

        $berkas = ValidasiSkripsiPenguji::findOrFail($id);

        // Cek apakah file baru diunggah
        if ($request->hasFile('file_skripsi')) {
            $filePath = $request->file('file_skripsi')->store('skripsi', 'public');
            $berkas->file_skripsi = $filePath;
        }

        // Update data lainnya
        $berkas->kelas = $request->kelas;
        $berkas->judul_skripsi = $request->judul_skripsi;

        // Simpan perubahan
        $berkas->save();

        return redirect()->back()->with('success', 'Data berkas akhir berhasil diperbarui.');
    }
}
