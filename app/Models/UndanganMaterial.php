<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UndanganMaterial extends Model
{
    use HasFactory;

    protected $table = "undangan_material";
    
    protected $fillable = [
        'undangan_id', 'uraian', 'volume', 'satuan', 'harga_satuan'
    ];
}
