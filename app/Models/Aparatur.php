<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aparatur extends Model
{
    use HasFactory;

    protected $table = "aparatur";    
    protected $fillable = [
        'nama', 'jabatan', 'status', 'desa_id', 'kecamatan_id'
    ];

    public function setNamaAttribute($value)
    {
        $this->attributes['nama'] = strtoupper($value);
    }

    public function kecamatan()
    {
        return $this->belongsTo(Kecamatan::class);
    }

    public function desa()
    {
        return $this->belongsTo(Desa::class);
    }

    public function getStatusFormatAtAttribute()
    {
        if ($this->attributes['status'] == '1'){
           return "<span class='btn btn-sm font-weight-bold btn-success btn-inline' data-id='{$this->id}' data-status='{$this->status}' data-name='{$this->name}' id='ubahStatus' data-container='body' data-toggle='tooltip' title='Operator {$this->name} aktif'><i class='fa fa-unlock'></i> Aktif</span>";
        }else{
           return "<span class='btn btn-sm font-weight-bold btn-danger btn-inline' data-id='{$this->id}' data-status='{$this->status}' data-name='{$this->name}' id='ubahStatus' data-container='body' data-toggle='tooltip' title='Operator {$this->name} tidak aktif'><i class='fa fa-lock'></i> Tidak Aktif</span>";
        }
    }

    public function scopeOfNama($query, $value)
    {
        if (!empty($value)) {
            return $query->where('nama', 'like', "%" . $value . "%"); 
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
}
