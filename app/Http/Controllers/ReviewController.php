<?php

namespace App\Http\Controllers;

use App\Models\ProfilPenyelia;
use App\Models\DetailPenilaian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ReviewController extends Controller
{
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'posisi' => 'required|string|max:255',
            'departemen' => 'required|string|max:255',
            'perusahaan' => 'required|string|max:255',
            'deskripsi_pekerjaan' => 'required|string',
            'prestasi_kontribusi' => 'required|string',
            'keterampilan_kemampuan' => 'required|string',
            'kerjasama_keterlibatan' => 'required|string',
            'komentar' => 'nullable|string',
            'perkembangan' => 'required|string',
            'kesimpulan_saran' => 'nullable|string',
            'score' => 'required|integer',
            'file' => 'nullable|file|max:2048',
        ]);

        $profilPenyelia = ProfilPenyelia::create([
            'nama' => $request->nama,
            'posisi' => $request->posisi,
            'departemen' => $request->departemen,
            'perusahaan' => $request->perusahaan,
        ]);

        $filePath = null;
        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('uploads');
        }

        DetailPenilaian::create([
            'profil_penyelia_id' => $profilPenyelia->id,
            'deskripsi_pekerjaan' => $request->deskripsi_pekerjaan,
            'prestasi_kontribusi' => $request->prestasi_kontribusi,
            'keterampilan_kemampuan' => $request->keterampilan_kemampuan,
            'kerjasama_keterlibatan' => $request->kerjasama_keterlibatan,
            'komentar' => $request->komentar,
            'perkembangan' => $request->perkembangan,
            'kesimpulan_saran' => $request->kesimpulan_saran,
            'score' => $request->score,
            'file_path' => $filePath,
        ]);

        return redirect()->back()->with('success', 'Review submitted successfully.');
    }
}
