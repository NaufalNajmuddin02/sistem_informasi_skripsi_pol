<?php

namespace App\Http\Controllers\mahasiswa\skripsi;
use App\Models\Seminar;
use Illuminate\Http\Request;
use App\Models\PengumpulanSkripsi;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PengumpulanBerkasAkhirController extends Controller
{

    public function pengumpulanberkasakhir()
    {
        return view('mahasiswa.skripsi.pengumpulan-berkas-akhir');
    }
    public function pengumpulanberkasSkripsi()
    {
        $existing = PengumpulanSkripsi::where('user_id', auth()->id())->first();

        if ($existing) {
            return redirect()->route('berkas.skripsi.lihat')->with('info', 'Anda sudah mengunggah berkas skripsi.');
        }

        return view('mahasiswa.skripsi.berkas.create');
    }
    public function liatberkas()
    {
        $mahasiswa = Auth::user();
$seminar = Seminar::where('user_id', $mahasiswa->id)->first();
        $skripsiList = PengumpulanSkripsi::with('user')->get();
        return view('mahasiswa.skripsi.berkas.index', compact('skripsiList'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'judul_skripsi' => 'required|string|max:255',
        
            'file_skripsi' => 'required|mimes:pdf|max:20480' // Max 20MB
        ]);

        // Simpan file
        $file = $request->file('file_skripsi');
        $wa = $request->input('no_wa');
        $fileName = time() . '_' . $file->getClientOriginalName();
        $filePath = $file->storeAs('skripsi', $fileName, 'public');

        // Simpan ke database
        PengumpulanSkripsi::create([
            'user_id' => auth()->id(),
            'judul_skripsi' => $request->judul_skripsi,
            'email' => $request->email,
            'file_skripsi' => $filePath,
            'no_wa'=> $wa,
            'status_skripsi' => 'belum disetujui',
        ]);

        return redirect()->route('berkas.skripsi.lihat')->with('success', 'Berkas skripsi berhasil dikumpulkan!');
    }
    public function updateAll(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'nim' => 'required|string|max:20',
            'judul_skripsi' => 'required|string|max:255',
            'email' => 'required|email',
            'no_wa' => 'required|string|max:20',
            'file_skripsi' => 'nullable|mimes:pdf|max:20480',
        ]);

        $skripsi = PengumpulanSkripsi::findOrFail($id);
        $user = $skripsi->user;

        // Update data user jika perlu
        $user->username = $request->nama;
        $user->nim = $request->nim;
        $user->save();

        // Jika ada file baru
        if ($request->hasFile('file_skripsi')) {
            if ($skripsi->file_skripsi && Storage::disk('public')->exists($skripsi->file_skripsi)) {
                Storage::disk('public')->delete($skripsi->file_skripsi);
            }

            $file = $request->file('file_skripsi');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('skripsi', $fileName, 'public');

            $skripsi->file_skripsi = $filePath;
            $skripsi->status_skripsi = 'belum disetujui'; // Reset status jika file diganti
        }

        $skripsi->judul_skripsi = $request->judul_skripsi;
        $skripsi->email = $request->email;
        $skripsi->no_wa = $request->no_wa;
        $skripsi->save();

        return redirect()->back()->with('success', 'Data berhasil diperbarui.');
    }

}