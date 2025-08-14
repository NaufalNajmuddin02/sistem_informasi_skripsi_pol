<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seminar extends Model
{
    use HasFactory;

    protected $table = 'seminars'; 

    protected $fillable = [
        'user_id',
        'name',
        'class',
        'script_title',
        'submission_date',
        'dosen_penilai_1',
        'dosen_penilai_2',
        'dosen_penilai_1_nama', 
        'dosen_penilai_2_nama',
        'ruangan_id',
        'tanggal',
        'jam',
        'jam_selesai',
        'rekomendasi_dosen_1',
        'rekomendasi_dosen_2',    
        'tahun_akademik',
        'link',
        'kategori_proposal_id',
        'no_hp',
        'nilai', 
        'status',
        'is_rescheduled',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function dosenPenilai1()
    {
        return $this->belongsTo(User::class, 'dosen_penilai_1');
    }

    public function dosenPenilai2()
    {
        return $this->belongsTo(User::class, 'dosen_penilai_2');
    }

    public function bimbingan()
    {
        return $this->hasMany(Bimbingan::class, 'seminar_id');
    }

    public function mahasiswa()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    
    public function kategoriProposal()
    {
        return $this->belongsTo(KategoriProposal::class, 'kategori_proposal_id');
    }

    public function penilaians()
    {
        return $this->hasMany(PenilaianSeminar::class, 'seminar_id');
    }

    public function ruangan()
    {
        return $this->belongsTo(Ruangan::class, 'ruangan_id');
    }


}
