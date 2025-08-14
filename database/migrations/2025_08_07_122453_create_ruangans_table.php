<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRuangansTable extends Migration
{
    public function up()
    {
        Schema::create('ruangans', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('lokasi')->nullable();
            $table->integer('kapasitas')->nullable();
            $table->timestamps();
        });

        Schema::table('seminars', function (Blueprint $table) {
            $table->unsignedBigInteger('ruangan_id')->nullable()->after('dosen_penilai_2_nama');
            $table->foreign('ruangan_id')->references('id')->on('ruangans')->onDelete('set null');
            $table->dropColumn('ruangan'); // hapus kolom string ruangan lama
        });
    }

    public function down()
    {
        Schema::table('seminars', function (Blueprint $table) {
            $table->dropForeign(['ruangan_id']);
            $table->dropColumn('ruangan_id');
            $table->string('ruangan')->nullable();
        });

        Schema::dropIfExists('ruangans');
    }
}
