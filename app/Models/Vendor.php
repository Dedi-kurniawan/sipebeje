<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    use HasFactory;

    protected $table = "vendor";
    
    protected $fillable = [
        'nama_perusahaan', 'alamat', 'logo', 'email_perusahaan', 'telepon', 'kecamatan_id', 'desa_id', 'kategori_id', 'npwp', 'create_by'
    ];

    public function kecamatan()
    {
        return $this->belongsTo(Kecamatan::class);
    }

    public function desa()
    {
        return $this->belongsTo(Desa::class);
    }

    public function user()
    {
        return $this->hasOne(User::class, 'vendor_id');
    }  
    
    public function scopeOfNama($query, $value)
    {
        if (!empty($value)) {
            return $query->where('nama_perusahaan', 'like', "%" . $value . "%"); 
        }
    }

    public function scopeOfKecamatan($query, $value)
    {
        if (!empty($value)) {
            return $query->where('kecamatan_id', $value); 
        }
    }

    public function scopeOfDesa($query, $value)
    {
        if (!empty($value)) {
            return $query->where('desa_id', $value); 
        }
    }

    public function scopeOfCreateBy($query, $value)
    {
        if (!empty($value)) {
            return $query->where('create_by', $value); 
        }
    }
}
