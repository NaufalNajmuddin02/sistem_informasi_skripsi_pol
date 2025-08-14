<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BatasWaktuPengajuan extends Model
{
    protected $table = 'batas_waktu_pengajuan';

    protected $fillable = ['tahun_akademik', 'tanggal_batas'];

}
