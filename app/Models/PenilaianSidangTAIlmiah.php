<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenilaianSidangTAIlmiah extends Model
{
    

    use HasFactory;
     protected $table = 'nilai_sidang_ilmiah';

    // Kolom yang bisa diisi (mass assignment)
    protected $fillable = [
        'unsur_yang_dinilai',
        'kriteria',
        'bobot',
    ];
}
