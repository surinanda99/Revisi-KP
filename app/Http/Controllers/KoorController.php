<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Mahasiswa;
use App\Imports\DosenImport;
use Illuminate\Http\Request;
use App\Models\DosenPembimbing;
use App\Exports\ExportMahasiswa;
use App\Imports\MahasiswaImport;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Validator;

class KoorController extends Controller
{
    public function daftar_data_dosen()
    {
        // $dosens = DosenPembimbing::all();
        $dosens = DosenPembimbing::with(['dosen', 'dosen.pengajuan'])->get();
        return view('koor.data_dosen.data_dosen', compact('dosens'));
    }

    public function storeDosen(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'npp' => 'required|string',
            'nama' => 'required|string',
            'bidang_kajian' => 'required|in:RPLD,SC',
            'kuota' => 'required|integer',
            'email' => 'required|nullable|email',
            'telp' => 'required|nullable|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Simpan data dosen
        $dosen = Dosen::create([
            'nama' => $request->nama,
            'npp' => $request->npp,
            'email' => $request->email, // Pastikan email dosen ada jika diperlukan
            'bidang_kajian' => $request->bidang_kajian,
            'telp' => $request->telp, // Pastikan nomor telepon ada jika diperlukan
        ]);

        // DosenPembimbing::create([
        //     'id_dsn' => $request->id_dsn,
        //     'npp' => $request->npp,
        //     'nama' => $request->nama,
        //     'bidang_kajian' => $request->bidang_kajian,
        //     'kuota' => $request->kuota,
        // ]);

        // Simpan data dosen pembimbing
        DosenPembimbing::create([
            'id_dsn' => $dosen->id,
            'kuota' => $request->kuota,
        ]);

        return redirect()->back()->with('success', 'Data Dosen Pembimbing Berhasil Ditambahkan.');
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
        // $dosen = DosenPembimbing::find($id);
        $dosen = DosenPembimbing::with('dosen')->findOrFail($id);
        return response()->json($dosen);
    }

    public function updateDosen(Request $request, $id)
    {
        // Validasi data yang diterima dari formulir
        $validator = Validator::make($request->all(), [
            'npp' => 'required|string',
            'nama' => 'required|string',
            'bidang_kajian' => 'required|in:RPLD,SC',
            'kuota' => 'required|integer',
            'email' => 'nullable|email',
            'telp' => 'nullable|string',
        ]);

        // Jika validasi gagal, kembalikan respons dengan pesan kesalahan
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Temukan dosen yang akan diperbarui
        $dosen = DosenPembimbing::findOrFail($id);

        // Perbarui data dosen
        $dosen->dosen->update([
            'nama' => $request->input('nama'),
            'npp' => $request->input('npp'),
            'email' => $request->input('email'),
            'bidang_kajian' => $request->input('bidang_kajian'),
            'telp' => $request->input('telp'),
        ]);

        // Update data dosen pembimbing
        $dosen->update([
            'kuota' => $request->input('kuota'),
        ]);

        // Perbarui data dosen
        // $dosen->update([
        //     'npp' => $request->input('npp'),
        //     'nama' => $request->input('nama'),
        //     'bidang_kajian' => $request->input('bidang_kajian'),
        //     'kuota' => $request->input('kuota'),
        // ]);

        // Redirect kembali dengan pesan sukses
        return redirect()->back()->with('success', 'Data Dosen Pembimbing Berhasil Diperbarui.');
    }

    public function deleteDosen($id)
    {
        $dosen = DosenPembimbing::find($id);
        $dosen->delete();

        return redirect()->back()->with('success', 'Dosen Berhasil Dihapus');
    }

    public function daftar_mhs()
    {
        $mahasiswas = Mahasiswa::all();
        return view('koor.data_mahasiswa.data_mahasiswa', compact('mahasiswas'));
    }

    public function storeMhs(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nim' => 'required|unique:mahasiswas',
            'nama' => 'required|string',
            // 'ipk' => 'required',
            // 'telp_mhs' => 'required',
            'email' => 'required|email|unique:mahasiswas',
            'dosen_wali' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        Mahasiswa::create([
            'nim' => $request->nim,
            'nama' => $request->nama,
            // 'ipk' => $request->ipk,
            // 'telp_mhs' => $request->telp_mhs,
            'email' => $request->email,
            'dosen_wali' => $request->dosen_wali,
        ]);

        return redirect()->route('halamanKoorMhs')->with('success', 'Data Mahasiswa Berhasil Ditambahkan');
    }

    public function importMhs(Request $request)
    {
        $request->validate([
            'import' => 'required|file|mimes:xlsx,xls,csv',
        ]);

        DB::beginTransaction();
        try {
            Excel::import(new MahasiswaImport, $request->file('import'));
            DB::commit();

            return redirect()->route('halamanKoorMhs')->with('success', 'Data Mahasiswa Berhasil Diimport.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Import Error: ' . $e->getMessage());
            return redirect()->route('halamanKoorMhs')->with('error', 'Data Mahasiswa Gagal Diimport. Error: ' . $e->getMessage());
        }
    }

    public function editMhs($id)
    {
        $mahasiswas = Mahasiswa::find($id);
        return view('koor.data_mahasiswa.edit_mhs', compact('mahasiswas'));
    }

    public function updateMhs(Request $request, $id)
    {
        // Validasi data yang diterima dari formulir
        $validator = Validator::make($request->all(), [
            'nim' => 'required',
            'nama' => 'required',
            'ipk' => 'required',
            'telp_mhs' => 'required',
            'email' => 'required',
            'dosen_wali' => 'required',
        ]);

        // Jika validasi gagal, kembalikan respons dengan pesan kesalahan
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Temukan dosen yang akan diperbarui
        $mahasiswas = Mahasiswa::findOrFail($id);

        // Perbarui data dosen
        $mahasiswas->update([
            'nim' => $request->input('nim'),
            'nama' => $request->input('nama'),
            'ipk' => $request->input('ipk'),
            'telp_mhs' => $request->input('telp_mhs'),
            'email' => $request->input('email'),
            'dosen_wali' => $request->input('dosen_wali'),
        ]);

        // Redirect kembali dengan pesan sukses
        return redirect()->back()->with('success', 'Data Mahasiswa berhasil diperbarui.');
    }

    public function deleteMhs($id)
    {
        $mahasiswas = Mahasiswa::find($id);
        $mahasiswas->delete();

        return redirect()->back()->with('success', 'Mahasiswa Berhasil Dihapus');
    }

    public function penyeliaMhs()
    {

    }

    public function dashboard()
    {
        return view('koor.dashboard');
    }
}
