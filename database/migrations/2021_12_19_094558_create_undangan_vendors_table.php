<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUndanganVendorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('undangan_vendor', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('undangan_id');
            $table->foreign('undangan_id')->references('id')->on('undangan')->onDelete('cascade');
            $table->unsignedBigInteger('vendor_id')->comment('ikut tender')->onDelete('cascade');;
            $table->foreign('vendor_id')->references('id')->on('vendor');
            $table->enum('status', ['0', '1', '2'])->comment('0 : belum di konfirmasi, 1 : tidak ikut, 2 : ikut');
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
        Schema::dropIfExists('undangan_vendors');
    }
}
