<?php

namespace App\Http\Controllers\mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\InfoTerbaru;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Seminar;
use App\Models\Proposal;
// use App\Models\Sidang;
use Carbon\Carbon;

class MahasiswaDashboardController extends Controller
{
    public function index()
    {
        $mahasiswaId = Auth::user()->id;
    
        // Seminar terbaru
        $seminarTerbaru = Seminar::with(['dosenPenilai1', 'dosenPenilai2'])
            ->where('user_id', $mahasiswaId)
            ->where('status', 'Diterima')
            ->latest('tanggal')
            ->first();
    
        // Seminar terdekat
        $seminarTerdekat = Seminar::where('user_id', $mahasiswaId)
            ->where('status', 'Diterima')
            ->whereDate('tanggal', '>=', Carbon::today())
            ->orderBy('tanggal', 'asc')
            ->first();
    
        // Kalender Akademik Otomatis
        $now = Carbon::now();
        $currentYear = $now->year;
        $month = $now->month;
    
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
        // Ambil informasi terbaru dari admin (dari tabel info_terbaru)
        $infoTerbaru = InfoTerbaru::latest()->take(5)->get();


    
        return view('mahasiswa.dashboard', [
            'seminar' => $seminarTerbaru,
            'seminarTerdekat' => $seminarTerdekat,
            'tahunAkademik' => $tahunAkademik,
            'semester' => $semester,
            'infoTerbaru' => $infoTerbaru,
        ]);
    }
}
