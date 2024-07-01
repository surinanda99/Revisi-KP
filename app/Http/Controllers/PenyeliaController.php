<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mahasiswa;
use App\Models\Penyelia;
use App\Models\StatusMahasiswa;

class PenyeliaController extends Controller
{
    public function store(Request $request)
    {
        // Validasi data yang diterima
        $request->validate([
            'nama' => 'required|string|max:255',
            'posisi' => 'required|string|max:255',
            'departemen' => 'required|string|max:255',
            'perusahaan' => 'required|string|max:255',
            'deskripsi_pekerjaan' => 'nullable|string',
            'prestasi_kontribusi' => 'nullable|string',
            'keterampilan_kemampuan' => 'nullable|string',
            'kerjasama_keterlibatan' => 'nullable|string',
            'komentar' => 'nullable|string',
            'perkembangan' => 'nullable|string',
            'kesimpulan_saran' => 'nullable|string',
            'score' => 'nullable|integer',
            'file' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
        ]);

         // Upload file jika ada
         $filePath = null;
         if ($request->hasFile('file')) {
             $filePath = $request->file('file')->store('uploads', 'public');
         }

         // Simpan data ke database
        Penyelia::create([
            'nama' => $request->input('nama'),
            'posisi' => $request->input('posisi'),
            'departemen' => $request->input('departemen'),
            'perusahaan' => $request->input('perusahaan'),
            'deskripsi_pekerjaan' => $request->input('deskripsi_pekerjaan'),
            'prestasi_kontribusi' => $request->input('prestasi_kontribusi'),
            'keterampilan_kemampuan' => $request->input('keterampilan_kemampuan'),
            'kerjasama_keterlibatan' => $request->input('kerjasama_keterlibatan'),
            'komentar' => $request->input('komentar'),
            'perkembangan' => $request->input('perkembangan'),
            'kesimpulan_saran' => $request->input('kesimpulan_saran'),
            'score' => $request->input('score'),
            'file_path' => $filePath,
        ]);

        // Redirect atau berikan respons sukses
        return redirect()->back()->with('success', 'Data berhasil disimpan');
    }

    public function PenyeliaForm(){
        $mhs = Mahasiswa::where('email', auth()->user()->email)->first();
        $status = StatusMahasiswa::where('id_mhs', $mhs->id)->first();

        // Cek apakah mahasiswa sudah menyelesaikan KP
        if ($status) {
            return view('mahasiswa.review_penyelia.tambah_penyelia', compact('status'));
        } else {
            return redirect()->route('halaman_kp')->with('error', 'Anda belum menyelesaikan Kerja Praktek.');
        }
    }

    public function StorePenyelia(){
        $mhs = Mahasiswa::where('email', auth()->user()->email)->first();
        $status = StatusMahasiswa::where('id_mhs', $mhs->id)->first();

        // Cek apakah mahasiswa sudah menyelesaikan KP
        if (!$status->kp_selesai) {
            return redirect()->route('halaman_kp')->with('error', 'Anda belum menyelesaikan Kerja Praktek.');
        }
    }



}
