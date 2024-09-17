<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    use HasFactory;

    protected $table = 'mahasiswas';

    protected $fillable = [
        'id_mhs',
        'nim',
        'nama',
        'ipk',
        'telp_mhs',
        'email',
        // 'dosen_wali',
        'transkrip_nilai',
        'status_kp',
        'id_dsn'
    ];

    public function user()
    {
        return $this->hasOne(User::class, 'nim', 'nim');
    }

    // public function pengajuan()
    // {
    //     return $this->hasOne(Pengajuan::class);
    // }

    public function pengajuans()
    {
        return $this->hasMany(Pengajuan::class, 'id_mhs', 'id_mhs');
    }

    public function detailPenilaians()
    {
        return $this->hasMany(detailPenilaian::class);
    }

    public function mahasiswaPenyelia()
    {
        return $this->hasOne(MahasiswaPenyelia::class);
    }

    public function pengajuanSidang()
    {
        return $this->hasMany(PengajuanSidang::class, 'id_mhs', 'id');
    }

    public function statusMahasiswa()
    {
        return $this->hasOne(StatusMahasiswa::class, 'id_mhs', 'id');
    }

<<<<<<< HEAD
    public function dosen()
    {
        return $this->belongsTo(Dosen::class, 'id_dsn');
=======
    public function dospem()
    {
        return $this->hasOne(StatusMahasiswa::class, 'id_mhs', 'id');
>>>>>>> e22a6e4afb99111bf9afa24325320e3efdf7b25c
    }
}
