<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenilaianSidangTAHKI extends Model
{
    use HasFactory;

     protected $table = 'nilai_sidang_hki';

    // Kolom yang bisa diisi (mass assignment)
    protected $fillable = [
        'unsur_yang_dinilai',
        'kriteria',
        'bobot',
    ];
}
