<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    use HasFactory;

    protected $table = "vendor";
    
    protected $fillable = [
        'nama_perusahaan', 'alamat', 'logo', 'email_perusahaan', 'telepon', 'kecamatan_id', 'desa_id', 'kategori_id'
    ];

    public function desa()
    {
        return $this->belongsTo(Desa::class, 'desa_id');
    }

    public function user()
    {
        return $this->hasOne(User::class);
    }    
}
