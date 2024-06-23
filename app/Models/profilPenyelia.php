<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class profilPenyelia extends Model
{
    use HasFactory;

    protected $fillable = ['nama', 'posisi', 'departemen', 'perusahaan'];

    public function detailPenilaian()
    {
        return $this->hasMany(DetailPenilaian::class);
    }
}
