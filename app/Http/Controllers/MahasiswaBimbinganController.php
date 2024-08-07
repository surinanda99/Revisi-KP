<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Pengajuan;
use App\Models\LogbookBimbingan;
use App\Models\StatusMahasiswa;
use App\Models\StatusDosen;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

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

    public function update(Request $request)
{
    try {
        // Mengambil data pengajuan berdasarkan ID
        $pengajuan = Pengajuan::findOrFail($request->id);

        // Mengambil status dosen berdasarkan ID dosen yang terkait dengan pengajuan
        $dsnStatus = StatusDosen::where('id_dsn', $pengajuan->id_dsn)->first();

        // Menangani pengajuan yang ditolak
        if ($request->status == 'TOLAK') {
            $pengajuan->status = $request->status;
            $pengajuan->alasan = $request->alasan;
            $pengajuan->save();

            $dsnStatus->ajuan--;
            $dsnStatus->save();

            activity()
                ->inLog('pengajuans')
                ->causedBy(auth()->user())
                ->performedOn($pengajuan)
                ->withProperties(['id_mhs' => $pengajuan->id_mhs])
                ->log('Menolak pengajuan pengajuan');

            return response()->json(['status' => 'success', 'message' => 'Pengajuan berhasil ditolak']);
        } else {
            // Menangani pengajuan yang diterima
            $status = StatusMahasiswa::findOrFail($pengajuan->id_mhs);
            $status->id_dsn = $pengajuan->id_dsn;
            $status->save();
            $pengajuan->status = $request->status;
            $pengajuan->save();

            $dsnStatus->ajuan--;
            $dsnStatus->diterima++;
            $dsnStatus->sisa = $dsnStatus->kuota - $dsnStatus->diterima;

            $dsnStatus->save();

            activity()
                ->inLog('pengajuans')
                ->causedBy(auth()->user())
                ->performedOn($pengajuan)
                ->withProperties(['id_mhs' => $pengajuan->id_mhs])
                ->log('Update status pengajuan');

            return redirect()->route('mahasiswa-bimbingan');
        }
    } catch (\Exception $e) {
        // Logging error
        Log::error($e);

        // Mengembalikan respon JSON dengan pesan kesalahan
        return response()->json(['status' => 'error', 'message' => 'Terjadi kesalahan'], 500);
    }
}


    // public function update(Request $request)
    // {
    //     // Validasi input
    //     $request->validate([
    //         'id' => 'required|exists:logbook_bimbingans,id',
    //         'status' => 'required|in:ACC,TOLAK',
    //         'alasan' => 'required_if:status,TOLAK|string'
    //     ]);

    //     // Cari logbook bimbingan berdasarkan ID
    //     $logbook = LogbookBimbingan::findOrFail($request->id);
    //     $logbook->status = $request->status;

    //     // Jika statusnya TOLAK, simpan alasan penolakan
    //     if ($request->status === 'TOLAK') {
    //         $logbook->alasan = $request->alasan;
    //     }

    //     $logbook->save();

    //     // Update status mahasiswa
    //     $status = StatusMahasiswa::where('id_mhs', $logbook->id_mhs)->first();
    //     $status->status = $request->status;
    //     $status->save();

    //     // Dapatkan dosen yang sedang login
    //     $dsn = Dosen::where('email', auth()->user()->email)->first();

    //     // Log aktivitas (jika menggunakan package activity log)
    //     // activity()
    //     //     ->inLog('logbook')
    //     //     ->causedBy($dsn)
    //     //     ->performedOn($logbook)
    //     //     ->withProperties(['id_mhs' => $logbook->id_mhs])
    //     //     ->log('Update status logbook');

    //     return redirect()->route('dosbing-logbook')->with('success', 'Status logbook berhasil diperbarui.');
    // }

    // public function update(Request $request)
    // {
    //     $logbook = LogbookBimbingan::findOrFail($request->id_logbook);
    //     $logbook->status = $request->status;
    //     $logbook->save();
        

    //     $status = StatusMahasiswa::where('id_mhs', $logbook->id_mhs)->first();
    //     $status->status = $request->status;
    //     $status->save();

    //     $dsn = Dosen::where('email', auth()->user()->email)->first();

    //     // activity()
    //     //     ->inLog('logbook')
    //     //     ->causedBy($dsn)
    //     //     ->performedOn($logbook)
    //     //     ->withProperties(['id_mhs' => $logbook->id_mhs])
    //     //     ->log('Update status logbook');

    //     return redirect()->route('dosbing-logbook');
    // }

    // public function update(Request $request)
    // {
//         try {
// //            dd($request->all());
//             $pengajuan = Pengajuan::findOrFail($request->id);

//             $periode = Periode::where('status', 1)->first();
//             $dsnPeriod = DosenPeriodik::where('id_periode', $periode->id)->where('id_dsn', $pengajuan->id_dsn)->first();
//             $dsnStatus = StatusDosen::where('id_period', $dsnPeriod->id)->first();

//             if ($request->status == 'TOLAK') {
//                 $pengajuan->status = $request->status;
//                 $pengajuan->alasan = $request->alasan;
//                 $pengajuan->save();

//                 $dsnStatus->ajuan--;
//                 $dsnStatus->save();

//                 activity()
//                     ->inLog('pengajuan')
//                     ->causedBy(auth()->user())
//                     ->performedOn($pengajuan)
//                     ->withProperties(['id_mhs' => $pengajuan->id_mhs])
//                     ->log('Menolak pengajuan pengajuan');

//                 return response()->json(['status' => 'success', 'message' => 'Pengajuan berhasil ditolak']);
//             } else {
//                 $status = StatusMahasiswa::findOrFail($pengajuan->id_mhs);
//                 $status->id_dsn = $pengajuan->id_dsn;
//                 $status->save();
//                 $pengajuan->status = $request->status;
//                 $pengajuan->save();

//                 $dsnStatus->ajuan--;
//                 $dsnStatus->diterima++;
//                 $dsnStatus->sisa = $dsnStatus->kuota - $dsnStatus->diterima;

//                 $dsnStatus->save();

//                 activity()
//                     ->inLog('pengajuan')
//                     ->causedBy(auth()->user())
//                     ->performedOn($pengajuan)
//                     ->withProperties(['id_mhs' => $pengajuan->id_mhs])
//                     ->log('Update status pengajuan');

//                 return redirect()->route('mahasiswa-bimbingan');
//             }
//         } catch (\Exception $e) {
//             Log::error($e); // Logging error
//             return response()->json(['status' => 'error', 'message' => 'Terjadi kesalahan'], 500);
//         }

//        return redirect()->route('mahasiswa-bimbingan');
//    }

    

}
