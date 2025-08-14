<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJadwalTaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jadwal_ta', function (Blueprint $table) {
            $table->id();

            // Peserta (mahasiswa)
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');

            $table->string('nim')->nullable();
            $table->string('judul')->nullable();

            // Dosen pembimbing dan penguji
            $table->foreignId('dosbing1_id')->nullable()->constrained('users')->onDelete('set null');
            $table->foreignId('dosbing2_id')->nullable()->constrained('users')->onDelete('set null');
            $table->foreignId('ketua_penguji_id')->nullable()->constrained('users')->onDelete('set null');
            $table->foreignId('penguji1_id')->nullable()->constrained('users')->onDelete('set null');
            $table->foreignId('penguji2_id')->nullable()->constrained('users')->onDelete('set null');

            // Informasi jadwal sidang
            $table->date('tanggal')->nullable();        
            $table->time('waktu')->nullable();          
            $table->string('ruangan')->nullable();       

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
        Schema::dropIfExists('jadwal_ta');
    }
}
