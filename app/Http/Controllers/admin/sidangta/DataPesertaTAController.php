<?php

namespace App\Http\Controllers\admin\sidangta;

use App\Http\Controllers\Controller;
use App\Models\kaprodi\DataPesertaTAModel;
use Illuminate\Http\Request;

class DataPesertaTAController extends Controller
{
    //
    public function index()
    {
        $pesertaList = DataPesertaTAModel::with([
            'user', 
            'dosbing1', 
            'dosbing2', 
            'ketuaPenguji', 
            'penguji1', 
            'penguji2'
        ])->get();

        return view('admin.sidangta.datapesertata', compact('pesertaList'));
    }
}
