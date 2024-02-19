<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BaPekerjaan extends Model
{
    use HasFactory;
    protected $table = "ba_pekerjaan";

    protected $fillable = [
        'paket_id', 'nomor_surat', 'tanggal',
    ];

    public function paket()
    {
        return $this->belongsTo(Paket::class);
    }
}
