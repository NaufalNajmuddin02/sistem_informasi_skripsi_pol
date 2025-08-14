<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ValidasiSkripsiPenguji extends Model
{
    use HasFactory;
    protected $table = 'validasi_penguji';

    protected $fillable = [
        'user_id',
        'nama',
        'judul_skripsi',
        'kelas',
        'file_skripsi',
        'ketua_penguji',
        'penguji1',
        'penguji2',
        'status_ketua',
        'status_penguji1',
        'status_penguji2',
    ];

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }
}
