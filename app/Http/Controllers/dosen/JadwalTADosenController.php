<?php

namespace App\Http\Controllers\dosen;

use App\Http\Controllers\Controller;
use App\Models\admin\JadwalTAModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JadwalTADosenController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        $jadwal = JadwalTAModel::where('user_id', $userId)
            ->orWhere('dosbing1_id', $userId)
            ->orWhere('dosbing2_id', $userId)
            ->orWhere('ketua_penguji_id', $userId)
            ->orWhere('penguji1_id', $userId)
            ->orWhere('penguji2_id', $userId)
            ->get();

        return view('dosen.jadwal.jadwal-ta', compact('jadwal'));
    }
}
