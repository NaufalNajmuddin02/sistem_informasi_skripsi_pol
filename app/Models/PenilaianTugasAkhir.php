<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenilaianTugasAkhir extends Model
{
    use HasFactory;

    protected $table = 'penilaian_tugas_akhir';

    protected $fillable = [
        'nim',
        'nama_mahasiswa',
        'judul',

        // Ketua penguji
        'ketua_penguji_id',
        'sikap_kp',
        'mampu_menjelaskan_topik_kp',
        'mampu_menjelaskan_hasil_kp',
        'simulasi_produk_kp',
        'pengujian_produk_kp',
        'produk_bermanfaat_kp',
        'kejelasan_proses_kp',
        'susunan_laporan_kp',
        'isi_laporan_kp',
        'kualitas_penulisan_kp',
        'total_nilai_kp',
        'status_sidang_kp',

        // Penguji 1
        'penguji1_id',
        'sikap_penguji1',
        'mampu_menjelaskan_topik_penguji1',
        'mampu_menjelaskan_hasil_penguji1',
        'simulasi_produk_penguji1',
        'pengujian_produk_penguji1',
        'produk_bermanfaat_penguji1',
        'kejelasan_proses_penguji1',
        'susunan_laporan_penguji1',
        'isi_laporan_penguji1',
        'kualitas_penulisan_penguji1',
        'total_nilai_penguji1',

        // Penguji 2
        'penguji2_id',
        'sikap_penguji2',
        'mampu_menjelaskan_topik_penguji2',
        'mampu_menjelaskan_hasil_penguji2',
        'simulasi_produk_penguji2',
        'pengujian_produk_penguji2',
        'produk_bermanfaat_penguji2',
        'kejelasan_proses_penguji2',
        'susunan_laporan_penguji2',
        'isi_laporan_penguji2',
        'kualitas_penulisan_penguji2',
        'total_nilai_penguji2',

        'total_score_penguji',

        // Pembimbing 1
        'dosbing1_id',
        'pelaksanaan_bimbingan_p1',
        'daya_kritis_p1',
        'sikap_perilaku_p1',
        'tujuan_utama_p1',
        'topik_penelitian_p1',
        'latar_belakang_p1',
        'teori_yang_dijelaskan_p1',
        'desain_dan_perancangan_p1',
        'hasil_p1',
        'pengujian_p1',
        'hasil_penelitian_p1',
        'kesimpulan_p1',
        'saran_penelitian_p1',
        'total_score_pembimbing_p1',

        // Pembimbing 2
        'dosbing2_id',
        'pelaksanaan_bimbingan_p2',
        'daya_kritis_p2',
        'sikap_perilaku_p2',
        'tujuan_utama_p2',
        'topik_penelitian_p2',
        'latar_belakang_p2',
        'teori_yang_dijelaskan_p2',
        'desain_dan_perancangan_p2',
        'hasil_p2',
        'pengujian_p2',
        'hasil_penelitian_p2',
        'kesimpulan_p2',
        'saran_penelitian_p2',
        'total_score_pembimbing_p2',

        'total_score_pembimbing',
        'total_score',
    ];

    // Relasi ke User
    public function ketuaPenguji()
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

    public function dosbing1()
    {
        return $this->belongsTo(User::class, 'dosbing1_id');
    }

    public function dosbing2()
    {
        return $this->belongsTo(User::class, 'dosbing2_id');
    }
}
