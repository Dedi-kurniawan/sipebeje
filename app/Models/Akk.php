<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Akk extends Model
{
    use HasFactory;

    protected $table = "akk";
    protected $fillable = [
        'paket_id', 'kegiatan', 'dusun', 'rt', 'latar_belakang', 'maksud', 'tujuan', 'hasil', 'lokasi_kegiatan', 'dasar_penganggaran', 'dp_no', 'dp_tgl', 'dp_bidang', 'dp_subbidang', 'dp_kegiatan', 'waktu_pelaksanaan', 'gambaran_pelaksanaan', 'spesifikasi_teknis', 'tenaga_kerja', 'metode_pengadaan', 'pagu_anggaran', 'pagu_anggaran_rp', 'pagu_anggaran_terbilang',
    ];

    public function getCreatedAtFormatAttribute()
    {
        return Carbon::parse($this->attributes['created_at'])->isoFormat('D MMMM Y'); 
    }
}
