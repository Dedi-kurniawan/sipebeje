<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratPerjanjian extends Model
{
    use HasFactory;
    protected $table = "surat_perjanjian";

    protected $fillable = [
        'paket_id', 'vendor_id', 'nomor', 'ruang_lingkap', 'tanggal', 'tempat', 'harga_final', 'harga_final_terbilang', 'diserahkan_jangka_waktu',
        'jangka_waktu', 'mulai_jangka_waktu', 'selesai_jangka_waktu', 'persen_denda', 'nominal_denda', 'nominal_denda_terbilang'
    ];

    public function getTanggalFormatAtAttribute()
    {
        return ' Pada hari ini ' .Carbon::parse($this->attributes['tanggal'])->isoFormat('dddd'). ' tanggal ' .Carbon::parse($this->attributes['created_at'])->isoFormat('D'). ' bulan ' .Carbon::parse($this->attributes['created_at'])->isoFormat('MMMM'). ' tahun ' .Carbon::parse($this->attributes['created_at'])->isoFormat('Y');  
    }

    public function getMulaiFormatAtAttribute()
    {
        return Carbon::parse($this->attributes['mulai_jangka_waktu'])->isoFormat('D MMMM Y');
    }

    public function getSelesaiFormatAtAttribute()
    {
        return Carbon::parse($this->attributes['selesai_jangka_waktu'])->isoFormat('D MMMM Y');
    }

    public function getDiserahkanFormatAtAttribute()
    {
        return Carbon::parse($this->attributes['diserahkan_jangka_waktu'])->isoFormat('D MMMM Y');
    }

    public function getCreatedFormatAtAttribute()
    {
        return Carbon::parse($this->attributes['created_at'])->isoFormat('D MMMM Y');
    }
}
