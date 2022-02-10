<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAkksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('akk', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('paket_id');
            $table->foreign('paket_id')->references('id')->on('paket')->onDelete('cascade');;
            $table->text('kegiatan')->nullable();
            $table->text('dusun')->nullable();
            $table->text('rt')->nullable();
            $table->text('latar_belakang')->nullable();
            $table->text('maksud')->nullable();
            $table->text('tujuan')->nullable();
            $table->text('hasil')->nullable();
            $table->text('lokasi_kegiatan')->nullable();
            $table->text('dasar_penganggaran')->nullable();
            $table->string('dp_no')->nullable();
            $table->date('dp_tgl')->nullable();
            $table->string('dp_bidang')->nullable();
            $table->string('dp_subbidang')->nullable();
            $table->string('dp_kegiatan')->nullable();
            $table->string('waktu_pelaksanaan')->nullable();
            $table->text('gambaran_pelaksanaan')->nullable();
            $table->text('spesifikasi_teknis')->nullable();
            $table->text('tenaga_kerja')->nullable();
            $table->string('metode_pengadaan')->nullable();
            $table->string('pagu_anggaran')->nullable();
            $table->decimal('pagu_anggaran_rp', 18,2)->nullable();
            $table->text('pagu_anggaran_terbilang')->nullable();
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
        Schema::dropIfExists('akks');
    }
}
