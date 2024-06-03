<?php

namespace App\Http\Controllers;

use App\Models\DosenPembimbing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Imports\DosenImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class KoorController extends Controller
{
    public function daftar_data_dosen()
    {
        $dosens = DosenPembimbing::all();
        return view('koor.data_dosen.data_dosen', compact('dosens'));
    }

    public function addDosen()
    {
        return view('koor.data_dosen.tambah_dosen');
    }

    public function storeDosen(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'npp' => 'required|string',
            'nama' => 'required|string',
            'bidang_kajian' => 'required|in:RPLD,SC',
            'kuota' => 'required|integer',
            'jumlah_ajuan' => 'required|integer',
            'ajuan_diterima' => 'required|integer',
            'sisa_kuota' => 'required|integer',
            'status' => 'required|in:Penuh,Tersedia',
        ]);

        if ($validator->fails()) {
            return redirect()->route('tambahDosen')
                ->withErrors($validator)
                ->withInput();
        }

        DosenPembimbing::create([
            'npp' => $request->npp,
            'nama' => $request->nama,
            'bidang_kajian' => $request->bidang_kajian,
            'kuota' => $request->kuota,
            'jumlah_ajuan' => $request->jumlah_ajuan,
            'ajuan_diterima' => $request->ajuan_diterima,
            'sisa_kuota' => $request->sisa_kuota,
            'status' => $request->status,
        ]);

        return redirect()->route('HalamanKoorDosen')->with('success', 'Data Dosen Pembimbing Berhasil Ditambahkan');
    }

    public function importDosen(Request $request)
    {
        $request->validate([
            'import' => 'required|file|mimes:xlsx,xls,csv',
        ]);

        DB::beginTransaction();
        try {
            Excel::import(new DosenImport, $request->file('import'));
            DB::commit();

            return redirect()->route('HalamanKoorDosen')->with('success', 'Data Dosen Berhasil Diimport.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Import Error: ' . $e->getMessage());
            return redirect()->route('HalamanKoorDosen')->with('error', 'Data Dosen Gagal Diimport. Error: ' . $e->getMessage());
        }
    }

    public function editDosen($id)
    {
        $dosen = DosenPembimbing::find($id);
        return view('koor.data_dosen.edit_dosen', compact('dosen'));
    }

    public function updateDosen(Request $request, $id)
    {
        // Validasi data yang diterima dari formulir
        $validator = Validator::make($request->all(), [
            'kuota' => 'required',
            'jumlah_ajuan' => 'required',
        ]);

        // Jika validasi gagal, kembalikan respons dengan pesan kesalahan
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Temukan dosen yang akan diperbarui
        $dosen = DosenPembimbing::findOrFail($id);

        // Perbarui data dosen
        $dosen->update([
            'kuota' => $request->input('kuota'),
            'jumlah_ajuan' => $request->input('jumlah_ajuan'),
        ]);

        // Redirect kembali dengan pesan sukses
        return redirect()->back()->with('success', 'Data dosen berhasil diperbarui.');
    }

    public function deleteDosen($id)
    {
        $dosen = DosenPembimbing::find($id);
        $dosen->delete();

        return redirect()->back()->with('success', 'Dosen Berhasil Dihapus');
    }



    public function daftar_mhs()
    {
        return view('koor.data_mahasiswa.data_mahasiswa');
    }
}
