<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHasilEvaluasiPenawaransTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hasil_evaluasi_penawaran', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('paket_id');
            $table->foreign('paket_id')->references('id')->on('paket')->onDelete('cascade');
            $table->unsignedBigInteger('vendor_id')->nullable();
            $table->foreign('vendor_id')->references('id')->on('vendor');
            $table->enum('administrasi', ['mn', 'tm'])->nullable();
            $table->enum('npwp', ['mn', 'tm'])->nullable();
            $table->enum('surat_penawaran', ['mn', 'tm'])->nullable();
            $table->enum('harga', ['mn', 'tm'])->nullable();
            $table->enum('kesimpulan', ['lulus', 'tidak lulus'])->nullable();
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
        Schema::dropIfExists('hasil_evaluasi_penawarans');
    }
}
