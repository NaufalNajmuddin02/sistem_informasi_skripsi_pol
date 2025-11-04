<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PendaftaranSidangTA extends Model
{
    use HasFactory;

    protected $table = 'table_pendaftaran_t_a'; // Nama tabel sesuai migration
    protected $casts = [
        'tanggal_lahir' => 'date:Y-m-d',
    
    ];
    protected $fillable = [
        'nim',
        'nama',
        'judul_skripsi',
        'email',
        'nomor_wa',
        'jenis_laporan',
        'tanggal_lahir',
        'nik_ktp',
        'alamat',
        'kota',
        'nama_ayah',
        'nama_ibu',
        'asal_slta',
        'ukuran_toga',
        'nama_pembimbing_1',
        'nama_pembimbing_2',
        'tema_skripsi',
        'naskah',
        'status_naskah',           // Tambahkan ini
        'hasil_plagiasi',
        'status_hasil_plagiasi',  // Tambahkan ini
        'bukti_pembayaran',
        'status_bukti_pembayaran', // Tambahkan ini
        'skor_toefl',
        'status_skor_toefl',       // Tambahkan ini
        'ijazah_sma',
        'status_ijazah_sma',       // Tambahkan ini
        'ktp',
        'status_ktp',              // Tambahkan ini
        'kk',
        'status_kk',               // Tambahkan ini
        'surat_rekomendasi',
        'status_surat_rekomendasi',
    ];
    public function user()
    {
        return $this->hasOne(User::class, 'nim', 'nim');
    }
    public function pendaftaranSidang()
    {
        return $this->hasOne(PendaftaranSidangTA::class, 'nim', 'nim');
    }
    public function penilaian()
    {
        return $this->hasOne(PenilaianDosenPembimbing::class, 'mahasiswa_id', 'id');
    }
    public function mahasiswa()
    {
        return $this->belongsTo(User::class, 'mahasiswa_id');
    }
    
}
