<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Desa extends Model
{
    use HasFactory;

    protected $table = "desa";

    protected $fillable = [
        'nama', 'alamat', 'tahun_berdiri', 'kepala_desa', 'logo', 'email', 'telepon', 'kecamatan_id', 'pendamping_desa'
    ];

    public function setNamaAttribute($value)
    {
        $this->attributes['nama'] = strtoupper($value);
    }

    public function getPhotoPathAttribute()
    {
        $dir = "template/images/desa/";
        if ($this->logo !== NULL){
            if(file_exists(public_path($dir. $this->logo))){
                return url($dir. $this->logo);
            }else{
                return url('template/images/default/no-image.png');
            }
        } else {           
            return url('template/images/default/no-image.png');
        }
    }

    public function kecamatan()
    {
        return $this->belongsTo(Kecamatan::class);
    }

    public function scopeOfNama($query, $value)
    {
        if (!empty($value)) {
            return $query->where('nama', 'like', "%" . $value . "%");
        }
    }

    public function scopeOfKecamatanId($query, $value)
    {
        if (!empty($value)) {
            return $query->where('kecamatan_id', $value);
        }
    }
    
}
