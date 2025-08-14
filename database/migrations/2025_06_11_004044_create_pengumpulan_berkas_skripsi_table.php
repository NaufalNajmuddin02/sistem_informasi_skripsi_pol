<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePengumpulanBerkasSkripsiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengumpulan_berkas_skripsi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Mahasiswa
            $table->string('judul_skripsi');
            $table->string('file_skripsi'); // Nama file atau path penyimpanan
            $table->text('email')->nullable();
            $table->enum('status_skripsi', ['belum disetujui', 'disetujui'])->default('belum disetujui');
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
        Schema::dropIfExists('pengumpulan_berkas_skripsi');
    }
}
