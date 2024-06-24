<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class detailPenilaian extends Model
{
    use HasFactory;

    protected $fillable = [
        'profil_penyelia_id', 'deskripsi_pekerjaan', 'prestasi_kontribusi', 'keterampilan_kemampuan',
        'kerjasama_keterlibatan', 'komentar', 'perkembangan', 'kesimpulan_saran', 'score', 'file_path'
    ];

    public function profilPenyelia()
    {
        return $this->belongsTo(ProfilPenyelia::class);
    }
}
