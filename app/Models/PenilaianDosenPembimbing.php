<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenilaianDosenPembimbing extends Model
{
    use HasFactory;
    protected $table = 'penilaian_dosen_pembimbing';

    protected $fillable = [
        'mahasiswa_id',
        'dosbing1_id',
        'nilai1_dosbing1',
        'nilai2_dosbing1',
        'nilai3_dosbing1',
        'nilai4_dosbing1',
        'nilai5_dosbing1',
        'nilai6_dosbing1',
        'nilai7_dosbing1',
        'nilai8_dosbing1',
        'nilai9_dosbing1',
        'nilai10_dosbing1',
        'nilai11_dosbing1',
        'nilai12_dosbing1',
        'nilai13_dosbing1',
        'nilai14_dosbing1',
        'nilai15_dosbing1',
        'total_dosbing1',

        'dosbing2_id',
        'nilai1_dosbing2',
        'nilai2_dosbing2',
        'nilai3_dosbing2',
        'nilai4_dosbing2',
        'nilai5_dosbing2',
        'nilai6_dosbing2',
        'nilai7_dosbing2',
        'nilai8_dosbing2',
        'nilai9_dosbing2',
        'nilai10_dosbing2',
        'nilai11_dosbing2',
        'nilai12_dosbing2',
        'nilai13_dosbing2',
        'nilai14_dosbing2',
        'nilai15_dosbing2',
        'total_dosbing2',
        'rata_rata',
    ];

    /** =======================
     *  RELATIONSHIPS
     *  ======================= */

    // Relasi ke mahasiswa (user)
    public function mahasiswa()
    {
        return $this->belongsTo(User::class, 'mahasiswa_id');
    }

    // Relasi ke dosen pembimbing 1
    public function dosbing1()
    {
        return $this->belongsTo(User::class, 'dosbing1_id');
    }

    // Relasi ke dosen pembimbing 2
    public function dosbing2()
    {
        return $this->belongsTo(User::class, 'dosbing2_id');
    }
}
