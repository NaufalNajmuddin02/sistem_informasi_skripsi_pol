<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenilaianDosenPembimbingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penilaian_dosen_pembimbing', function (Blueprint $table) {
             $table->id();
            $table->foreignId('mahasiswa_id')->nullable()->constrained('users')->onDelete('set null');
            $table->foreignId('dosbing1_id')->nullable()->constrained('users')->onDelete('set null');
            $table->float('nilai1_dosbing1')->default(0);
            $table->float('nilai2_dosbing1')->default(0);
            $table->float('nilai3_dosbing1')->default(0);
            $table->float('nilai4_dosbing1')->default(0);
            $table->float('nilai5_dosbing1')->default(0);
            $table->float('nilai6_dosbing1')->default(0);
            $table->float('nilai7_dosbing1')->default(0);
            $table->float('nilai8_dosbing1')->default(0);
            $table->float('nilai9_dosbing1')->default(0);
            $table->float('nilai10_dosbing1')->default(0);
            $table->float('nilai11_dosbing1')->default(0);
            $table->float('nilai12_dosbing1')->default(0);
            $table->float('nilai13_dosbing1')->default(0);
            $table->float('nilai14_dosbing1')->default(0);
            $table->float('nilai15_dosbing1')->default(0);
            $table->float('total_dosbing1')->default(0);

            $table->foreignId('dosbing2_id')->nullable()->constrained('users')->onDelete('set null');
            $table->float('nilai1_dosbing2')->default(0);
            $table->float('nilai2_dosbing2')->default(0);
            $table->float('nilai3_dosbing2')->default(0);
            $table->float('nilai4_dosbing2')->default(0);
            $table->float('nilai5_dosbing2')->default(0);
            $table->float('nilai6_dosbing2')->default(0);
            $table->float('nilai7_dosbing2')->default(0);
            $table->float('nilai8_dosbing2')->default(0);
            $table->float('nilai9_dosbing2')->default(0);
            $table->float('nilai10_dosbing2')->default(0);
            $table->float('nilai11_dosbing2')->default(0);
            $table->float('nilai12_dosbing2')->default(0);
            $table->float('nilai13_dosbing2')->default(0);
            $table->float('nilai14_dosbing2')->default(0);
            $table->float('nilai15_dosbing2')->default(0);
            $table->float('total_dosbing2')->default(0);
            $table->float('rata_rata')->default(0);
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
        Schema::dropIfExists('penilaian_dosen_pembimbing');
    }
}
