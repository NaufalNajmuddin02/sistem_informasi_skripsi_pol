<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PenilaianSeminar extends Model
{
    protected $table = 'penilaian_seminar';

    protected $fillable = [
        'seminar_id',
        'dosen_id',
        'peran_penilai',
        'judul_penelitian',
        'pendahuluan',
        'metodologi',
        'solusi',
        'kesiapan_produk',
        'nilai_total',
    ];

    public function seminar()
    {
        return $this->belongsTo(Seminar::class);
    }

    public function dosen()
    {
        return $this->belongsTo(User::class, 'dosen_id');
    }
}
