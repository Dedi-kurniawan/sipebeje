<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BaBarangDetail extends Model
{
    use HasFactory;
    protected $table = "ba_barang_detail";

    protected $fillable = [
        'ba_barang_id', 'nama', 'qty', 'satuan', 'harga_satuan'
    ];
}
