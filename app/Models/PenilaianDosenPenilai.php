<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenilaianDosenPenilai extends Model
{
    use HasFactory;

    // Nama tabel
    protected $table = 'penilaian_dosen_penilai';

    // Kolom yang bisa diisi mass assignment
    protected $fillable = [
        'mahasiswa_id',

        'ketua_penguji_id',
        'nilai1_ketua',
        'nilai2_ketua',
        'nilai3_ketua',
        'nilai4_ketua',
        'nilai5_ketua',
        'nilai6_ketua',
        'nilai7_ketua',
        'nilai8_ketua',
        'nilai9_ketua',
        'nilai10_ketua',
        'nilai11_ketua',
        'nilai12_ketua',
        'nilai13_ketua',
        'nilai14_ketua',
        'nilai15_ketua',
        'total_ketua',

        'penguji1_id',
        'nilai1_penguji1',
        'nilai2_penguji1',
        'nilai3_penguji1',
        'nilai4_penguji1',
        'nilai5_penguji1',
        'nilai6_penguji1',
        'nilai7_penguji1',
        'nilai8_penguji1',
        'nilai9_penguji1',
        'nilai10_penguji1',
        'nilai11_penguji1',
        'nilai12_penguji1',
        'nilai13_penguji1',
        'nilai14_penguji1',
        'nilai15_penguji1',
        'total_penguji1',

        'penguji2_id',
        'nilai1_penguji2',
        'nilai2_penguji2',
        'nilai3_penguji2',
        'nilai4_penguji2',
        'nilai5_penguji2',
        'nilai6_penguji2',
        'nilai7_penguji2',
        'nilai8_penguji2',
        'nilai9_penguji2',
        'nilai10_penguji2',
        'nilai11_penguji2',
        'nilai12_penguji2',
        'nilai13_penguji2',
        'nilai14_penguji2',
        'nilai15_penguji2',
        'total_penguji2',

        'status',
    ];

    /* =======================
     *   RELATIONSHIPS
     * ======================= */

    // Relasi ke mahasiswa (user)
    public function mahasiswa()
    {
        return $this->belongsTo(User::class, 'mahasiswa_id');
    }

    // Relasi ke dosen ketua penguji
    public function ketuaPenguji()
    {
        return $this->belongsTo(User::class, 'ketua_penguji_id');
    }

    // Relasi ke dosen penguji 1
    public function penguji1()
    {
        return $this->belongsTo(User::class, 'penguji1_id');
    }

    // Relasi ke dosen penguji 2
    public function penguji2()
    {
        return $this->belongsTo(User::class, 'penguji2_id');
    }
    public function pembimbing()
    {
        return $this->hasOne(PenilaianDosenPembimbing::class, 'mahasiswa_id', 'mahasiswa_id');
    }
    public function seminar()
    {
        return $this->hasOne(Seminar::class, 'user_id', 'mahasiswa_id');
    }

}
