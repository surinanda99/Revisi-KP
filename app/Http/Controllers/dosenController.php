<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class dosenController extends Controller
{
    public function list()
    {
        return view('dosen.jumlahBimbingan');
    }

    public function rinci()
    {
        return view('dosen.rincian');
    }
}
