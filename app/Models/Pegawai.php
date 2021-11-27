<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Pegawai extends Authenticatable
{
    use HasFactory;
    protected $guarded = ['id', 'status'];
    protected $fillable = 
    [
        'nama',
        'email',
        'telp',
        'nip',
        'jeniskelamin',
        'alamat',
        'username',
        'password',
        'namabidang',
        'level',
    ];

    public function pengaduan()
    {
        return $this->hasMany(Pengaduan::class);
    }
}
