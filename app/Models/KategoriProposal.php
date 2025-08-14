<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriProposal extends Model
{
    use HasFactory;

    protected $fillable = ['nama_kategori'];

    public function proposals()
    {
        return $this->hasMany(Proposal::class);
    }
}
