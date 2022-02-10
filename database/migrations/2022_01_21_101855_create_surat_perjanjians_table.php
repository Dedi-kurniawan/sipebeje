<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuratPerjanjiansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('surat_perjanjian', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('paket_id');
            $table->foreign('paket_id')->references('id')->on('paket')->onDelete('cascade');
            $table->unsignedBigInteger('vendor_id')->nullable();
            $table->foreign('vendor_id')->references('id')->on('vendor');
            $table->text('nomor')->nullable();
            $table->text('ruang_lingkap')->nullable();
            $table->date('tanggal')->nullable();
            $table->string('tempat')->nullable();
            $table->decimal('harga_final', 18, 2)->nullable();
            $table->string('harga_final_terbilang')->nullable();
            $table->string('jangka_waktu')->nullable();
            $table->date('mulai_jangka_waktu')->nullable();
            $table->date('selesai_jangka_waktu')->nullable();
            $table->date('diserahkan_jangka_waktu')->nullable();
            $table->string('persen_denda', 4)->nullable();
            $table->decimal('nominal_denda', 18, 2)->nullable();
            $table->string('nominal_denda_terbilang')->nullable();
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
        Schema::dropIfExists('surat_perjanjians');
    }
}
