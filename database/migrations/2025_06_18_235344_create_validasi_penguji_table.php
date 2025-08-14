<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateValidasiPengujiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('validasi_penguji', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('nama');
            $table->string('judul_skripsi');
            $table->string('kelas')->nullable();
            $table->string('file_skripsi')->nullable();
            $table->string('ketua_penguji')->nullable();
            $table->string('penguji1')->nullable();
            $table->string('penguji2')->nullable();
            $table->enum('status_ketua', ['disetujui', 'belum disetujui'])->default('belum disetujui');
            $table->enum('status_penguji1', ['disetujui', 'belum disetujui'])->default('belum disetujui');
            $table->enum('status_penguji2', ['disetujui', 'belum disetujui'])->default('belum disetujui');
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
        Schema::dropIfExists('validasi_penguji');
    }
}
