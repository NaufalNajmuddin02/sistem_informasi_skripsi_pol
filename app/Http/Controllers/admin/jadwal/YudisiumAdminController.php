<?php

namespace App\Http\Controllers\admin\jadwal;

use App\Http\Controllers\Controller;
use App\Models\YudisiumJadwal;
use Illuminate\Http\Request;

class YudisiumAdminController extends Controller
{
    //
    public function index(){
        $jadwal = YudisiumJadwal::latest()->get();

        return view('admin.jadwal.yudisium.index', compact('jadwal'));
    }
}
