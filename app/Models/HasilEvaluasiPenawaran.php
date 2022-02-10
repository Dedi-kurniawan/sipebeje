<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HasilEvaluasiPenawaran extends Model
{
    use HasFactory;

    protected $table = "hasil_evaluasi_penawaran";

    protected $fillable = [
        'kesimpulan', 'harga', 'surat_penawaran', 'npwp',  'vendor_id', 'paket_id'
    ];

    public function vendor()
    {
        return $this->belongsTo(Vendor::class, 'vendor_id');
    }
}
