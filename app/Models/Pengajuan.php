<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengajuan extends Model
{
    use HasFactory;

    protected $table = 'pengajuans';
    protected $fillable = [
        'id_mhs',
        'id_dsn',
        'kategori_bidang',
        'judul',
        'perusahaan',
        'posisi',
        'deskripsi',
        'durasi',
        'status',
        'alasan',
    ];

    public function dosen()
    {
        return $this->belongsTo(Dosen::class, 'id_dsn', 'id');
    }
    public function mahasiswa()
    {
        return $this->belongsTo(StatusMahasiswa::class, 'id_mhs', 'id_mhs');
    }
}
