<?php

namespace App\Http\Controllers\dosen_penilai\jadwal;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Seminar;
use Carbon\Carbon;

class JadwalPenilaiController extends Controller
{
    public function index()
    {
        $dosenId = Auth::user()->id;
        $now = Carbon::now();
        // Ambil seminar untuk dosen, dan hanya yang belum selesai (tanggal + jam_selesai >= now)
        $seminars = Seminar::where(function ($query) use ($dosenId) {
                $query->where('dosen_penilai_1', $dosenId)
                      ->orWhere('dosen_penilai_2', $dosenId);
            })
            ->where(function ($query) use ($now) {
                // Seminar belum selesai
                $query->where(function ($q) use ($now) {
                    $q->whereDate('tanggal', '>', $now->format('Y-m-d'));
                })
                ->orWhere(function ($q) use ($now) {
                    $q->whereDate('tanggal', $now->format('Y-m-d'))
                      ->whereTime('jam_selesai', '>=', $now->format('H:i:s'));
                });
            })
            ->orderBy('tanggal', 'asc')
            ->orderBy('jam', 'asc')
            ->get();
        return view('dosen_penilai.jadwal.index', compact('seminars'));
    }
}
