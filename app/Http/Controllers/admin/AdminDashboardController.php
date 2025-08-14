<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\InfoTerbaru;
use App\Models\User;
use Carbon\Carbon;
use DB;


class AdminDashboardController extends Controller
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

        // Informasi kontak pelayanan
        $infoTerbaru = InfoTerbaru::latest()->take(5)->get();

        // Mengirim data ke view
        return view('admin.dashboard', compact(
            'jumlahMahasiswa', 
            'jumlahDosen', 
            'jumlahAdmin', 
            'jumlahKaprodi', 
            'jumlahDosenPenilai', 
            'prodiStatistik',
            'tahunAkademik',
            'infoTerbaru',
            'semester'
        ));
    }
}
