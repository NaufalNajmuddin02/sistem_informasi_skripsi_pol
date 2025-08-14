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

class DosenPenilaiDashboardController extends Controller
{
    public function index()
    {
        $dosenId = Auth::user()->id;
        $ruangans = Ruangan::all();
        // Seminar terbaru yang dinilai oleh dosen
        $seminarTerbaru = Seminar::with(['dosenPenilai1', 'dosenPenilai2'])
            ->where(function ($query) use ($dosenId) {
                $query->where('dosen_penilai_1', $dosenId)
                      ->orWhere('dosen_penilai_2', $dosenId);
            })
            ->where('status', 'Diterima')
            ->latest('tanggal')
            ->first();

        // Seminar terdekat yang dinilai oleh dosen
        $seminarTerdekat = Seminar::where(function ($query) use ($dosenId) {
                $query->where('dosen_penilai_1', $dosenId)
                      ->orWhere('dosen_penilai_2', $dosenId);
            })
            ->where('status', 'Diterima')
            ->whereDate('tanggal', '>=', Carbon::today())
            ->orderBy('tanggal', 'asc')
            ->first();

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

        // Status Progress Seminar
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
            'ruangans'
        ]);
    }
}
