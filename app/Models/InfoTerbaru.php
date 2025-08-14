<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InfoTerbaru extends Model
{
    use HasFactory;

    protected $table = 'info_terbaru';

    protected $fillable = ['judul', 'konten'];
}
