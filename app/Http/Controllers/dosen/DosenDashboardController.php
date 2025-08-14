<?php

namespace App\Http\Controllers\dosen;
use App\Http\Controllers\Controller;
use App\Models\InfoTerbaru;
use App\Models\Proposal;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DosenDashboardController extends Controller
{
    public function index()
    {
        // Ambil username dosen dari user yang sedang login
        $dosenName = auth()->user()->username;

        // Hitung jumlah mahasiswa yang diampu berdasarkan nama_dosen yang sesuai
        $jumlahMahasiswa = Proposal::whereHas('user', function($query) use ($dosenName) {
            $query->where('nama_dosen', $dosenName);
        })->count();

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

        return view('dosen.dashboard', compact('jumlahMahasiswa',
        'tahunAkademik',
        'semester','infoTerbaru'));
    }

}
