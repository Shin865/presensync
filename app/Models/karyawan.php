<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class karyawan extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'karyawan';
    protected $primaryKey = 'nik';
    protected $fillable = [
        'nik',
        'id_admin',
        'nama_lengkap',
        'pangkat',
        'no_hp',
        'kode_jab',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'id_admin', 'id_admin');
    }

}