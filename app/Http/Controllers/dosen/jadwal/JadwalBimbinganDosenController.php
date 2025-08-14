<?php

namespace App\Http\Controllers\dosen\jadwal;

use App\Http\Controllers\Controller;
use App\Models\JadwalBimbingan;
use App\Models\Bimbingan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JadwalBimbinganDosenController extends Controller
{
    public function index()
    {
        $dosen = Auth::user();
        $jadwals = JadwalBimbingan::whereHas('bimbingan', function ($query) use ($dosen) {
            $query->where('nama_dosen', $dosen->username);
        })->with('bimbingan')->get();

        $bimbingans = Bimbingan::where('status', 'Diterima')
            ->where('nama_dosen', $dosen->username)
            ->get();

        return view('dosen.jadwal.jadwal-bimbingan', compact('jadwals', 'bimbingans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'bimbingan_id' => 'required|exists:bimbingans,id',
            'tanggal' => 'required|date',
            'waktu_mulai' => 'required',
            'waktu_selesai' => 'required|after:waktu_mulai',
            'ruangan' => 'required|string|max:255',
        ]);

        $bimbingan = Bimbingan::find($request->bimbingan_id);
        if ($bimbingan->status !== 'Diterima') {
            return redirect()->route('jadwal-bimbingan.index')->with('error', 'Bimbingan belum disetujui.');
        }

        JadwalBimbingan::create($request->all());

        return redirect()->route('jadwal-bimbingan.index')->with('success', 'Jadwal bimbingan berhasil ditambahkan.');
    }
}
