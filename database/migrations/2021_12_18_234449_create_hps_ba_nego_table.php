<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHpsBaNegoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hps_ba_nego', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('paket_id');
            $table->foreign('paket_id')->references('id')->on('paket')->onDelete('cascade');
            $table->text('uraian')->nullable();
            $table->integer('volume')->nullable();
            $table->decimal('harga_satuan',18,2)->nullable();
            $table->text('satuan')->nullable();
            $table->decimal('jumlah',18,2)->nullable();
            $table->string('pajak', 4)->nullable();
            $table->decimal('harga_pajak',18,2)->nullable();
            $table->text('keterangan')->nullable();
            $table->enum('checklist', ['Ada', 'Tidak Ada'])->nullable();
            $table->string('checklist_keterangan')->nullable();
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
        Schema::dropIfExists('hps_ba_nego');
    }
}
