<?php

namespace App\Http\Controllers\dosen\jadwal;

use App\Http\Controllers\Controller;
use App\Models\JadwalBimbingan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ListJadwalController extends Controller
{
    public function index()
    {
        $dosen = Auth::user();

        // Ambil jadwal hanya untuk mahasiswa yang dibimbing oleh dosen yang sedang login
        $jadwals = JadwalBimbingan::whereHas('bimbingan', function ($query) use ($dosen) {
            $query->where('nama_dosen', $dosen->username);
        })->with('bimbingan')->get();

        return view('dosen.jadwal.list-jadwal', compact('jadwals'));
    }
}
