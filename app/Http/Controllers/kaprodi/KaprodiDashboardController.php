<?php

namespace App\Http\Controllers\kaprodi;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Proposal;
use App\Models\InfoTerbaru;

use Carbon\Carbon;
use DB;

class KaprodiDashboardController extends Controller
{
    public function index()
    {
        // Mendapatkan prodi dari user yang sedang login
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
            ->select('prodi', \DB::raw('count(*) as total'))
            ->groupBy('prodi')
            ->get();

        // Ambil username dosen dari user yang sedang login
        $dosenName = auth()->user()->username;

        // Hitung jumlah mahasiswa yang diampu berdasarkan nama_dosen yang sesuai
        $jumlahMahasiswaDiampu = Proposal::whereHas('user', function($query) use ($dosenName) {
            $query->where('nama_dosen', $dosenName);
        })->count();

        // Kalender Akademik Otomatis
        $now = Carbon::now();
        $currentYear = $now->year;
        $month = $now->month;

        // Menentukan tahun akademik dan semester
        if ($month >= 8) {
            $tahunAkademik = "$currentYear/" . ($currentYear + 1);
            $semester = "Ganjil";
        } elseif ($month >= 2) {
            $tahunAkademik = ($currentYear - 1) . "/$currentYear";
            $semester = "Genap";
        } else {
            $tahunAkademik = ($currentYear - 1) . "/$currentYear";
            $semester = "Ganjil";
        }

                // Ambil informasi terbaru dari admin (dari tabel info_terbaru)
        $infoTerbaru = InfoTerbaru::latest()->take(5)->get();

        // Mengirim data ke view
        return view('kaprodi.dashboard', compact(
            'jumlahMahasiswa', 
            'jumlahDosen', 
            'jumlahAdmin', 
            'jumlahKaprodi', 
            'jumlahDosenPenilai', 
            'prodiStatistik',
            'jumlahMahasiswaDiampu',
            'tahunAkademik',
            'infoTerbaru',
            'semester'
        ));
    }
}
