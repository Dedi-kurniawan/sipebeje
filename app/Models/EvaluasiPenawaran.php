<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EvaluasiPenawaran extends Model
{
    use HasFactory;

    protected $table = "evaluasi_penawaran";
    
    protected $fillable = [
        'nomor', 'kegiatan', 'tanggal', 'jam', 'nomor_sk',  'tahun_anggaran', 'paket_id'
    ];

    public function paket()
    {
        return $this->hasOne(Paket::class, 'paket_id');
    }

    public function getTanggalFormatAtAttribute()
    {
        return ' Pada hari ini ' .Carbon::parse($this->attributes['tanggal'])->isoFormat('dddd'). ' tanggal ' .Carbon::parse($this->attributes['tanggal'])->isoFormat('D'). ' bulan ' .Carbon::parse($this->attributes['tanggal'])->isoFormat('MMMM'). ' tahun ' .Carbon::parse($this->attributes['tanggal'])->isoFormat('Y');  
    }
    
    public function getTanggalBuatFormatAtAttribute()
    {
        return Carbon::parse($this->attributes['tanggal'])->isoFormat('D MMMM Y');
    }

    public function getCreatedAtFormatAttribute()
    {
        return Carbon::parse($this->attributes['created_at'])->isoFormat('D MMMM Y'); 
    }
}
