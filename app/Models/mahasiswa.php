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
        'transkrip_nilai',
        'telp_mhs',
        'email',
        'dosen_wali'

    ];

    public function user()
    {
        return $this->hasOne(User::class, 'email', 'email');
    }

    // public function pengajuan()
    // {
    //     return $this->hasOne(Pengajuan::class);
    // }

    public function pengajuan()
    {
        return $this->hasOne(Pengajuan::class, 'id_mhs', 'id');
    }

    public function detailPenilaians()
    {
        return $this->hasMany(detailPenilaian::class);
    }

    public function mahasiswaPenyelia()
    {
        return $this->hasOne(MahasiswaPenyelia::class);
    }

    public function statusMahasiswa()
    {
        return $this->hasOne(StatusMahasiswa::class);
    }

}
