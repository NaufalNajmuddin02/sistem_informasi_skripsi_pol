<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSkpiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('skpi', function (Blueprint $table) {
           $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('nama_sertifikat1')->nullable();
            $table->string('file_sertifikat1')->nullable();
            $table->integer('nilai_sertifikat1')->nullable();

            $table->string('nama_sertifikat2')->nullable();
            $table->string('file_sertifikat2')->nullable();
            $table->integer('nilai_sertifikat2')->nullable();

            $table->string('nama_sertifikat3')->nullable();
            $table->string('file_sertifikat3')->nullable();
            $table->integer('nilai_sertifikat3')->nullable();

            $table->string('nama_sertifikat4')->nullable();
            $table->string('file_sertifikat4')->nullable();
            $table->integer('nilai_sertifikat4')->nullable();

            $table->string('nama_sertifikat5')->nullable();
            $table->string('file_sertifikat5')->nullable();
            $table->integer('nilai_sertifikat5')->nullable();

            $table->string('nama_sertifikat6')->nullable();
            $table->string('file_sertifikat6')->nullable();
            $table->integer('nilai_sertifikat6')->nullable();

            $table->string('nama_sertifikat7')->nullable();
            $table->string('file_sertifikat7')->nullable();
            $table->integer('nilai_sertifikat7')->nullable();

            $table->string('nama_sertifikat8')->nullable();
            $table->string('file_sertifikat8')->nullable();
            $table->integer('nilai_sertifikat8')->nullable();

            $table->string('nama_sertifikat9')->nullable();
            $table->string('file_sertifikat9')->nullable();
            $table->integer('nilai_sertifikat9')->nullable();

            $table->string('nama_sertifikat10')->nullable();
            $table->string('file_sertifikat10')->nullable();
            $table->integer('nilai_sertifikat10')->nullable();

            $table->string('nama_sertifikat11')->nullable();
            $table->string('file_sertifikat11')->nullable();
            $table->integer('nilai_sertifikat11')->nullable();

            $table->string('nama_sertifikat12')->nullable();
            $table->string('file_sertifikat12')->nullable();
            $table->integer('nilai_sertifikat12')->nullable();

            $table->string('nama_sertifikat13')->nullable();
            $table->string('file_sertifikat13')->nullable();
            $table->integer('nilai_sertifikat13')->nullable();

            $table->string('nama_sertifikat14')->nullable();
            $table->string('file_sertifikat14')->nullable();
            $table->integer('nilai_sertifikat14')->nullable();

            $table->string('nama_sertifikat15')->nullable();
            $table->string('file_sertifikat15')->nullable();
            $table->integer('nilai_sertifikat15')->nullable();

            $table->string('nama_sertifikat16')->nullable();
            $table->string('file_sertifikat16')->nullable();
            $table->integer('nilai_sertifikat16')->nullable();

            $table->string('nama_sertifikat17')->nullable();
            $table->string('file_sertifikat17')->nullable();
            $table->integer('nilai_sertifikat17')->nullable();

            $table->string('nama_sertifikat18')->nullable();
            $table->string('file_sertifikat18')->nullable();
            $table->integer('nilai_sertifikat18')->nullable();

            $table->string('nama_sertifikat19')->nullable();
            $table->string('file_sertifikat19')->nullable();
            $table->integer('nilai_sertifikat19')->nullable();

            $table->string('nama_sertifikat20')->nullable();
            $table->string('file_sertifikat20')->nullable();
            $table->integer('nilai_sertifikat20')->nullable();

            $table->string('narasi')->nullable();
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
        Schema::dropIfExists('skpi');
    }
}
