<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Undangan extends Model
{
    use HasFactory;

    protected $table = "undangan";
    
    protected $fillable = [
        'paket_id', 'nomor', 'perihal', 'sumber_dana', 'nilai_total', 'terbilang'
    ];

    public function undanganVendors()
    {
        return $this->hasMany(UndanganVendor::class, 'undangan_id');
    }

    public function paket()
    {
        return $this->belongsTo(Paket::class, 'paket_id');
    }

    public function getCreatedAtFormatAttribute()
    {
        return Carbon::parse($this->attributes['created_at'])->format('d-M-Y');
    }
}
