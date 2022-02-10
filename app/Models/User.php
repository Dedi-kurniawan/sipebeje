<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name', 'email', 'password', 'role', 'desa_id', 'status', 'full_field',
        'confirmed', 'confirmation_code', 'confirm_url', 'url_name', 'vendor_id'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function desa()
    {
        return $this->belongsTo(Desa::class);
    }

    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }

    public function getStatusFormatAtAttribute()
    {
        if ($this->attributes['status'] == '1'){
           return "<span class='btn btn-sm font-weight-bold btn-success btn-inline' data-id='{$this->id}' data-status='{$this->status}' data-name='{$this->name}' id='ubahStatus' data-container='body' data-toggle='tooltip' title='Operator {$this->name} aktif'><i class='fa fa-unlock'></i> Aktif</span>";
        }else{
           return "<span class='btn btn-sm font-weight-bold btn-danger btn-inline' data-id='{$this->id}' data-status='{$this->status}' data-name='{$this->name}' id='ubahStatus' data-container='body' data-toggle='tooltip' title='Operator {$this->name} tidak aktif'><i class='fa fa-lock'></i> Tidak Aktif</span>";
        }
    }

    public function scopeOfRole($query, $value)
    {
        return $query->where('role', $value);
    }
}
