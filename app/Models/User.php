<?php

namespace App\Models;

use App\Models\kaprodi\DataPesertaTAModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory;

    protected $table = 'users'; // Nama tabel

    protected $fillable = [
        'username',
        'nim',
        'semester',
        'kelas',
        'password',
        'profile_picture',
        'prodi',
        'email',
        'no_hp',
        'role',
        'dosen_prodi',
        'kapasitas_bimbingan'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function notifications()
    {
        return $this->hasMany(\App\Models\Notification::class, 'user_id', 'id');
    }
    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    public function isDosen()
    {
        return $this->role === 'dosen';
    }

    public function isMahasiswa()
    {
        return $this->role === 'mahasiswa';
    }

    public function isKaprodi()
    {
        return $this->role === 'kaprodi';
    }

    public function isDosen_penilai()
    {
        return $this->role === 'dosen_penilai';
    }
    // Di model User.php
    public function dosbing1()
    {
        return $this->belongsTo(User::class, 'dosbing1_id');
    }

    public function dosbing2()
    {
        return $this->belongsTo(User::class, 'dosbing2_id');
    }
   public function pembimbing1()
    {
        return $this->belongsTo(User::class, 'pembimbing_1_id');
    }

    public function pembimbing2()
    {
        return $this->belongsTo(User::class, 'pembimbing_2_id');
    }
    public function pendaftaranTA()
    {
        return $this->hasOne(PendaftaranSidangTA::class, 'nim', 'username'); // asumsi NIM = username
    }
    public function pesertaTA()
    {
        return $this->hasOne(DataPesertaTAModel::class, 'user_id');
    }
    public function seminarSebagaiPenilai1()
    {
        return $this->hasMany(Seminar::class, 'dosen_penilai_1');
    }

    public function seminarSebagaiPenilai2()
    {
        return $this->hasMany(Seminar::class, 'dosen_penilai_2');
    }


}
