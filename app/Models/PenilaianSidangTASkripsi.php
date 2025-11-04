<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenilaianSidangTASkripsi extends Model
{
    use HasFactory;
     protected $table = 'nilai_sidang_skripsi';

    // Kolom yang bisa diisi (mass assignment)
    protected $fillable = [
        'unsur_yang_dinilai',
        'kriteria',
        'bobot',
    ];
}
