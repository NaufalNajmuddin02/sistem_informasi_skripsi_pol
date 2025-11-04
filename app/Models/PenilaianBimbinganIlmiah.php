<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenilaianBimbinganIlmiah extends Model
{
    use HasFactory;

    protected $table = 'nilai_bimbingan_ilmiah';

    // Kolom yang bisa diisi (mass assignment)
    protected $fillable = [
        'unsur_yang_dinilai',
        'kriteria',
        'bobot',
    ];
}
