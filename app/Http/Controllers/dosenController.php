<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class dosenController extends Controller
{
    public function index_dosen()
    {
        return view('dosen.dashboard');
    }

    public function rinci()
    {
        return view('dosen.rincian');
    }

    public function pengajuanKP()
    {
        // Logika untuk menampilkan pengajuan KP
        return view('dosen.daftar_bimbingan');
    }
}
