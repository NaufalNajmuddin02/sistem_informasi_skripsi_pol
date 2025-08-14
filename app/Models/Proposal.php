<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proposal extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'nama_dosen',
        'class',
        'submission_date',
        'script_title',
        'tahun_akademik',
        'link',
        'kategori_proposal_id',
        'abstract',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function kategori()
    {
        return $this->belongsTo(KategoriProposal::class, 'kategori_proposal_id');
    }
}

