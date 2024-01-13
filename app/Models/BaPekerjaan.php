<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BaPekerjaan extends Model
{
    use HasFactory;
    protected $table = "ba_pekerjaan";

    protected $fillable = [
        'desa_id', 'kepala_desa_id', 'alamat_kepala_desa', 'aparatur_id', 'nomor_surat', 'tanggal', 'alamat_aparatur', 'tanggal_nota_barang'
    ];
}
