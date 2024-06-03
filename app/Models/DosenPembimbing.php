<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DosenPembimbing extends Model
{
    use HasFactory;

    protected $fillable = [
        'npp',
        'nama',
        'bidang_kajian',
        'kuota',
        'jumlah_ajuan',
        'ajuan_diterima',
        'sisa_kuota',
        'status'
    ];
}
