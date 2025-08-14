<?php

namespace App\Http\Controllers\dosen_pembimbing;
use App\Http\Controllers\Controller;
use App\Models\Seminar;
use Carbon\Carbon;
use App\Models\InfoTerbaru;
use Illuminate\Http\Request;

class PembimbingDashboardController extends Controller
{
    public function index()
    {
        // Ambil username dosen dari user yang sedang login
        $dosenName = auth()->user()->username;

        // Hitung jumlah mahasiswa bimbingan berdasarkan nama dosen pembimbing 1 atau 2
        $jumlahMahasiswa = Seminar::where(function($query) use ($dosenName) {
            $query->where('dosen_penilai_1_nama', $dosenName)
                  ->orWhere('dosen_penilai_2_nama', $dosenName);
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

        // Informasi kontak pelayanan
        $infoTerbaru = InfoTerbaru::latest()->take(5)->get();

        return view('dosen_pembimbing.dashboard', compact('jumlahMahasiswa', 'tahunAkademik', 'semester', 'infoTerbaru'));
    }
}
