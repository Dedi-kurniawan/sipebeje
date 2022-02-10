<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNomorToNegoHarga extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('nego_harga', function (Blueprint $table) {
            $table->string('nomor')->nullable();
            $table->text('penawaran_rekanan_terbilang')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('nego_harga', function (Blueprint $table) {
            //
        });
    }
}
