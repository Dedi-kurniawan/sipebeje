<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBaBarangDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ba_barang_detail', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ba_barang_id');
            $table->foreign('ba_barang_id')->references('id')->on('ba_barang');
            $table->string('nama');
            $table->decimal('qty', 5,2);
            $table->string('satuan');
            $table->decimal('harga_satuan', 18,2);
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
        Schema::dropIfExists('ba_barang_detail');
    }
}
