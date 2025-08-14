<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class YudisiumJadwal extends Model
{
    use HasFactory;
    protected $table = 'yudisium_jadwal';
    protected $fillable = [
        'tanggal',
        'waktu_mulai',
        'waktu_selesai',
        'ruangan',
        'keterangan',
        'created_by',
    ];
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
