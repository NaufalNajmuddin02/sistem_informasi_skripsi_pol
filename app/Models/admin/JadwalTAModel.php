<?php

namespace App\Models\admin;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class JadwalTAModel extends Model
{
    use HasFactory;
    protected $table = 'jadwal_ta';
    protected $fillable = [
        'user_id',
        'nim',
        'judul',
        'dosbing1_id',
        'dosbing2_id',
        'ketua_penguji_id',
        'penguji1_id',
        'penguji2_id',
        'waktu',
        'selesai',
        'tanggal',
        'ruangan',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function dosbing1()
    {
        return $this->belongsTo(User::class, 'dosbing1_id');
    }

    public function dosbing2()
    {
        return $this->belongsTo(User::class, 'dosbing2_id');
    }

    public function ketuaPenguji()
    {
        return $this->belongsTo(User::class, 'ketua_penguji_id');
    }

    public function penguji1()
    {
        return $this->belongsTo(User::class, 'penguji1_id');
    }

    public function penguji2()
    {
        return $this->belongsTo(User::class, 'penguji2_id');
    }
    public function penilaian()
    {
        return $this->hasOne(\App\Models\PenilaianDosenPenilai::class, 'mahasiswa_id', 'user_id');
    }
}
