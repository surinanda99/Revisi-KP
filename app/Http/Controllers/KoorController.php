<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Dosen;
use App\Models\Mahasiswa;
use App\Models\Pengajuan;
use App\Imports\DosenImport;
use Illuminate\Http\Request;
use App\Models\DetailPenilaian;
use App\Models\DosenPembimbing;
use App\Models\StatusMahasiswa;
// use Spatie\Permission\Models\Role;
use App\Exports\ExportMahasiswa;
use App\Imports\MahasiswaImport;
use App\Models\LogbookBimbingan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Exports\TemplateDosenExport;
use Maatwebsite\Excel\Facades\Excel;
use Spatie\Activitylog\Models\Activity;
use App\Exports\TemplateMahasiswaExport;
use Illuminate\Support\Facades\Validator;

class KoorController extends Controller
{
    public function index()
    {
        // $role = Role::where('name', 'dosen')->first();
        // $dosenIds = $role->users->pluck('id');

        // $activities = Activity::whereIn('causer_id', $dosenIds)
        //     ->with('causer.dosen')
        //     ->get();

        // $user = User::where('email', auth()->user()->email)->first();

        // $activities = Activity::where('causer_id', $user->id)
        //     ->get();

        $mahasiswa = Mahasiswa::all();
        $dosen = Dosen::with('dosen')->get();
        // $dosen = Dosen::with('dosenPeriodik.status')->get();

        // Menghitung jumlah mahasiswa yang telah menyelesaikan setiap bab
        $logbooks = LogbookBimbingan::selectRaw('bab, COUNT(*) as total')
            ->groupBy('bab')
            ->orderBy('bab')
            ->get()
            ->keyBy('bab');

        return view('koor.dashboard', compact('mahasiswa', 'dosen', 'logbooks'));
    }

    public function daftar_data_dosen()
    {
        // $dosens = DosenPembimbing::all();
        $dosens = DosenPembimbing::with(['dosen', 'dosen.pengajuan'])->get();

        foreach ($dosens as $dosen) {
            // Calculate the number of accepted applications for each DosenPembimbing
            $dosen->ajuan_diterima = $dosen->dosen->pengajuan()->where('status', 'ACC')->count();

            // Calculate the remaining quota
            $dosen->sisa_kuota = $dosen->kuota - $dosen->ajuan_diterima;
        }

        return view('koor.data_dosen.data_dosen', compact('dosens'));
    }

