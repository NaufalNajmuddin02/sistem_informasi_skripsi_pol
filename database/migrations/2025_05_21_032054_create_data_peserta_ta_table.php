<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDataPesertaTaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_peserta_ta', function (Blueprint $table) {
            $table->id();

            // Peserta (mahasiswa)
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');

            $table->string('nim')->nullable();
            $table->string('judul')->nullable();

            // Semua dosen menggunakan relasi ke tabel users
            $table->foreignId('dosbing1_id')->nullable()->constrained('users')->onDelete('set null');
            $table->foreignId('dosbing2_id')->nullable()->constrained('users')->onDelete('set null');
            $table->foreignId('ketua_penguji_id')->nullable()->constrained('users')->onDelete('set null');
            $table->foreignId('penguji1_id')->nullable()->constrained('users')->onDelete('set null');
            $table->foreignId('penguji2_id')->nullable()->constrained('users')->onDelete('set null');

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
        Schema::dropIfExists('data_peserta_ta');
    }
}
