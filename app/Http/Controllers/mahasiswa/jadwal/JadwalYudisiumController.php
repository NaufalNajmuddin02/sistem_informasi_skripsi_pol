<?php
namespace App\Http\Controllers\mahasiswa\jadwal;
use App\Http\Controllers\Controller;
use App\Models\YudisiumJadwal;

class JadwalYudisiumController extends Controller
{
    public function jadwalyudisium()
    {
        // Anda dapat menambahkan data ke view jika diperlukan
        $jadwal = YudisiumJadwal::latest()->get();

        return view('mahasiswa.jadwal.jadwal-yudisium', compact('jadwal'));
    }
}