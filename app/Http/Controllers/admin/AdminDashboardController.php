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
        $mahasiswa = User::where('users.role', 'mahasiswa')
            ->leftJoin('seminars', 'users.id', '=', 'seminars.user_id')
            ->select('users.id', 'users.username', 'users.nim', 'seminars.rekomendasi_dosen_1', 'seminars.rekomendasi_dosen_2')
            ->get();

        // Hitung jumlah yang sudah direkomendasikan
        $jumlahDirekomendasikan = $mahasiswa->filter(function ($m) {
            return $m->rekomendasi_dosen_1 === 'direkomendasikan' 
                && $m->rekomendasi_dosen_2 === 'direkomendasikan';
        })->count();

        // Hitung jumlah yang belum direkomendasikan
        $jumlahBelum = $mahasiswa->count() - $jumlahDirekomendasikan;

        /// ========= STATISTIK PENDAFTARAN UJIAN ==============
        // Hitung total mahasiswa (berdasarkan prodi user login)
        $prodiUser = auth()->user()->prodi;

        $totalMahasiswa = User::where('role', 'mahasiswa')
            ->where('prodi', $prodiUser)
            ->count();

        // Ambil NIM mahasiswa yang sudah mendaftar TA
        $nimTerdaftar = \DB::table('table_pendaftaran_t_a')->pluck('nim');

        // Hitung mahasiswa yang sudah daftar
        $sudahDaftar = User::where('role', 'mahasiswa')
            ->where('prodi', $prodiUser)
            ->whereIn('nim', $nimTerdaftar)
            ->count();

        // Hitung mahasiswa yang belum daftar
        $belumDaftar = $totalMahasiswa - $sudahDaftar;
        /// ===================================================

        // Hitung jumlah user berdasarkan role dan prodi
        $jumlahMahasiswa = $totalMahasiswa;
        $jumlahDosen = User::where('role', 'dosen')->where('prodi', $prodiUser)->count();
        $jumlahAdmin = User::where('role', 'admin')->where('prodi', $prodiUser)->count();
        $jumlahKaprodi = User::where('role', 'kaprodi')->where('prodi', $prodiUser)->count();
        $jumlahDosenPenilai = User::where('role', 'dosen_penilai')->where('prodi', $prodiUser)->count();

        // Statistik mahasiswa per prodi
        $prodiStatistik = User::where('role', 'mahasiswa')
            ->where('prodi', $prodiUser)
            ->select('prodi', \DB::raw('count(*) as total'))
            ->groupBy('prodi')
            ->get();

        // statistik lolos dan belum lolos sidang
        $lulus = User::where('users.role', 'mahasiswa')
            ->leftJoin('penilaian_dosen_penilai as pdp', 'users.id', '=', 'pdp.mahasiswa_id')
            ->where('users.prodi', $prodiUser) // sesuai prodi login
            ->where('pdp.status', 'lulus')
            ->count();

        $belumLulus = User::where('users.role', 'mahasiswa')
            ->leftJoin('penilaian_dosen_penilai as pdp', 'users.id', '=', 'pdp.mahasiswa_id')
            ->where('users.prodi', $prodiUser)
            ->where(function ($q) {
                $q->whereNull('pdp.status')
                ->orWhere('pdp.status', '!=', 'lulus');
            })
            ->count();
                // Kalender Akademik Otomatis
        $now = Carbon::now();
        $currentYear = $now->year;
        $month = $now->month;

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

        // Info terbaru
        $infoTerbaru = InfoTerbaru::latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'jumlahMahasiswa',
            'jumlahDosen',
            'jumlahAdmin',
            'jumlahKaprodi',
            'jumlahDosenPenilai',
            'prodiStatistik',
            'tahunAkademik',
            'infoTerbaru',
            'semester',
            'jumlahDirekomendasikan',
            'jumlahBelum',
            'sudahDaftar',      
            'belumDaftar',     
            'lulus',          
            'belumLulus'     
        ));
    }

}
