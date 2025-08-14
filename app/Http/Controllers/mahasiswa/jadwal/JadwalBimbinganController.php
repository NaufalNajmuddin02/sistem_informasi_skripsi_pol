<?php
namespace App\Http\Controllers\mahasiswa\jadwal;

use App\Http\Controllers\Controller;
use App\Models\JadwalBimbingan;
use App\Models\Bimbingan;
use Illuminate\Support\Facades\Auth; // Tambahkan ini!
use Illuminate\Http\Request;

class JadwalBimbinganController extends Controller
{
    
    public function index()
    {
        // Ambil jadwal hanya untuk mahasiswa yang dibimbing oleh dosen yang sedang login
        $jadwals = JadwalBimbingan::whereHas('bimbingan', function ($query)  {
            $query->where('nama', Auth::user()->username);
        })->with('bimbingan')->get();

        return view('mahasiswa.jadwal.bimbingan', compact('jadwals'));
    }
}