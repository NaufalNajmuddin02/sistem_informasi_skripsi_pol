<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogBimbingan extends Model
{
    use HasFactory;

    protected $fillable = [
        'bimbingan_id',
        'tanggal',
        'catatan',
    ];

    public function bimbingan()
    {
        return $this->belongsTo(Bimbingan::class);
    }
}
