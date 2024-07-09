<?php

namespace App\Http\Controllers;

use App\Models\DetailPenilaian;
use Illuminate\Http\Request;
use App\Models\Dosen;
use App\Models\StatusMahasiswa;
use App\Models\LogbookBimbingan;
use App\Models\Mahasiswa;
use App\Models\DosenPembimbing;
use App\Models\Pengajuan;

class DosenPembimbingController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $dosen = Dosen::where('email', $user->email)->first();
        $logbook = LogbookBimbingan::where('id_dsn', $dosen->id_dospem)->paginate(10);
        $status = StatusMahasiswa::all();
        $mahasiswa = Mahasiswa::all();

        return view(
            'dosen.logbook_bimbingan.logbook_bimbingan_mhs',
            compact('dosen', 'logbook', 'status', 'mahasiswa')
        );
    }

    public function update(Request $request)
    {
        $logbook = LogbookBimbingan::findOrFail($request->id_logbook);
        $logbook->status_logbook = $request->status;
        $logbook->save();

        return redirect()->back();
    }

    // public function index()
    // {
    //     return view('dosen.dashboard');
    // }

    public function dashboard_dsn()
    {
        return view('dosen.dashboard');
    }

    public function daftar_mhs_bimbingan()
    {
        $user = auth()->user();
        $dosen = Dosen::where('email', $user->email)->first();
        $pengajuan = Pengajuan::where('id_dsn', $dosen->id)->get();
        return view('dosen.daftar_bimbingan.daftar_bimbingan', compact('pengajuan'));
    }

    public function logbook_bimbingan_mhs()
    {
        return view('dosen.logbook_bimbingan.logbook_bimbingan_mhs');
    }

    public function review_penyelia()
    {
        $detail_penilaians = DetailPenilaian::all();
        return view('dosen.review_penyelia_mhs.review_penyelia_mhs');
    }

    public function Pengajuan_sidang_mhs()
    {
        return view('dosen.pengajuan_sidang.pengajuan_sidang_mhs');
    }
}
