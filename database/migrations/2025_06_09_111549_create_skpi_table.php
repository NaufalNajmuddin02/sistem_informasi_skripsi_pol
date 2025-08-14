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
            $table->string('sertifikat1')->nullable();
            $table->integer('nilai_sertifikat1')->default(0);
            $table->string('sertifikat2')->nullable();
            $table->integer('nilai_sertifikat2')->default(0);
            $table->string('sertifikat3')->nullable();
            $table->integer('nilai_sertifikat3')->default(0);
            $table->string('sertifikat4')->nullable();
            $table->integer('nilai_sertifikat4')->default(0);
            $table->string('sertifikat5')->nullable();
            $table->integer('nilai_sertifikat5')->default(0);
            $table->string('sertifikat6')->nullable();
            $table->integer('nilai_sertifikat6')->default(0);
            $table->string('sertifikat7')->nullable();
            $table->integer('nilai_sertifikat7')->default(0);
            $table->string('sertifikat8')->nullable();
            $table->integer('nilai_sertifikat8')->default(0);
            $table->string('sertifikat9')->nullable();
            $table->integer('nilai_sertifikat9')->default(0);
            $table->string('sertifikat10')->nullable();
            $table->integer('nilai_sertifikat10')->default(0);
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
