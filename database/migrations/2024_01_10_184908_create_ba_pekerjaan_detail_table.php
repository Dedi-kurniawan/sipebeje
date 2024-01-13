<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBaPekerjaanDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ba_pekerjaan_detail', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ba_pekerjaan_id');
            $table->foreign('ba_pekerjaan_id')->references('id')->on('ba_pekerjaan');
            $table->string('nama');
            $table->decimal('qty', 5,2);
            $table->string('satuan');
            $table->string('checklist');
            $table->text('keterangan');
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
        Schema::dropIfExists('ba_pekerjaan_detail');
    }
}
