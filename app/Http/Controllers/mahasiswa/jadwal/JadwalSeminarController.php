<?php
namespace App\Http\Controllers\mahasiswa\jadwal;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Seminar;

class JadwalSeminarController extends Controller
{
    public function jadwalseminar()
    {
        $user = Auth::user();

        // Ambil seminar berdasarkan user login
        $seminar = Seminar::where('name', $user->username)->first();

        return view('mahasiswa.jadwal.jadwal-seminar-proposal', compact('seminar'));
    }
}
