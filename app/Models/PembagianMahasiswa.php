<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PembagianMahasiswa extends Model
{
    use HasFactory;

    protected $table = 'pembagian_mahasiswa';

    protected $fillable = [
        'mapel_id',
        'dosen_id',
        'dosen_nama',
        'mahasiswa_id',
        'mahasiswa_nama'
    ];

    public function mahasiswa()
    {
        return $this->belongsTo(User::class, 'mahasiswa_id');
    }

    public function mapel()
    {
        return $this->belongsTo(Mapel::class, 'mapel_id');
    }
    
}
