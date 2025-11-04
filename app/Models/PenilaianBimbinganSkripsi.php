<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenilaianBimbinganSkripsi extends Model
{
    use HasFactory;
    protected $table = 'nilai_bimbingan_skripsi';

    // Kolom yang bisa diisi (mass assignment)
    protected $fillable = [
        'unsur_yang_dinilai',
        'kriteria',
        'bobot',
    ];
}
