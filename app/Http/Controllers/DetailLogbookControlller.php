<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DetailPenilaian;
use App\Models\LogbookBimbingan;


class DetailLogbookControlller extends Controller
{
    public function show($id_logbook)
    {
        // Menampilkan detail logbook dari tabel logbook berdasarkan id logbook
        $logbook = LogbookBimbingan::find($id_logbook);
        return response()->json($logbook);
    }

    public function update(Request $request)
    {
        $data = $request->all();
        $logbook = LogbookBimbingan::findOrFail($data['id_logbook']);
        $logbook->update($data);

        // activity()
        //     ->inLog('logbook')
        //     ->causedBy(auth()->user())
        //     ->subject($logbook)
        //     ->log('mengubah logbook');

        // return redirect()->route('mahasiswa-logbook');
    }

    public function review_penyelia()
    {
        $detail_penilaians = DetailPenilaian::with(['mahasiswa', 'penyelia'])->get();
        return view('dosen.review_penyelia_mhs.review_penyelia_mhs', compact('detail_penilaians'));
    }
}
