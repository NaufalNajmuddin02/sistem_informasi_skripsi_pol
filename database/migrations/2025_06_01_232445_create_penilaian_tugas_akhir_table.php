<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenilaianTugasAkhirTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penilaian_tugas_akhir', function (Blueprint $table) {
        $table->id();
        $table->string('nim')->unique();
        $table->string('nama_mahasiswa');
        $table->string('judul');

        // Ketua Penguji (penguji 1)
        $table->foreignId('ketua_penguji_id')->nullable()->constrained('users')->onDelete('set null');
        $table->float('sikap_kp')->default(0);
        $table->float('mampu_menjelaskan_topik_kp')->default(0);
        $table->float('mampu_menjelaskan_hasil_kp')->default(0);
        $table->float('simulasi_produk_kp')->default(0);
        $table->float('pengujian_produk_kp')->default(0);
        $table->float('produk_bermanfaat_kp')->default(0);
        $table->float('kejelasan_proses_kp')->default(0);
        $table->float('susunan_laporan_kp')->default(0);
        $table->float('isi_laporan_kp')->default(0);
        $table->float('kualitas_penulisan_kp')->default(0);
        $table->float('total_nilai_kp')->default(0);
        $table->enum('status_sidang_kp', ['lolos', 'tidak_lolos'])->default('tidak_lolos');



        // Penguji 1
        $table->foreignId('penguji1_id')->nullable()->constrained('users')->onDelete('set null');
        $table->float('sikap_penguji1')->default(0);
        $table->float('mampu_menjelaskan_topik_penguji1')->default(0);
        $table->float('mampu_menjelaskan_hasil_penguji1')->nullable();
        $table->float('simulasi_produk_penguji1')->default(0);
        $table->float('pengujian_produk_penguji1')->default(0);
        $table->float('produk_bermanfaat_penguji1')->default(0);
        $table->float('kejelasan_proses_penguji1')->default(0);
        $table->float('susunan_laporan_penguji1')->default(0);;
        $table->float('isi_laporan_penguji1')->default(0);
        $table->float('kualitas_penulisan_penguji1')->default(0);
        $table->float('total_nilai_penguji1')->default(0);

        // Penguji 2
        $table->foreignId('penguji2_id')->nullable()->constrained('users')->onDelete('set null');
        $table->float('sikap_penguji2')->default(0);
        $table->float('mampu_menjelaskan_topik_penguji2')->default(0);
        $table->float('mampu_menjelaskan_hasil_penguji2')->default(0);
        $table->float('simulasi_produk_penguji2')->default(0);
        $table->float('pengujian_produk_penguji2')->default(0);
        $table->float('produk_bermanfaat_penguji2')->default(0);
        $table->float('kejelasan_proses_penguji2')->default(0);
        $table->float('susunan_laporan_penguji2')->default(0);
        $table->float('isi_laporan_penguji2')->default(0);
        $table->float('kualitas_penulisan_penguji2')->default(0);
        $table->float('total_nilai_penguji2')->default(0);

        //Field Total Nilai Penguji
        $table->float('total_score_penguji')->default(0);

        // Pembimbing 1
        $table->foreignId('dosbing1_id')->nullable()->constrained('users')->onDelete('set null');
        $table->float('pelaksanaan_bimbingan_p1')->default(0);
        $table->float('daya_kritis_p1')->default(0);
        $table->float('sikap_perilaku_p1')->default(0);
        $table->float('tujuan_utama_p1')->default(0);
        $table->float('topik_penelitian_p1')->default(0);
        $table->float('latar_belakang_p1')->default(0);
        $table->float('teori_yang_dijelaskan_p1')->default(0);
        $table->float('desain_dan_perancangan_p1')->default(0);
        $table->float('hasil_p1')->default(0);
        $table->float('pengujian_p1')->default(0);
        $table->float('hasil_penelitian_p1')->default(0);
        $table->float('kesimpulan_p1')->default(0);
        $table->float('saran_penelitian_p1')->default(0);
        $table->float('total_score_pembimbing_p1')->default(0);



        // Pembimbing 2        
        $table->foreignId('dosbing2_id')->nullable()->constrained('users')->onDelete('set null');
        $table->float('pelaksanaan_bimbingan_p2')->default(0);
        $table->float('daya_kritis_p2')->default(0);
        $table->float('sikap_perilaku_p2')->default(0);
        $table->float('tujuan_utama_p2')->default(0);
        $table->float('topik_penelitian_p2')->default(0);
        $table->float('latar_belakang_p2')->default(0);
        $table->float('teori_yang_dijelaskan_p2')->default(0);
        $table->float('desain_dan_perancangan_p2')->default(0);
        $table->float('hasil_p2')->default(0);
        $table->float('pengujian_p2')->default(0);
        $table->float('hasil_penelitian_p2')->default(0);
        $table->float('kesimpulan_p2')->default(0);
        $table->float('saran_penelitian_p2')->default(0);
        $table->float('total_score_pembimbing_p2')->default(0);
        $table->float('total_score_pembimbing')->default(0);

        $table->float('total_score')->default(0);




        $table->timestamps();
    });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('penilaian_tugas_akhir');
    }
}
