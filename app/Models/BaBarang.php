<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BaBarang extends Model
{
    use HasFactory;
    protected $table = "ba_barang";

    protected $fillable = [
        'desa_id', 'vendor', 'vendor_alamat', 'vendor_jabatan', 'aparatur_id', 'nomor_surat', 'tanggal', 'alamat_aparatur', 'tanggal_lambat', 'ppn', 'tanggal_nota_barang'
    ];
}
