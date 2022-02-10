<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEvaluasiPenawaransTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('evaluasi_penawaran', function (Blueprint $table) {
            $table->id();
            $table->text('nomor')->nullable();
            $table->text('kegiatan')->nullable();
            $table->date('tanggal')->nullable();
            $table->string('jam')->nullable();
            $table->text('nomor_sk')->nullable(); 
            $table->string('tahun_anggaran')->nullable();
            $table->unsignedBigInteger('paket_id');
            $table->foreign('paket_id')->references('id')->on('paket')->onDelete('cascade');
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
        Schema::dropIfExists('evaluasi_penawarans');
    }
}
