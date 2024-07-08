<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Pengajuan;
use App\Models\StatusMahasiswa;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;

class MahasiswaBimbinganControlller extends Controller
{
    public function index()
    {
        $dosen = Dosen::where('email', auth()->user()->email)->first();
        // Cara mengambil data pengajuan yang belum di tolak
        $pengajuan = Pengajuan::with('mahasiswa.mahasiswa')
            ->where('id_dsn', $dosen->id)
            ->where('status', 'PENDING')
            ->get();

        return view('dosen.daftar_bimbingan.daftar_bimbingan', compact('pengajuan'));
    }

    public function detail($id)
    {
        $pengajuan = Pengajuan::findOrFail($id);
        $status = StatusMahasiswa::where('id_mhs', $pengajuan->id_mhs)->first();
        $mahasiswa = Mahasiswa::where('id', $status->id_mhs)->first();
        return view('dosen.daftar_bimbingan.detail_mahasiswa_bimbingan', compact('pengajuan', 'mahasiswa'));
    }

    

}
