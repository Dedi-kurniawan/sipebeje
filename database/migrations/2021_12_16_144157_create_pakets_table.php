<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paket', function (Blueprint $table) {
            $table->id();
            $table->text('nama');
            $table->string('jenis');
            $table->text('keterangan')->nullable();
            $table->enum('status', ['draft', 'proses', 'selesai']);
            $table->decimal('hps', 18,2)->nullable();
            $table->text('terbilang')->nullable();
            $table->unsignedBigInteger('desa_id');
            $table->foreign('desa_id')->references('id')->on('desa');
            $table->unsignedBigInteger('aparatur_id');
            $table->foreign('aparatur_id')->references('id')->on('aparatur');
            $table->unsignedBigInteger('kecamatan_id');
            $table->foreign('kecamatan_id')->references('id')->on('kecamatan');
            $table->date('tanggal_selesai');
            $table->unsignedBigInteger('vendor_id')->nullable()->comment('pemenang');
            $table->foreign('vendor_id')->references('id')->on('vendor')->onDelete('set null');;
            $table->enum('hps_field', ['0', '1']);
            $table->enum('akk_field', ['0', '1']);
            $table->enum('undangan_field', ['0', '1']);
            $table->enum('evaluasi_field', ['0', '1']);
            $table->enum('perjanjian_field', ['0', '1']);
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
        Schema::dropIfExists('pakets');
    }
}
