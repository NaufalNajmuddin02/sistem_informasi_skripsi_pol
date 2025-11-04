<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenilaianDosenPenilaiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penilaian_dosen_penilai', function (Blueprint $table) {
       $table->id();
            $table->foreignId('mahasiswa_id')->nullable()->constrained('users')->onDelete('set null');
            $table->foreignId('ketua_penguji_id')->nullable()->constrained('users')->onDelete('set null');
            $table->float('nilai1_ketua')->default(0);
            $table->float('nilai2_ketua')->default(0);
            $table->float('nilai3_ketua')->default(0);
            $table->float('nilai4_ketua')->default(0);
            $table->float('nilai5_ketua')->default(0);
            $table->float('nilai6_ketua')->default(0);
            $table->float('nilai7_ketua')->default(0);
            $table->float('nilai8_ketua')->default(0);
            $table->float('nilai9_ketua')->default(0);
            $table->float('nilai10_ketua')->default(0);
            $table->float('nilai11_ketua')->default(0);
            $table->float('nilai12_ketua')->default(0);
            $table->float('nilai13_ketua')->default(0);
            $table->float('nilai14_ketua')->default(0);
            $table->float('nilai15_ketua')->default(0);
            $table->float('total_ketua')->default(0);
            $table->enum('status', ['belum lulus', 'lulus'])->default('belum lulus');

            $table->foreignId('penguji1_id')->nullable()->constrained('users')->onDelete('set null');
            $table->float('nilai1_penguji1')->default(0);
            $table->float('nilai2_penguji1')->default(0);
            $table->float('nilai3_penguji1')->default(0);
            $table->float('nilai4_penguji1')->default(0);
            $table->float('nilai5_penguji1')->default(0);
            $table->float('nilai6_penguji1')->default(0);
            $table->float('nilai7_penguji1')->default(0);
            $table->float('nilai8_penguji1')->default(0);
            $table->float('nilai9_penguji1')->default(0);
            $table->float('nilai10_penguji1')->default(0);
            $table->float('nilai11_penguji1')->default(0);
            $table->float('nilai12_penguji1')->default(0);
            $table->float('nilai13_penguji1')->default(0);
            $table->float('nilai14_penguji1')->default(0);
            $table->float('nilai15_penguji1')->default(0);
            $table->float('total_penguji1')->default(0);

            $table->foreignId('penguji2_id')->nullable()->constrained('users')->onDelete('set null');
            $table->float('nilai1_penguji2')->default(0);
            $table->float('nilai2_penguji2')->default(0);
            $table->float('nilai3_penguji2')->default(0);
            $table->float('nilai4_penguji2')->default(0);
            $table->float('nilai5_penguji2')->default(0);
            $table->float('nilai6_penguji2')->default(0);
            $table->float('nilai7_penguji2')->default(0);
            $table->float('nilai8_penguji2')->default(0);
            $table->float('nilai9_penguji2')->default(0);
            $table->float('nilai10_penguji2')->default(0);
            $table->float('nilai11_penguji2')->default(0);
            $table->float('nilai12_penguji2')->default(0);
            $table->float('nilai13_penguji2')->default(0);
            $table->float('nilai14_penguji2')->default(0);
            $table->float('nilai15_penguji2')->default(0);
            $table->float('total_penguji2')->default(0);
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
        Schema::dropIfExists('penilaian_dosen_penilai');
    }
}
