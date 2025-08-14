<?php

namespace App\Models\kaprodi;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataPesertaTAModel extends Model
{
    use HasFactory;
    protected $table = 'data_peserta_ta';
    protected $fillable = [
        'user_id',
        'nim',
        'judul',
        'dosbing1_id',
        'dosbing2_id',
        'ketua_penguji_id',
        'penguji1_id',
        'penguji2_id',
    ];
    public function dosbing1()
    {
        return $this->belongsTo(User::class, 'dosbing1_id');
    }
    public function dosbing2()
    {
        return $this->belongsTo(User::class, 'dosbing2_id');
    }
    public function ketua_penguji()
    {
        return $this->belongsTo(User::class, 'ketua_penguji_id');
    }
    public function penguji1()
    {
        return $this->belongsTo(User::class, 'penguji1_id');
    }
    public function penguji2()
    {
        return $this->belongsTo(User::class, 'penguji2_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function ketuaPenguji()
    {
        return $this->belongsTo(User::class, 'ketua_penguji_id');
    }
}
