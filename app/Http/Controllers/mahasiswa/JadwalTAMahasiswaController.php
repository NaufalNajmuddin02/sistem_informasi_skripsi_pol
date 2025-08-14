<?php

namespace App\Http\Controllers\mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\admin\JadwalTAModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class JadwalTAMahasiswaController extends Controller
{
    //
    public function index()
    {
        $userId = Auth::id();

        $jadwal = JadwalTAModel::where('user_id', $userId)
                ->orWhere('dosbing1_id', $userId)
                ->orWhere('dosbing2_id', $userId)
                ->orWhere('ketua_penguji_id', $userId)
                ->orWhere('penguji1_id', $userId)
                ->orWhere('penguji2_id', $userId)
                ->get()
                ->map(function ($item) {
                    $item->tanggal_formatted = $item->tanggal 
                        ? Carbon::parse($item->tanggal)->locale('id')->translatedFormat('l, d-m-Y') 
                        : '-';
                    $item->jam_formatted = $item->waktu 
                        ? Carbon::parse($item->waktu)->format('H:i') 
                        : '-';
                    $item->selesai_formatted = $item->selesai 
                        ? Carbon::parse($item->selesai)->format('H:i') 
                        : '-';
                    return $item;
                });


        return view('mahasiswa.jadwal.jadwal-ta', compact('jadwal'));
    }
}