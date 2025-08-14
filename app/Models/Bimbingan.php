<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bimbingan extends Model
{
    use HasFactory;

    protected $fillable = [
        'seminar_id',
        'dosen_id',
        'nama_mahasiswa',
        'nama_dosen',
        'tanggal_bimbingan',
        'pemeriksaan',
        'perbaikan',
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
