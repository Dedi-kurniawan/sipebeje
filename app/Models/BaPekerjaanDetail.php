<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BaPekerjaanDetail extends Model
{
    use HasFactory;
    protected $table = "ba_pekerjaan_detail";

    protected $fillable = [
        'ba_pekerjaan_id', 'nama', 'qty', 'satuan', 'checklist', 'keterangan'
    ];
}
