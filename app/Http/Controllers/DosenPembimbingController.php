<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DosenPembimbing;

class DosenPembimbingController extends Controller
{
    public function index()
    {
        $dosens = DosenPembimbing::all();
        return view('mahasiswa.pilihDosbing', compact('dosens'));
    }

    public function pilihDosen(Request $request)
    {
        $request->session()->put('dosen_terpilih', $request->dosen_id);
        return redirect()->route('formPengajuan');
    }

    public function formPengajuan()
    {
        $dosenTerpilih = session('dosen_terpilih');
        $dosen = DosenPembimbing::find($dosenTerpilih);
        return view('mahasiswa.formPengajuan', compact('dosen'));
    }
}
