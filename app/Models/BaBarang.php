<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BaBarang extends Model
{
    use HasFactory;
    protected $table = "ba_barang";

    protected $fillable = [
        'aparatur_id', 'nomor_surat', 'tanggal', 'paket_id'
    ];
}
