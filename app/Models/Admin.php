<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;

class Admin extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'admins';
    protected $primaryKey = 'id_admin';
    protected $fillable = [
        'id_admin',
        'nama_admin',
        'email',
        'password',
        'status',
        'paket',
        'lokasi_kantor',
        'radius',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function karyawans()
{
    return $this->hasMany(Karyawan::class, 'id_admin', 'id_admin');
}
}