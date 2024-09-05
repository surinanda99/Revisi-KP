<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dosen extends Model
{
    use HasFactory;
    protected $table = 'dosens';
    protected $fillable = [
        'nama',
        'npp',
        'email',
        'bidang_kajian',
        'telp'
    ];

    public function mahasiswa()
    {
        return $this->hasMany(StatusMahasiswa::class, 'id_dsn', 'id');
    }

    public function pengajuan()
    {
        return $this->hasMany(Pengajuan::class, 'id_dsn', 'id');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'email', 'email');
    }

    public function dosenPeriodik()
    {
        return $this->hasMany(DosenPeriodik::class, 'id_dsn', 'id');
    }

    public function dosen(){
        return $this->hasOne(DosenPembimbing::class, 'id_dsn', 'id');
    }
}
