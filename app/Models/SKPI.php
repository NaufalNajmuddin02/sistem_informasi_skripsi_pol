<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SKPI extends Model
{
    use HasFactory;

    protected $table = 'skpi';

    protected $fillable = [
        'user_id',
        'nama_sertifikat1', 'file_sertifikat1', 'nilai_sertifikat1',
        'nama_sertifikat2', 'file_sertifikat2', 'nilai_sertifikat2',
        'nama_sertifikat3', 'file_sertifikat3', 'nilai_sertifikat3',
        'nama_sertifikat4', 'file_sertifikat4', 'nilai_sertifikat4',
        'nama_sertifikat5', 'file_sertifikat5', 'nilai_sertifikat5',
        'nama_sertifikat6', 'file_sertifikat6', 'nilai_sertifikat6',
        'nama_sertifikat7', 'file_sertifikat7', 'nilai_sertifikat7',
        'nama_sertifikat8', 'file_sertifikat8', 'nilai_sertifikat8',
        'nama_sertifikat9', 'file_sertifikat9', 'nilai_sertifikat9',
        'nama_sertifikat10', 'file_sertifikat10', 'nilai_sertifikat10',
        'nama_sertifikat11', 'file_sertifikat11', 'nilai_sertifikat11',
        'nama_sertifikat12', 'file_sertifikat12', 'nilai_sertifikat12',
        'nama_sertifikat13', 'file_sertifikat13', 'nilai_sertifikat13',
        'nama_sertifikat14', 'file_sertifikat14', 'nilai_sertifikat14',
        'nama_sertifikat15', 'file_sertifikat15', 'nilai_sertifikat15',
        'nama_sertifikat16', 'file_sertifikat16', 'nilai_sertifikat16',
        'nama_sertifikat17', 'file_sertifikat17', 'nilai_sertifikat17',
        'nama_sertifikat18', 'file_sertifikat18', 'nilai_sertifikat18',
        'nama_sertifikat19', 'file_sertifikat19', 'nilai_sertifikat19',
        'nama_sertifikat20', 'file_sertifikat20', 'nilai_sertifikat20',
        'narasi',
    ];

    /**
     * Relasi ke tabel users (mahasiswa).
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function getTotalNilaiAttribute()
    {
        $total = 0;
        for ($i = 1; $i <= 20; $i++) {
            $field = "nilai_sertifikat$i";
            $total += $this->$field ?? 0;
        }
        return $total;
    }

}
