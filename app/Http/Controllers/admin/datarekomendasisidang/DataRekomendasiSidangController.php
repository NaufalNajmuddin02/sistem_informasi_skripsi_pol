<?php

namespace App\Http\Controllers\admin\datarekomendasisidang;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DataRekomendasiSidangController extends Controller
{
    public function index(Request $request)
    {
        // Ambil semua mahasiswa dengan join ke tabel seminars
        $mahasiswa = User::where('users.role', 'mahasiswa')
            ->leftJoin('seminars', 'users.id', '=', 'seminars.user_id')
            ->select(
                'users.id',
                'users.username',
                'users.nim',
                'seminars.script_title as judul', // ganti ke kolom yang benar
                'seminars.rekomendasi_dosen_1',
                'seminars.rekomendasi_dosen_2',
                'seminars.tahun_akademik'
            )
            ->get()
            ->map(function ($m) {
                $m->status_rekomendasi =
                    ($m->rekomendasi_dosen_1 === 'direkomendasikan'
                    && $m->rekomendasi_dosen_2 === 'direkomendasikan')
                        ? 'Sudah Direkomendasi'
                        : 'Belum Direkomendasi';
                return $m;
            });

        return view('admin.sidangta.datarekomendasisidang', compact('mahasiswa'));
    }
}
