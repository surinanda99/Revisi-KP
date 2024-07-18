<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\StatusMahasiswa;
use Illuminate\Http\Request;

class DospemBimbinganController extends Controller
{
    public function index()
    {
        $dosen = Dosen::where('email', auth()->user()->email)->first();
        $status = StatusMahasiswa::with('mahasiswa')->where('id_dsn', $dosen->id)->get();

        return view(
            'dosen.logbook_bimbingan.logbook_bimbingan_mhs',
            compact('dosen', 'status')
        );
    }
}
