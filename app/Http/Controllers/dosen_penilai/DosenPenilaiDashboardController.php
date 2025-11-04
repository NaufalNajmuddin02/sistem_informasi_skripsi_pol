<?php

namespace App\Http\Controllers\dosen_penilai;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Seminar;
use App\Models\Proposal;
use App\Models\Ruangan;
use App\Models\InfoTerbaru;
use Carbon\Carbon;
 use App\Models\admin\JadwalTAModel; 

class DosenPenilaiDashboardController extends Controller
{

public function index()
{
    $dosenId = Auth::user()->id;

    // === Statistik jumlah ujian TA sebagai penguji ===
    $totalKetuaPenguji = JadwalTAModel::where('ketua_penguji_id', $dosenId)->count();
    $totalPenguji1     = JadwalTAModel::where('penguji1_id', $dosenId)->count();
    $totalPenguji2     = JadwalTAModel::where('penguji2_id', $dosenId)->count();

    $totalSemua = $totalKetuaPenguji + $totalPenguji1 + $totalPenguji2;

    // data lain tetap...
    $ruangans = Ruangan::all();
    $seminarTerbaru = Seminar::with(['dosenPenilai1', 'dosenPenilai2'])
        ->where(function ($query) use ($dosenId) {
            $query->where('dosen_penilai_1', $dosenId)
                  ->orWhere('dosen_penilai_2', $dosenId);
        })
        ->where('status', 'Diterima')
        ->latest('tanggal')
        ->first();

    $seminarTerdekat = Seminar::where(function ($query) use ($dosenId) {
            $query->where('dosen_penilai_1', $dosenId)
                  ->orWhere('dosen_penilai_2', $dosenId);
        })
        ->where('status', 'Diterima')
        ->whereDate('tanggal', '>=', Carbon::today())
        ->orderBy('tanggal', 'asc')
        ->first();

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

    $seminarDiterima = Seminar::where(function ($query) use ($dosenId) {
            $query->where('dosen_penilai_1', $dosenId)
                  ->orWhere('dosen_penilai_2', $dosenId);
        })
        ->where('status', 'Diterima')
        ->exists();

    $progressSteps = [
        'Seminar' => $seminarDiterima,
    ];

    $infoTerbaru = InfoTerbaru::latest()->take(5)->get();

    return view('dosen_penilai.dashboard', [
        'seminar' => $seminarTerbaru,
        'seminarTerdekat' => $seminarTerdekat,
        'tahunAkademik' => $tahunAkademik,
        'semester' => $semester,
        'infoTerbaru' => $infoTerbaru,
        'progressSteps' => $progressSteps,
        'ruangans' => $ruangans,
        // kirim statistik ke view
        'totalKetuaPenguji' => $totalKetuaPenguji,
        'totalPenguji1' => $totalPenguji1,
        'totalPenguji2' => $totalPenguji2,
        'totalSemua' => $totalSemua,
    ]);
}
}
