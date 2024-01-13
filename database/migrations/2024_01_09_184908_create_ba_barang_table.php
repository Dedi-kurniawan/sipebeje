<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBaBarangTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ba_barang', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('desa_id');
            $table->foreign('desa_id')->references('id')->on('desa');
            $table->unsignedBigInteger('aparatur_id');
            $table->foreign('aparatur_id')->references('id')->on('aparatur');
            $table->text('alamat_aparatur')->nullable();
            $table->string('vendor');
            $table->string('vendor_alamat');
            $table->string('vendor_jabatan');
            $table->string('nomor_surat');
            $table->date('tanggal');
            $table->decimal('ppn', 5,2)->default(0);
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
        Schema::dropIfExists('ba_barang');
    }
}
