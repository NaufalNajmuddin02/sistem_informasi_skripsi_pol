<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NamaDosen extends Model
{
    use HasFactory;

    protected $table = 'nama_dosen';

    protected $fillable = [
        'nama_dosen',
        'prodi',
    ];

    public function bimbingans()
    {
        return $this->hasMany(Bimbingan::class);
    }
}
