<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuratPesananTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('surat_pesanan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('desa_id');
            $table->foreign('desa_id')->references('id')->on('desa');
            $table->unsignedBigInteger('vendor_id');
            $table->foreign('vendor_id')->references('id')->on('vendor');
            $table->unsignedBigInteger('aparatur_id');
            $table->foreign('aparatur_id')->references('id')->on('aparatur');
            $table->string('nomor_surat');
            $table->date('tanggal');
            $table->text('alamat_aparatur')->nullable();
            $table->date('tanggal_lambat')->nullable();
            $table->text('beban_kepada')->nullable();
            $table->text('jenis_belanja')->nullable();
            $table->text('uraian_jenis_belanja')->nullable();
            $table->decimal('ppn', 5,2)->default(0);
            $table->decimal('pph', 5,2)->default(0);
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
