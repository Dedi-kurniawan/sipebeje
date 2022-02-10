<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NegoHarga extends Model
{
    use HasFactory;
    protected $table = "nego_harga";

    protected $fillable = [
        'paket_id', 'vendor_id', 'tanggal', 'pukul', 'uraian_klarifikasi', 'penawaran_rekanan', 'penawaran_diajukan',  
        'penawaran_diajukan_terbilang',  'hasil_nego', 'administrasi', 'harga', 'hasil_akhir', 'harga_final', 'nomor', 'penawaran_rekanan_terbilang'
    ];

    public function getTanggalFormatAtAttribute()
    {
        return ' Pada hari ini ' .Carbon::parse($this->attributes['tanggal'])->isoFormat('dddd'). ' tanggal ' .Carbon::parse($this->attributes['created_at'])->isoFormat('D'). ' bulan ' .Carbon::parse($this->attributes['created_at'])->isoFormat('MMMM'). ' tahun ' .Carbon::parse($this->attributes['created_at'])->isoFormat('Y');  
    }
}
