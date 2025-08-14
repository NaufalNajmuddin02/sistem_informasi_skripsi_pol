<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTablePendaftaranTATable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('table_pendaftaran_t_a', function (Blueprint $table) {
            $table->id();
            $table->string('nim')->unique();
            $table->string('nama')->nullable();
            $table->string('judul')->nullable();
            $table->string('email')->nullable();
            $table->string('nomor_wa')->nullable();
            $table->string('jenis_laporan')->nullable();
            $table->string('nik_ktp')->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->string('alamat')->nullable();
            $table->string('kota')->nullable();
            $table->string('nama_ayah')->nullable();
            $table->string('nama_ibu')->nullable();
            $table->string('asal_slta')->nullable();
            $table->string('ukuran_toga')->nullable();
            $table->string('nama_pembimbing_1')->nullable();
            $table->string('nama_pembimbing_2')->nullable();
            $table->string('tema_skripsi')->nullable();

            $table->string('naskah')->nullable();
            $table->enum('status_naskah', ['belum disetujui', 'disetujui'])->default('belum disetujui');

            $table->string('hasil_plagiasi')->nullable();
            $table->enum('status_hasil_plagiasi', ['belum disetujui', 'disetujui'])->default('belum disetujui');

            $table->string('bukti_pembayaran')->nullable();
            $table->enum('status_bukti_pembayaran', ['belum disetujui', 'disetujui'])->default('belum disetujui');

            $table->string('skor_toefl')->nullable();
            $table->enum('status_skor_toefl', ['belum disetujui', 'disetujui'])->default('belum disetujui');

            $table->string('ijazah_sma')->nullable();
            $table->enum('status_ijazah_sma', ['belum disetujui', 'disetujui'])->default('belum disetujui');

            $table->string('ktp')->nullable();
            $table->enum('status_ktp', ['belum disetujui', 'disetujui'])->default('belum disetujui');

            $table->string('kk')->nullable();
            $table->enum('status_kk', ['belum disetujui', 'disetujui'])->default('belum disetujui');

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
        Schema::dropIfExists('table_pendaftaran_t_a');
    }
}
