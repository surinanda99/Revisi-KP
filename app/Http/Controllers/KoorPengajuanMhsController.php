<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Mahasiswa;
use App\Models\Pengajuan;
use App\Models\StatusDosen;
use Illuminate\Http\Request;
use App\Models\StatusMahasiswa;
use illuminate\Support\Facades\Log;


class KoorPengajuanMhsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dosen = Dosen::where('email', auth()->user()->email)->first();

        // Ambil data pengajuan yang belum ditolak
        $pengajuan = Pengajuan::with('mahasiswa.statusMahasiswa')
            ->where('id_dsn', $dosen->id)
            ->where('status', 'PENDING')
            ->get();

        return view('koor.pengajuan_mhs.daftar_mhs', compact('pengajuan'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        try {
            dd($request->all());
            $pengajuan = Pengajuan::findOrFail($request->id);

            $dsnStatus = StatusDosen::where('id_dsn', $pengajuan->id_dsn)->first();

            if ($request->status == 'TOLAK') {
                $pengajuan->status = $request->status;
                $pengajuan->save();

                $dsnStatus->ajuan--;
                $dsnStatus->save();

                // activity()
                //     ->inLog('pengajuan')
                //     ->causedBy(auth()->user())
                //     ->performedOn($pengajuan)
                //     ->withProperties(['id_mhs' => $pengajuan->id_mhs])
                //     ->log('Menolak pengajuan pengajuan');

                return response()->json(['status' => 'success', 'message' => 'Pengajuan berhasil ditolak']);
            } else {
                $status = StatusMahasiswa::findOrFail($pengajuan->id_mhs);
                $status->id_dsn = $pengajuan->id_dsn;
                $status->save();
                $pengajuan->status = $request->status;
                $pengajuan->save();

                $dsnStatus->ajuan--;
                $dsnStatus->diterima++;
                $dsnStatus->sisa = $dsnStatus->kuota - $dsnStatus->diterima;

                $dsnStatus->save();

                // activity()
                //     ->inLog('pengajuan')
                //     ->causedBy(auth()->user())
                //     ->performedOn($pengajuan)
                //     ->withProperties(['id_mhs' => $pengajuan->id_mhs])
                //     ->log('Update status pengajuan');

                return redirect()->route('mahasiswa-bimbingan');
            }
        } catch (\Exception $e) {
            Log::error($e); // Logging error
            return response()->json(['status' => 'error', 'message' => 'Terjadi kesalahan'], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
