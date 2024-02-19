<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratPesanan extends Model
{
    use HasFactory;
    protected $table = "surat_pesanan";
    protected $fillable = [
        'paket_id', 'nomor_surat', 'tanggal', 'tanggal_lambat', 'uraian'
    ];
}
