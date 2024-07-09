<?php

namespace App\Http\Controllers;

use App\Models\PengajuanSidang;
use App\Models\Mahasiswa;
use App\Models\StatusMahasiswa;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class PengajuanSidangController extends Controller
{
    // public function form_sidang()
    // {
    //     return view('mahasiswa.pengajuan_sidang.pengajuan_sidang'); // Sesuaikan dengan nama view yang Anda buat
    // }
    public function pengajuan_sidang(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'judul' => 'required|string',
            'bidang_kajian' => 'required|string|in:SC,RPLD,SKKKD',
            'dokumen' => 'required|string',
            'validasi' => 'required|string',
            'nilaiPenyelia' => 'required|string',
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    
        $mahasiswa = Mahasiswa::where('email', auth()->user()->email)->first();
        PengajuanSidang::create([
            'id_mhs' => $mahasiswa->id,
            'judul' => $request->judul,
            'bidang_kajian' => $request->bidang_kajian,
            'dokumen' => $request->dokumen,
            'validasi' => $request->validasi,
            'nilaiPenyelia' => $request->nilaiPenyelia,
        ]);
    
        return redirect()->route('draft_sidang')->with('success', 'Pengajuan sidang berhasil disimpan.');
    }

    public function form_sidang(Request $request)
    {
        $data = $request->all();
        // dd($data);
        return view('mahasiswa.pengajuan_sidang.pengajuan_sidang', compact('data'));
    }

    public function draft_sidang(Request $request)
    {
        $data = $request->all();
        $mahasiswa = Mahasiswa::where('email', auth()->user()->email)->first();
        $sidang = PengajuanSidang::where('id_mhs', $mahasiswa->id)->first(); // Ambil data pengajuan sidang
        $status = StatusMahasiswa::where('id_mhs', $mahasiswa->id)->first();
        // return view('mahasiswa.pengajuan_sidang.draft_sidang', compact(
        //     'data',
        //     'mahasiswa',
        //     'status',
        // ));
        return view('mahasiswa.pengajuan_sidang.draft_sidang', [
            'sidang' => $sidang,
            'data' => $sidang, // Asumsi $data sama dengan $sidang
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $mahasiswa = Mahasiswa::where('email', auth()->user()->email)->first();
        $status = StatusMahasiswa::where('id_mhs', $mahasiswa->id)->first();

        $sidang = new PengajuanSidang();
        $sidang->id_mhs = $status->id_mhs;
        $sidang->judul = $data['judul'];
        $sidang->bidang_kajian = $data['bidang_kajian'];
        $sidang->dokumen = $data['dokumen'];
        $sidang->validasi = $data['validasi'];
        $sidang->nilaiPenyelia = $data['nilaiPenyelia'];

        $sidang->save();

        return redirect()->route('draft_pengajuan_sidang')->with('success', 'Pengajuan sidang berhasil disimpan.');

        return view('mahasiswa.pengajuan_sidang.draft_sidang', compact('data', 'mahasiswa','status',));

    }
}
