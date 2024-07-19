<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use Illuminate\Http\Request;
use App\Models\Mahasiswa;
use App\Models\StatusMahasiswa;
use App\Models\Pengajuan;

class PengajuanController extends Controller
{
    public function index()
    {
        $dosen = Dosen::with('dosen')->get();
        // dd($dosen);
        $mhs = Mahasiswa::where('email', auth()->user()->email)->first();
        $status = StatusMahasiswa::where('id_mhs', $mhs->id)->first();
        $history = Pengajuan::where('id_mhs', $status->id_mhs)->where('status', 'TOLAK')->get();
        $data = false;
        if (Pengajuan::where('id_mhs', $status->id_mhs)->first() != null) {
            $pengajuan = Pengajuan::where('id_mhs', $status->id_mhs)
            ->whereIn('status', ['ACC', 'PENDING'])->first();
        if ($pengajuan) {
            $dospil = Dosen::where('id', $pengajuan->id_dsn)->first();
            return view('mahasiswa.pengajuan_kp.draftPengajuan', compact(
                'mhs',
                'status',
                'pengajuan',
                'history',
                'dospil',
                'data'
            ));
        }
    }
        // dd($dosen);
        return view('mahasiswa.pengajuan_kp.pilihDosbing', compact('status', 'dosen'));
    }

    public function form(Request $request)
    {
        $data = $request->all();
        return view('mahasiswa.pengajuan_kp.formPengajuan', compact('data'));
    }

    public function draft(Request $request)
    {
        $data = $request->all();
        $mahasiswa = Mahasiswa::where('email', auth()->user()->email)->first();
        $status = StatusMahasiswa::where('id_mhs', $mahasiswa->id)->first();
        $dospil = Dosen::where('id', $data['id_dospem'])->first();
        $history = Pengajuan::with('dosen')->where('id_mhs', $status->id_mhs)->where('status', 'TOLAK')->get();
        return view('mahasiswa.pengajuan_kp.draftPengajuan', compact(
            'data',
            'mahasiswa',
            'status',
            'dospil',
            'history'
        ));
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $mahasiswa = Mahasiswa::where('email', auth()->user()->email)->first();
        $status = StatusMahasiswa::where('id_mhs', $mahasiswa->id)->first();

        $pengajuan = new Pengajuan();
        $pengajuan->id_mhs = $status->id_mhs;
        $pengajuan->kategori_bidang = $data['kategori_bidang'];
        $pengajuan->judul = $data['judul'];
        $pengajuan->perusahaan = $data['perusahaan'];
        $pengajuan->posisi = $data['posisi'];
        $pengajuan->deskripsi = $data['deskripsi'];
        $pengajuan->durasi = $data['durasi'];
        $pengajuan->id_dsn = $data['id_dsn'];

        $pengajuan->save();

        if (isset($data['id_dospem'])) {
            $dosen = Dosen::find($data['id_dospem']);
            if ($dosen) {
                $dosen->jml_ajuan = $dosen->jml_ajuan + 1;
                $dosen->save();
            }
        }

        // $dosen = Dosen::where('id_dospem', $data['id_dospem'])->first();
        // $dosen->jml_ajuan = $dosen->jml_ajuan + 1;

        // $dosen->update();

        return redirect()->route('pengajuan-mahasiswa');
    }

    public function show($id_dospem)
    {
        $dosen = Dosen::find($id_dospem);
        return response()->json($dosen);
    }



}
