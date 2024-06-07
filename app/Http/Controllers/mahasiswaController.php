<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\DosenPembimbing;
use App\Models\Penyelia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MahasiswaController extends Controller
{
    public function index()
    {
        return view('mahasiswa.dashboard');
    }

    public function pengajuan_kp()
    {
        $dosens = DosenPembimbing::all();
        $mahasiswa = session('mahasiswa');
        return view('mahasiswa.pengajuan_kp.pengajuan_kp', compact('dosens', 'mahasiswa'));
    }

    public function pilih_dosbing()
    {
        $dosens = DosenPembimbing::all();
        $mahasiswa = session('mahasiswa');
        return view('mahasiswa.pengajuan_kp.pilihDosbing', compact('dosens', 'mahasiswa'));
    }

    public function formPengajuan()
    {
        $dosens = DosenPembimbing::all();
        $mahasiswa = session('mahasiswa');
        return view('mahasiswa.pengajuan_kp.formPengajuan', compact('dosens', 'mahasiswa'));
    }

    public function storePengajuan(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kategori_bidang' => 'required|in:Web Development,Application Development,Game Development,Data Analysis,Data Science,Artificial Intelligence,Graphic Design,Networking',
            'judul' => 'required|string',
            'perusahaan' => 'required|string',
            'posisi' => 'required|string',
            'deskripsi' => 'required|string',
            'durasi' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->route('formPengajuan')
                ->withErrors($validator)
                ->withInput();
        }

        $mahasiswa = Mahasiswa::create([
            'kategori_bidang' => $request->kategori_bidang,
            'judul' => $request->judul,
            'perusahaan' => $request->perusahaan,
            'posisi' => $request->posisi,
            'deskripsi' => $request->deskripsi,
            'durasi' => $request->durasi,
        ]);
        
        return redirect()->route('draftKP')->with('success', 'Data Mahasiswa Berhasil Ditambahkan')->with('mahasiswa', $mahasiswa);
    }

    public function storePenyelia(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string',
            'posisi' => 'required|string',
            'departemen' => 'required|string',
            'perusahaan' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->route('tambah_penyelia')
                ->withErrors($validator)
                ->withInput();
        }

        $penyelia = Penyelia::create([
            'nama' => $request->nama,
            'posisi' => $request->posisi,
            'departemen' => $request->departemen,
            'perusahaan' => $request->perusahaan,
        ]);
        
        return redirect()->route('detail')->with('success', 'Profil Penyelia Berhasil Ditambahkan')->with('penyelia', $penyelia);
    }

    public function draft_kp()
    {
        $dosens = DosenPembimbing::all();
        $mahasiswa = session('mahasiswa');
        // dd($mahasiswa);
        return view('mahasiswa.pengajuan_kp.draftPengajuan', compact('dosens', 'mahasiswa'));
    }

    public function review_penyelia()
    {
        return view('mahasiswa.review_penyelia.');
    }
}
