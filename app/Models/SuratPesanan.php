<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratPesanan extends Model
{
    use HasFactory;
    protected $table = "surat_pesanan";
    protected $fillable = [
        'desa_id', 'vendor_id', 'aparatur_id', 'nomor_surat', 'tanggal', 'alamat_aparatur', 'tanggal_lambat', 'beban_kepada', 'jenis_belanja', 'uraian_jenis_belanja', 'ppn', 'pph'
    ];
}
