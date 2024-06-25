<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\Pengajuan;
use Illuminate\Http\Request;
use App\Models\DosenPembimbing;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class MahasiswaController extends Controller
{
    public function index()
    {
        $mahasiswa = Auth::user()->mahasiswa;
        return view('mahasiswa.dashboard', compact('mahasiswa'));
    }

    public function pengajuan_kp()
    {
        $dosens = DosenPembimbing::all();
        return view('mahasiswa.pengajuan_kp.pengajuan_kp', compact('dosens'));
    }

    public function pilih_dosbing()
    {
        $dosens = DosenPembimbing::all();
        return view('mahasiswa.pengajuan_kp.pilihDosbing', compact('dosens'));
    }

    public function formPengajuan()
    {
        return view('mahasiswa.pengajuan_kp.formPengajuan');
    }

    public function storePengajuan(Request $request)
    {
        dd($request->mahasiswa_id);
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

        $pengajuan = Pengajuan::create([
            'mahasiswa_id' => $request->mahasiswa_id,
            'kategori_bidang' => $request->kategori_bidang,
            'judul' => $request->judul,
            'perusahaan' => $request->perusahaan,
            'posisi' => $request->posisi,
            'deskripsi' => $request->deskripsi,
            'durasi' => $request->durasi,
        ]);
        
        // arahkan ke halaman draftPengajuan dengan mengirimkan parameter $id
        return redirect()->route('draftKP', ['id' => $request->mahasiswa_id])
            ->with('success', 'Data Mahasiswa Berhasil Ditambahkan');
    }

    public function draft_kp($id)
    {
        $pengajuan = Pengajuan::where('mahasiswa_id', $id)->first();
        return view('draftPengajuan', compact('pengajuan'));
    }

    public function updatePengajuan(Request $request, $id)
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
            return redirect()->route('draftKP', ['id' => $id])
                        ->withErrors($validator)
                        ->withInput();
        }

        $pengajuan = Pengajuan::find($id);
        $pengajuan->update([
            'kategori_bidang' => $request->kategori_bidang,
            'judul' => $request->judul,
            'perusahaan' => $request->perusahaan,
            'posisi' => $request->posisi,
            'deskripsi' => $request->deskripsi,
            'durasi' => $request->durasi,
        ]);

        // arahkan ke halaman draftPengajuan dengan mengirimkan parameter $id
        return redirect()->route('draftKP', ['id' => $pengajuan->mahasiswa_id])
            ->with('success', 'Data Mahasiswa Berhasil Diperbarui');
    }

    public function deletePengajuan()
    {
        session()->forget('pengajuan');
        return redirect()->route('formPengajuan')->with('success', 'Pengajuan berhasil dihapus');
    }

    // public function submitPengajuan()
    // {
    //     $pengajuan = session('pengajuan');
    //     // Simpan pengajuan ke database, misal:
    //     // $pengajuan->save();

    //     // Hapus dari session setelah disimpan
    //     session()->forget('pengajuan');

    //     return redirect()->route('dashboardMahasiswa')->with('success', 'Pengajuan berhasil diajukan ke dosen');
    // }

    public function logbook()
    {
        return view('mahasiswa.logbook_kp.logbook_kp');
    }

    public function review_penyelia()
    {
        return view('mahasiswa.review_penyelia.review_penyelia');
    }

    public function profil()
    {
        $user = Auth::user();
        $mahasiswa = Mahasiswa::where('email', $user->email)->first();
        return view('mahasiswa.profil_mhs.profil_mhs', compact('mahasiswa'));
    }

    public function riwayat()
    {
        return view('mahasiswa.riwayat_pengajuan.riwayat_pengajuan');
    }

    public function datadiri()
    {
        return view('mahasiswa.profil');
    }

    public function penilaian_sidang()
    {
        return view('mahasiswa.pengajuan_sidang.pengajuan_sidang');
    }
}