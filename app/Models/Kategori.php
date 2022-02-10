<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;

    protected $table = "kategori";
    protected $fillable = [
        'nama', 'status'
    ];

    public function setNamaAttribute($value)
    {
        $this->attributes['nama'] = strtoupper($value);
    }

    public function getStatusFormatAtAttribute()
    {
        if ($this->attributes['status'] == '1'){
           return "<span class='btn btn-sm font-weight-bold btn-success btn-inline' data-id='{$this->id}' data-status='{$this->status}' data-name='{$this->nama}' id='ubahStatus' data-container='body' data-toggle='tooltip' title='Desa {$this->nama} aktif'><i class='fa fa-unlock'></i> Aktif</span>";
        }else{
           return "<span class='btn btn-sm font-weight-bold btn-danger btn-inline' data-id='{$this->id}' data-status='{$this->status}' data-name='{$this->nama}' id='ubahStatus' data-container='body' data-toggle='tooltip' title='Desa {$this->nama} tidak aktif'><i class='fa fa-lock'></i> Tidak Aktif</span>";
        }
    }

    public function scopeOfStatus($query, $value)
    {
        if (!empty($value)) {
            return $query->where('status', $value); 
        }
    }
}
