<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratPesananDetail extends Model
{
    use HasFactory;
    protected $table = "surat_pesanan_detail";

    protected $fillable = [
        'surat_pesanan_id', 'nama', 'qty', 'satuan', 'sp'
    ];
}
