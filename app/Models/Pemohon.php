<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Pemohon extends Authenticatable
{
    use HasFactory;
    protected $guarded = ['id', 'status'];
    
    public function aspirasi()
    {
        return $this->hasMany(Aspirasi::class);
    }

    public function pengaduan()
    {
        return $this->hasMany(Pengaduan::class);
    }
}
