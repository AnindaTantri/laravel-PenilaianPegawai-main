<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenilaianTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penilaian', function (Blueprint $table) {
            $table->id();
            $table->foreignId('penugasan_id')->references('id')->on('penugasan');
            $table->foreignId('pegawai_id')->references('id')->on('pegawai');
            $table->foreignId('penilai_id')->references('id')->on('pegawai');
            $table->integer('etika')->default(0);
            $table->integer('disiplin' )->default(0);
            $table->integer('tanggung_jawab')->default(0);
            $table->integer('teamwork')->default(0);
            $table->integer('problem_solve')->default(0);
            $table->integer('kepatuhan')->default(0)->nullable();
            $table->integer('kejujuran')->default(0);
            $table->integer('inisiatif')->default(0)->nullable();
            $table->integer('komunikasi')->default(0)->nullable();
            $table->integer('perencanaan')->default(0)->nullable();
            $table->integer('kepemimpinan')->default(0)->nullable();
            $table->integer('inovasi')->default(0)->nullable();
            $table->integer('analisa_pemikiran')->default(0)->nullable();
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
        Schema::dropIfExists('penilaian');
    }
}