    public function storeDosen(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'npp' => 'required|string',
            'nama' => 'required|string',
            'bidang_kajian' => 'required|in:RPLD,SC',
            'kuota' => 'required|integer',
            // 'email' => 'required|nullable|email',
            'telp' => 'required|nullable|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Simpan data dosen
        $dosen = Dosen::create([
            'nama' => $request->nama,
            'npp' => $request->npp,
            // 'email' => $request->email, // Pastikan email dosen ada jika diperlukan
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

        $user = User::create([
            'nim' => null,
            'npp' => $request->npp,
            'password' => bcrypt('Dinus-123')
        ]);

        $user->assignRole('dosen');

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

    public function downloadTemplateDosen()
    {
        return Excel::download(new TemplateDosenExport, 'template_dosen.xlsx');
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
            // 'kuota' => 'required|integer',
            // 'email' => 'nullable|email',
            'telp' => 'nullable|string',
        ]);

        // Jika validasi gagal, kembalikan respons dengan pesan kesalahan
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Temukan dosen yang akan diperbarui
        $dosen = DosenPembimbing::findOrFail($id);

        $nppLama = $dosen->dosen->npp;

        // Perbarui data dosen
        $dosen->dosen->update([
            'nama' => $request->input('nama'),
            'npp' => $request->input('npp'),
            'email' => $request->input('email'),
            'bidang_kajian' => $request->input('bidang_kajian'),
            'telp' => $request->input('telp'),
        ]);

        // Temukan user yang akan diperbarui
        $user = User::where('npp', $nppLama)->first();

        // Jika user ditemukan, perbarui data user
        if ($user) {
            $user->update([
                'npp' => $request->input('npp'),
                'email' => $request->input('email'),
            ]);
        } else {
            // Jika user tidak ditemukan, tambahkan pesan kesalahan
            return redirect()->back()->with('error', 'User dengan NPP tersebut tidak ditemukan.');
        }

        // Update data dosen pembimbing
        // $dosen->update([
        //     'kuota' => $request->input('kuota'),
        // ]);

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

    public function updateKuota(Request $request, $id)
    {
        // Validasi kuota
        $validator = Validator::make($request->all(), [
            'kuota' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        // Temukan dosen pembimbing yang akan diperbarui
        $dosen = DosenPembimbing::findOrFail($id);

        // Update kuota dosen
        $dosen->kuota = $request->input('kuota');

        // Hitung jumlah aplikasi diterima
        $ajuan_diterima = $dosen->dosen->pengajuan()->where('status', 'ACC')->count();

        // Update sisa kuota
        $sisa_kuota = max(0, $dosen->kuota - $ajuan_diterima); // Pastikan sisa kuota tidak negatif
        $dosen->sisa_kuota = $sisa_kuota;

        $dosen->save(); // Simpan perubahan

        // Redirect dengan pesan sukses
        return response()->json([
            'success' => 'Kuota berhasil diperbarui',
            'sisa_kuota' => $sisa_kuota,
        ]);
    }

    public function deleteDosen($id)
    {
        $dosen = Dosen::find($id);

        if ($dosen) {
            // Temukan data user yang terkait dengan dosen tersebut berdasarkan NPP
            $user = User::where('npp', $dosen->npp)->first();

            // Hapus data dosen pembimbing
            $dosenPembimbing = DosenPembimbing::where('id_dsn', $dosen->id)->first();
            if ($dosenPembimbing) {
                $dosenPembimbing->delete();
            }

            // Hapus data dosen
            $dosen->delete();

            // Jika data user ditemukan, hapus data user juga
            if ($user) {
                $user->delete();
            }

            return redirect()->back()->with('success', 'Dosen Berhasil Dihapus');
        }

        return redirect()->back()->with('error', 'Dosen Gagal Dihapus');
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
            // 'transkrip_nilai' => 'required',
            // 'telp_mhs' => 'required',
            'email' => 'required|email|unique:mahasiswas',
            // 'dosen_wali' => 'required|string',
            'status_kp' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $mahasiswa = Mahasiswa::create([
            'nim' => $request->nim,
            'nama' => $request->nama,
            // 'ipk' => $request->ipk,
            // 'transkrip_nilai' => $request->transkrip_nilai,
            // 'telp_mhs' => $request->telp_mhs,
            'email' => $request->email,
            // 'dosen_wali' => $request->dosen_wali,
            'status_kp' => $request->status_kp,
        ]);

        // Buat entri StatusMahasiswa
        StatusMahasiswa::create([
            'id_mhs' => $mahasiswa->id,
            'pengajuan' => 0,
        ]);

        // Update kuota dosen setelah menambah mahasiswa baru pada Koor
        // $dosenPembimbing = DosenPembimbing::find($request->id_dsn);
        // $dosenPembimbing->jumlah_ajuan += 1; // Tambah jumlah ajuan
        // $dosenPembimbing->sisa_kuota = $dosenPembimbing->kuota - $dosenPembimbing->jumlah_ajuan;
        // $dosenPembimbing->save();

        $user = User::create([
            'nim' => $request->nim,
            'npp' => null,
            'email' => $request->email,
            'password' => bcrypt('Dinus-123')
        ]);

        $user->assignRole('mahasiswa');

        return redirect()->route('halamanKoorMhs')->with('success', 'Data Mahasiswa Berhasil Ditambahkan');
    }

    public function simpanMhsKeDosen(Request $request)
    {
        $dosenId = $request->input('id_dsn');

        // Lanjutkan jika ID dosen benar
        $mahasiswaIds = $request->input('mahasiswa_id');
        $dosenPembimbing = DosenPembimbing::findOrFail($dosenId);

        foreach ($mahasiswaIds as $mahasiswaId) {
            if ($mahasiswaId) {
                // Cek apakah mahasiswa sudah ada di status_mahasiswas
                $statusMahasiswa = StatusMahasiswa::where('id_mhs', $mahasiswaId)->first();

                if ($statusMahasiswa) {
                    // Update jika mahasiswa sudah ada
                    $statusMahasiswa->update([
                        'id_dsn' => $dosenId,
                        'pengajuan' => 0, // Atur nilai lain yang sesuai
                    ]);
                } else {
                    // Tambahkan data baru jika mahasiswa belum ada
                    StatusMahasiswa::create([
                        'id_mhs' => $mahasiswaId,
                        'id_dsn' => $dosenId,
                        'pengajuan' => 0, // Atau sesuai kebutuhan
                    ]);

                    // Tambahkan jumlah ajuan dosen
                    $dosenPembimbing->jumlah_ajuan += 1;
                }

                // Kurangi sisa kuota
                $dosenPembimbing->sisa_kuota -= 1;
                $dosenPembimbing->save();
            }
        }

        return redirect()->back()->with('success', 'Mahasiswa berhasil ditambahkan atau diperbarui pada dosen pembimbing.');
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

    public function downloadTemplateMahasiswa()
    {
        return Excel::download(new TemplateMahasiswaExport, 'template_mahasiswa.xlsx');
    }

    // public function editMhs($id)
    // {
    //     $mahasiswas = Mahasiswa::find($id);
    //     return view('koor.data_mahasiswa.edit_mhs', compact('mahasiswas'));
    // }

    public function updateMhs(Request $request, $id)
    {
        // Validasi data yang diterima dari formulir
        $validator = Validator::make($request->all(), [
            'nim' => 'required',
            'nama' => 'required',
            // 'ipk' => 'required',
            // 'telp_mhs' => 'required',
            'email' => 'required',
            // 'dosen_wali' => 'required',
            'status_kp' => 'required',
        ]);

        // Jika validasi gagal, kembalikan respons dengan pesan kesalahan
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Temukan dosen yang akan diperbarui
        $mahasiswas = Mahasiswa::findOrFail($id);

        // Simpan nim lama untuk referensi pencarian user sebelum mengupdate mahasiswa
        $nimLama = $mahasiswas->nim;

        // Perbarui data dosen
        $mahasiswas->update([
            'nim' => $request->input('nim'),
            'nama' => $request->input('nama'),
            // 'ipk' => $request->input('ipk'),
            // 'telp_mhs' => $request->input('telp_mhs'),
            'email' => $request->input('email'),
            // 'dosen_wali' => $request->input('dosen_wali'),
            'status_kp' => $request->input('status_kp'),
        ]);

        // Temukan user yang terkait berdasarkan nim lama
        $user = User::where('nim', $nimLama)->first();

        // Jika user ditemukan, perbarui data user
        if ($user) {
            $user->update([
                'nim' => $request->input('nim'), // Update NIM baru
                'email' => $request->input('email'), // Update email baru
            ]);
        } else {
            // Jika user tidak ditemukan, tambahkan pesan kesalahan
            return redirect()->back()->with('error', 'User dengan NIM tersebut tidak ditemukan.');
        }

        // Redirect kembali dengan pesan sukses
        return redirect()->back()->with('success', 'Data Mahasiswa berhasil diperbarui.');
    }

    public function deleteMhs($id)
    {
        $mahasiswas = Mahasiswa::find($id);

        if ($mahasiswas) {
            // Temukan data user yang terkait dengan mahasiswa tersebut berdasarkan NIM
            $user = User::where('nim', $mahasiswas->nim)->first();

            // Hapus data mahasiswa
            $mahasiswas->delete();

            // Jika data user ditemukan, hapus data user juga
            if ($user) {
                $user->delete();
            }

            return redirect()->back()->with('success', 'Mahasiswa Berhasil Dihapus');

        }

        return redirect()->back()->with('error', 'Mahasiswa tidak ditemukan.');
    }

    public function penyeliaMhs()
    {
        // return view('koor.data_penyelia.data_penyelia');

        $detail_penilaians = DetailPenilaian::with('mahasiswa', 'penyelia')->get();

        return view('koor.data_penyelia.data_penyelia', compact('detail_penilaians'));
    }

    // public function dashboard()
    // {
    //     return view('koor.dashboard');
    // }

    public function updateReviewKoor(Request $request, $id)
    {
        $penilaian = DetailPenilaian::findOrFail($id); // Pastikan ini adalah model yang benar
        $penilaian->status = $request->status;
        $penilaian->save();

        return redirect()->back()->with('success', 'Review berhasil diperbarui.');
    }

    public function penilaian()
    {
        $detail_penilaians = DetailPenilaian::all();
        return view('koor.data_penyelia.data_penyelia', compact('detail_penilaians'));
    }

    public function daftar_penyelia()
    {
        // Fetch the penilaian data along with mahasiswa and penyelia relations
        $detail_penilaians = DetailPenilaian::with(['mahasiswa', 'penyelia'])->get();
        dd($detail_penilaians); // Check if the data is being fetched

        // Pass the data to the view
        return view('koor.data_penyelia.data_penyelia', compact('detail_penilaians'));
    }

    public function plotting(){
        return view('koor.plotting.plotting_dosen');
    }

    public function showDetailMhs()
    {
        $mahasiswas = Mahasiswa::with('statusMahasiswa.dospem')->get();

        return view('koor.detail_mhs', compact('mahasiswas'));
    }

    public function showDetailDosen($dosenId)
    {
        $dosen = DosenPembimbing::with('dosen')->findOrFail($dosenId);

        // Ambil mahasiswa yang belum memiliki dosen pembimbing
        $mahasiswas = Mahasiswa::doesntHave('statusMahasiswa')->get();

        return view('koor.data_dosen.detail', compact('dosen', 'mahasiswas'));
    }
}
