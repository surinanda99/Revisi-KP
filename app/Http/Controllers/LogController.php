<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LogController extends Controller
{
    public function LogDosen(){
        return view('koor.log_aplikasi.log_dosen');
    }

    public function LogMahasiswa(){
        return view('koor.log_aplikasi.log_mhs');
    }
}
