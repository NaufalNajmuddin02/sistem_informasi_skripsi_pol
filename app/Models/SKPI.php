<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SKPI extends Model
{
    use HasFactory;
    protected $table = 'skpi';

    // kolom yang boleh di‐isi mass-assignment
    protected $fillable = [
        'user_id',
        'sertifikat1', 'nilai_sertifikat1',
        'sertifikat2', 'nilai_sertifikat2',
        'sertifikat3', 'nilai_sertifikat3',
        'sertifikat4', 'nilai_sertifikat4',
        'sertifikat5', 'nilai_sertifikat5',
        'sertifikat6', 'nilai_sertifikat6',
        'sertifikat7', 'nilai_sertifikat7',
        'sertifikat8', 'nilai_sertifikat8',
        'sertifikat9', 'nilai_sertifikat9',
        'sertifikat10','nilai_sertifikat10',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
