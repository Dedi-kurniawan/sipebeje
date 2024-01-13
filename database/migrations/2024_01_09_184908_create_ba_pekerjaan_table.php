<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBaPekerjaanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ba_pekerjaan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('desa_id');
            $table->foreign('desa_id')->references('id')->on('desa');
            $table->unsignedBigInteger('kepala_desa_id');
            $table->foreign('kepala_desa_id')->references('id')->on('aparatur');
            $table->text('alamat_kepala_desa')->nullable();
            $table->unsignedBigInteger('aparatur_id');
            $table->foreign('aparatur_id')->references('id')->on('aparatur');
            $table->text('alamat_aparatur')->nullable();
            $table->string('nomor_surat');
            $table->date('tanggal');
            $table->date('tanggal_nota_barang');
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
        Schema::dropIfExists('ba_pekerjaan');
    }
}
