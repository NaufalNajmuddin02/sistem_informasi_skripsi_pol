<?php

namespace App\Http\Controllers\perpus;

use App\Http\Controllers\Controller;
use App\Models\PengumpulanSkripsi;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PerpusController extends Controller
{
    //
    public function dashboard(){
        $prodiUser = auth()->user()->prodi;

        // Menghitung jumlah pengguna berdasarkan role dan prodi
        $jumlahMahasiswa = User::where('role', 'mahasiswa')
            ->where('prodi', $prodiUser)
            ->count();
        $jumlahDosen = User::where('role', 'dosen')
            ->where('prodi', $prodiUser)
            ->count();
        $jumlahAdmin = User::where('role', 'admin')
            ->where('prodi', $prodiUser)
            ->count();
        $jumlahKaprodi = User::where('role', 'kaprodi')
            ->where('prodi', $prodiUser)
            ->count();
        $jumlahDosenPenilai = User::where('role', 'dosen_penilai')
            ->where('prodi', $prodiUser)
            ->count();

        // Menghitung jumlah mahasiswa berdasarkan prodi yang sama dengan user
        $prodiStatistik = User::where('role', 'mahasiswa')
            ->where('prodi', $prodiUser)
            ->select('prodi', DB::raw('count(*) as total'))
            ->groupBy('prodi')
            ->get();

        // Kalender Akademik Otomatis
        $now = Carbon::now();
        $currentYear = $now->year;
        $month = $now->month;

        // Menentukan tahun akademik dan semester
        if ($month >= 8) {
            // Semester Ganjil dimulai Agustus
            $tahunAkademik = "$currentYear/" . ($currentYear + 1);
            $semester = "Ganjil";
        } elseif ($month >= 2) {
            // Semester Genap dimulai Februari
            $tahunAkademik = ($currentYear - 1) . "/$currentYear";
            $semester = "Genap";
        } else {
            // Januari dianggap bagian akhir semester ganjil
            $tahunAkademik = ($currentYear - 1) . "/$currentYear";
            $semester = "Ganjil";
        }

        // Mengirim data ke view
        return view('perpus.dashboard', compact(
            'jumlahMahasiswa', 
            'jumlahDosen', 
            'jumlahAdmin', 
            'jumlahKaprodi', 
            'jumlahDosenPenilai', 
            'prodiStatistik',
            'tahunAkademik',
            'semester'
        ));
    }
    public function index(){
        $skripsiList = PengumpulanSkripsi::all();
        return view('perpus.berkas.index',compact('skripsiList'));
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
            'status_skripsi' => 'required|in:disetujui,belum disetujui',
        ]);

        $skripsi = PengumpulanSkripsi::findOrFail($id);
        $user = $skripsi->user;

        // Update user (opsional)
        $user->username = $request->nama;
        $user->nim = $request->nim;
        $user->save();

        // Ganti file jika ada upload baru
        if ($request->hasFile('file_skripsi')) {
            if ($skripsi->file_skripsi && Storage::disk('public')->exists($skripsi->file_skripsi)) {
                Storage::disk('public')->delete($skripsi->file_skripsi);
            }

            $file = $request->file('file_skripsi');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('skripsi', $fileName, 'public');
            $skripsi->file_skripsi = $filePath;
        }

        $skripsi->judul_skripsi = $request->judul_skripsi;
        $skripsi->email = $request->email;
        $skripsi->no_wa = $request->no_wa;
        $skripsi->status_skripsi = $request->status_skripsi;
        $skripsi->save();

        return redirect()->back()->with('success', 'Data berhasil diperbarui.');
    }

}
