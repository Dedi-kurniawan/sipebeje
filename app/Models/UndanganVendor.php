<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UndanganVendor extends Model
{
    use HasFactory;

    protected $table = "undangan_vendor";
    
    protected $fillable = [
        'undangan_id', 'vendor_id', 'status', 'paket_id'
    ];

    public function undangan()
    {
        return $this->belongsTo(Undangan::class, 'undangan_id');
    }

    public function vendor()
    {
        return $this->belongsTo(Vendor::class, 'vendor_id');
    }

    public function paket()
    {
        return $this->belongsTo(Paket::class, 'paket_id');
    }

    public function getCreatedFormatAtAttribute()
    {
        return Carbon::parse($this->attributes['created_at'])->isoFormat('dddd, D MMMM Y');  
    }

    public function scopeOfStatus($query, $value)
    {
        if (!empty($value)) {
            return $query->where('status', $value);
        }
    }
}
