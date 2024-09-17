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
        // 'deskripsi',
        'tanggal_mulai', 
        'tanggal_selesai',
        // 'durasi',
        'status',
        'alasan',
    ];

    // Jika perlu format tanggal
    protected $dates = ['tanggal_mulai', 'tanggal_selesai'];

    public function dosen()
    {
        return $this->belongsTo(Dosen::class, 'id_dsn', 'id');
    }
    // public function mahasiswa()
    // {
    //     return $this->belongsTo(StatusMahasiswa::class, 'id_mhs', 'id_mhs');
    // }

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'id_mhs', 'id');
    }

<<<<<<< HEAD
    public function statusMahasiswa()
    {
        return $this->belongsTo(StatusMahasiswa::class, 'id_mhs', 'id_mhs');
=======
    public function dosen_bimbingan()
    {
        return $this->belongsTo(DosenPembimbing::class, 'id_dsn');
>>>>>>> e22a6e4afb99111bf9afa24325320e3efdf7b25c
    }
}
