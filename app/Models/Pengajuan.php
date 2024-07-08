<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengajuan extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_mhs', 
        'id_dospem', 
        'kategori_bidang',
        'judul',
        'perusahaan',
        'posisi',
        'deskripsi',
        'durasi',
    ];

    public function dosenPembimbing()
    {
        return $this->belongsTo(DosenPembimbing::class, 'id_dospem', 'id');
    }
}
