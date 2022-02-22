<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Carbon\Carbon;

class Paket extends Model
{
    use HasFactory;
    protected $table = "paket";

    protected $fillable = [
        'nama', 'jenis', 'keterangan', 'status', 'hps', 'desa_id', 'aparatur_id', 'kecamatan_id', 'tanggal_selesai', 'vendor_id', 'terbilang', 
        'hps_field', 'akk_field', 'undangan_field', 'evaluasi_field', 'perjanjian_field', 'nego_harga_field', 'hasil_evaluasi_field'
    ];

    public function evaluasiPenawaran()
    {
        return $this->hasOne(EvaluasiPenawaran::class, 'paket_id');
    }

    public function akk()
    {
        return $this->hasOne(Akk::class, 'paket_id');
    }

    public function hpsTable()
    {
        return $this->hasMany(Hps::class, 'paket_id');
    }

    public function undangan()
    {
        return $this->hasOne(Undangan::class, 'paket_id');
    }

    public function undanganVendor()
    {
        return $this->hasMany(UndanganVendor::class, 'paket_id');
    }

    public function negoHarga()
    {
        return $this->hasOne(NegoHarga::class, 'paket_id');
    }

    public function suratPerjanjian()
    {
        return $this->hasOne(SuratPerjanjian::class, 'paket_id');
    }

    public function aparatur()
    {
        return $this->belongsTo(Aparatur::class, 'aparatur_id');
    }

    public function desa()
    {
        return $this->belongsTo(Desa::class, 'desa_id');
    }

    public function kecamatan()
    {
        return $this->belongsTo(Kecamatan::class, 'kecamatan_id');
    }

    public function vendor()
    {
        return $this->belongsTo(Vendor::class, 'vendor_id');
    }

    public function getNamaFormatAttribute()
    {
        return Str::limit(strip_tags($this->nama), 30);
    }

    public function getTanggalSelesaiAtAttribute()
    {
        $tanggal = Carbon::parse($this->attributes['tanggal_selesai'])->format('d-m-Y');
        if ($this->tanggal_selesai >= Carbon::now()->format('Y-m-d')) {
            return "<span class='badge bg-success font-weight-bold btn-inline' title='pendaftaran masih di buka'><i class='fa fa-calendar'></i> $tanggal</span>";
        } else {
            return "<span class='badge bg-danger font-weight-bold btn-inline' title='pendaftaran sudah di tutup'><i class='fa fa-calendar'></i> $tanggal</span>";
        }
    }

    public function getHpsFieldIconAttribute()
    {
        if ($this->attributes['hps_field'] == "1") {
            return "<span class='badge bg-success waves-effect waves-light' title='sudah di buat'><i class='fa fa-check'></i> HPS</span>";
        } else {
            return "<span class='badge bg-danger waves-effect waves-light' title='belum di buat'><i class='fa fa-times'></i> HPS</span>";
        }
    }

    public function getAkkFieldIconAttribute()
    {
        if ($this->attributes['akk_field'] == "1") {
            return "<span class='badge bg-success waves-effect waves-light' title='sudah di buat'><i class='fa fa-check'></i> KAK</span>";
        } else {
            return "<span class='badge bg-danger waves-effect waves-light' title='belum di buat'><i class='fa fa-times'></i> KAK</span>";
        }
    }

    public function getUndanganFieldIconAttribute()
    {
        if ($this->attributes['undangan_field'] == "1") {
            return "<span class='badge bg-success waves-effect waves-light' title='sudah di kirim'><i class='fa fa-check'></i> UNDANGAN</span>";
        } else {
            return "<span class='badge bg-danger waves-effect waves-light' title='belum di kirim'><i class='fa fa-times'></i> UNDANGAN</span>";
        }
    }

    public function getEvaluasiFieldIconAttribute()
    {
        if ($this->attributes['evaluasi_field'] == "1") {
            return "<span class='badge bg-success waves-effect waves-light' title='sudah di buat'><i class='fa fa-check'></i> BA EVALUASI HARGA</span>";
        } else {
            return "<span class='badge bg-danger waves-effect waves-light' title='belum di buat'><i class='fa fa-times'></i> BA EVALUASI HARGA</span>";
        }
    }

    public function getPerjanjianFieldIconAttribute()
    {
        if ($this->attributes['perjanjian_field'] == "1") {
            return "<span class='badge bg-success waves-effect waves-light' title='sudah di buat'><i class='fa fa-check'></i> PERJANJIAN</span>";
        } else {
            return "<span class='badge bg-danger waves-effect waves-light' title='belum di buat'><i class='fa fa-times'></i> PERJANJIAN</span>";
        }
    }

    public function getNegoHargaFieldIconAttribute()
    {
        if ($this->attributes['nego_harga_field'] == "1") {
            return "<span class='badge bg-success waves-effect waves-light' title='sudah di buat'><i class='fa fa-check'></i> BA NEGO HARGA</span>";
        } else {
            return "<span class='badge bg-danger waves-effect waves-light' title='belum di buat'><i class='fa fa-times'></i> BA NEGO HARGA</span>";
        }
    }

    public function getHasilEvaluasiFieldIconAttribute()
    {
        if ($this->attributes['hasil_evaluasi_field'] == "1") {
            return "<span class='badge bg-success waves-effect waves-light' title='sudah di buat'><i class='fa fa-check'></i> HASIL EVALUASI </span>";
        } else {
            return "<span class='badge bg-danger waves-effect waves-light' title='belum di buat'><i class='fa fa-times'></i> HASIL EVALUASI </span>";
        }
    }

    public function getStatusFormatAtAttribute()
    {
        if ($this->attributes['status'] == 'draft') {
            return "<span class='badge bg-danger font-weight-bold btn-inline' data-container='body' data-toggle='tooltip' title='Draft'>Draft</span>";
        } else if ($this->attributes['status'] == 'proses') {
            return "<span class='badge bg-primary font-weight-bold btn-inline' data-container='body' data-toggle='tooltip' title='Proses'>Proses</span>";
        } else {
            return "<span class='badge bg-success font-weight-bold btn-inline' data-container='body' data-toggle='tooltip' title='Selesai'>Selesai</span>";
        }
    }

    public function scopeOfDesaId($query, $value)
    {
        if (!empty($value)) {
            return $query->where('desa_id', $value);
        }
    }

    public function scopeOfKecamatanId($query, $value)
    {
        if (!empty($value)) {
            return $query->where('kecamatan_id', $value);
        }
    }

    public function scopeOfStatus($query, $value)
    {
        if (!empty($value)) {
            return $query->where('status', $value);
        }
    }

    public function scopeOfNama($query, $value)
    {
        if (!empty($value)) {
            return $query->where('nama', 'like', "%" . $value . "%"); 
        }
    }
}
