<?php

namespace App\Http\Controllers;

use App\Models\DetailPenilaian;
use App\Models\PengajuanSidang;
use Illuminate\Http\Request;
use App\Models\Dosen;
use App\Models\StatusMahasiswa;
use App\Models\LogbookBimbingan;
use App\Models\Mahasiswa;
use App\Models\DosenPembimbing;
use App\Models\Pengajuan;

class DosenPembimbingController extends Controller
{
    // public function index()
    // {
    //     $user = auth()->user();
    //     $dosen = Dosen::where('email', $user->email)->first();
    //     $logbook = LogbookBimbingan::where('id_dsn', $dosen->id_dospem)->paginate(10);
    //     $status = StatusMahasiswa::all();
    //     $mahasiswa = Mahasiswa::all();

    //     return view(
    //         'dosen.logbook_bimbingan.logbook_bimbingan_mhs',
    //         compact('dosen', 'logbook', 'status', 'mahasiswa')
    //     );
    // }

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
        $status = StatusMahasiswa::with(['mahasiswa', 'dospem', 'pengajuan', 'sidang'])->get();
        $logbooks = LogbookBimbingan::with(['mahasiswa', 'dosen'])
                ->whereIn('id_mhs', $status->pluck('id_mhs'))->get();

        return view('dosen.logbook_bimbingan.logbook_bimbingan_mhs', compact('status', 'logbooks'));
    }

    public function review_penyelia()
    {
        $detail_penilaians = DetailPenilaian::all();
        return view('dosen.review_penyelia_mhs.review_penyelia_mhs', compact('detail_penilaians'));
    }

    public function Pengajuan_sidang_mhs()
    {
        $pengajuan_sidangs = PengajuanSidang::all();
        return view('dosen.pengajuan_sidang.pengajuan_sidang_mhs', compact('pengajuan_sidangs'));
    }

    public function dash()
    {
        $user = auth()->user();
        $dosen = Dosen::where('email', $user->email)->first();

        // Get the DosenPembimbing related to the Dosen
        $dosenPembimbing = $dosen->dosen;

        // Count the number of submissions for the DosenPembimbing
        $jumlahAjuan = Pengajuan::where('id_dsn', $dosenPembimbing->id)->count();

        return view('dosen.dashboard', compact('dosen', 'jumlahAjuan'));
    }
}
