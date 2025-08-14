<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalBimbingan extends Model
{
    use HasFactory;

    protected $table = 'jadwal_bimbingan'; // Nama tabel di database

    protected $fillable = [
        'bimbingan_id',
        'tanggal',
        'waktu_mulai',
        'waktu_selesai',
        'ruangan',
    ];

    /**
     * Relasi ke model Bimbingan.
     * Jadwal bimbingan terkait dengan satu bimbingan.
     */
    public function bimbingan()
    {
        return $this->belongsTo(Bimbingan::class, 'bimbingan_id');
    }
}
