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
            $table->unsignedBigInteger('paket_id');
            $table->foreign('paket_id')->references('id')->on('paket');
            $table->string('nomor_surat');
            $table->date('tanggal');
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
