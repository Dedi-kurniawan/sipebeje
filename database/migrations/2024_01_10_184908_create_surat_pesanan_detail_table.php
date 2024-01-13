<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuratPesananDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('surat_pesanan_detail', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('surat_pesanan_id');
            $table->foreign('surat_pesanan_id')->references('id')->on('surat_pesanan');
            $table->string('nama');
            $table->decimal('qty', 5,2);
            $table->string('satuan');
            $table->decimal('sp', 18,2);
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
        Schema::dropIfExists('surat_pesanan');
    }
}
