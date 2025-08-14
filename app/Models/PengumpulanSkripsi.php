<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengumpulanSkripsi extends Model
{
    use HasFactory;
    protected $table = 'pengumpulan_berkas_skripsi';

    protected $fillable = [
        'user_id',
        'judul_skripsi',
        'file_skripsi',
        'email',
        'no_wa',
        'status_skripsi',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
