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
        'dosen_wali' 

    ];

    public function user()
    {
        return $this->hasOne(User::class, 'email', 'email');
    }

    public function pengajuan()
    {
        return $this->hasOne(Pengajuan::class);
    }
}
