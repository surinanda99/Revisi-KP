<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DosenPembimbing;

class DosenPembimbingController extends Controller
{
    public function index()
    {
        return view('dosen.daftar_bimbingan.daftar_bimbingan');
    }

    public function daftar_mhs_bimbingan()
    {
        return view('dosen.daftar_bimbingan.daftar_bimbingan');
    }

    public function logbook_bimbingan_mhs()
    {
        return view('dosen.logbook_bimbingan.logbook_bimbingan');
    }

    public function review_penyelia()
    {
        return view('dosen.review_penyelia_mhs.review_penyelia_mhs');
    }
}
