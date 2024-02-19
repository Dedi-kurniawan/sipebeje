<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HpsBaNego extends Model
{
    use HasFactory;

    protected $table = "hps_ba_nego";

    protected $fillable = [
        'paket_id', 'uraian', 'volume', 'harga_satuan', 'jumlah', 'pajak', 'harga_pajak', 'keterangan', 'satuan', 'checklist', 'checklist_keterangan'
    ];

    public function scopeOfPaketId($query, $value)
    {
        if (!empty($value)) {
            return $query->where('paket_id', $value);
        }
    }

    public function getCreatedAtFormatAttribute()
    {
        return Carbon::parse($this->attributes['created_at'])->format('d-M-Y');
    }
}
