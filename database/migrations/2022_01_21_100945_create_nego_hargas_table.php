<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNegoHargasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nego_harga', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('paket_id');
            $table->foreign('paket_id')->references('id')->on('paket')->onDelete('cascade');
            $table->unsignedBigInteger('vendor_id')->nullable();
            $table->foreign('vendor_id')->references('id')->on('vendor');
            $table->date('tanggal')->nullable();
            $table->string('pukul')->nullable();
            $table->text('uraian_klarifikasi')->nullable();
            $table->decimal('penawaran_rekanan', 18, 2)->nullable();
            $table->decimal('penawaran_diajukan', 18, 2)->nullable();
            $table->string('penawaran_diajukan_terbilang')->nullable();
            $table->decimal('hasil_nego', 18, 2)->nullable();
            $table->enum('administrasi', ['mn', 'tm'])->nullable();
            $table->enum('harga', ['mn', 'tm'])->nullable();
            $table->enum('hasil_akhir', ['mn', 'tm'])->nullable();
            $table->decimal('harga_final', 18, 2)->nullable();
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
        Schema::dropIfExists('nego_hargas');
    }
}
