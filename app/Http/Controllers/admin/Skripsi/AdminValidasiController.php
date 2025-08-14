<?php

namespace App\Http\Controllers\admin\Skripsi;

use App\Http\Controllers\Controller;
use App\Models\ValidasiSkripsi;
use Illuminate\Http\Request;

class AdminValidasiController extends Controller
{
    //
    public function index()
    {
        $skripsiList = ValidasiSkripsi::where('status_dospem_1', 'disetujui')
                                      ->where('status_dospem_2', 'disetujui')
                                      ->get();

        return view('admin.validasi_skripsi.index', compact('skripsiList'));
    }
}
