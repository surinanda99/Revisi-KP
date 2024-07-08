<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatusDosen extends Model
{
    use HasFactory;
    protected $table = 'status_dosen';
    protected $fillable = [
        'id_period',
        'kuota',
        'ajuan',
        'diterima',
        'status',
    ];
    public function periode()
    {
        return $this->belongsTo(DosenPeriodik::class, 'id_period', 'id');
    }
}
