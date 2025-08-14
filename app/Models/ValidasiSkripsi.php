<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ValidasiSkripsi extends Model
{
    use HasFactory;
    protected $table = 'validasi_skripsi';
    protected $fillable = [
        'user_id',
        'nama',
        'judul_skripsi',
        'kelas',
        'file_skripsi',
        'dosen_pembimbing_1',
        'dosen_pembimbing_2',
        'status_dospem_1',
        'status_dospem_2',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
