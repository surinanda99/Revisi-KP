<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\Pengajuan;
use Illuminate\Http\Request;
use App\Models\DosenPembimbing;
use App\Models\Penyelia;
use App\Models\DetailPenilaian;
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

    public function profil()
    {
        $user = Auth::user();
        $mahasiswa = Mahasiswa::where('email', $user->email)->first();
        return view('mahasiswa.profil_mhs.profil_mhs', compact('mahasiswa'));
    }

    public function profile_penyelia()
    {
        return view('mahasiswa.review_penyelia.tambah_penyelia');
    }

    public function tambah_penyelia(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string',
            'posisi' => 'required|string',
            'departemen' => 'required|string',
            'perusahaan' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        Penyelia::create([
            'nama' => $request->nama,
            'posisi' => $request->posisi,
            'departemen' => $request->departemen,
            'perusahaan' => $request->perusahaan,
        ]);

        return redirect()->route('detail_penilaian'); 
    }

    public function detail_penilaian()
    {
        return view('mahasiswa.review_penyelia.detail_penilaian');
    }

    public function store_detail_penilaian(Request $request)
    {
        $validatedData = $request->validate([
            'deskripsi_pekerjaan' => 'required|string|max:1000',
            'prestasi_kontribusi' => 'required|string|max:1000',
            'keterampilan_kemampuan' => 'required|string|max:1000',
            'kerjasama_keterlibatan' => 'required|string|max:1000',
            'komentar' => 'nullable|string|max:1000',
            'perkembangan' => 'required|string|max:1000',
            'kesimpulan_saran' => 'required|string|max:1000',
            'score' => 'required|numeric|min:0|max:100',
            'file' => 'nullable|file|mimes:pdf,doc,docx,txt|max:2048',
            'penyelia_id' => 'required|exists:penyelias,id', // Ensure penyelia_id exists in penyelias table
        ]);

        $file = $request->file('file');
        $fileName = time() . '_' . $file->getClientOriginalName();
        $file->move('storage/penilaian', $fileName);

        // Assuming 'mahasiswa_id' is available, replace '1' with the actual 'mahasiswa_id' value
        $mahasiswaId = 1; // Replace with the actual 'mahasiswa_id'

        DetailPenilaian::create([
            'deskripsi_pekerjaan' => $validatedData['deskripsi_pekerjaan'],
            'prestasi_kontribusi' => $validatedData['prestasi_kontribusi'],
            'keterampilan_kemampuan' => $validatedData['keterampilan_kemampuan'],
            'kerjasama_keterlibatan' => $validatedData['kerjasama_keterlibatan'],
            'komentar' => $validatedData['komentar'],
            'perkembangan' => $validatedData['perkembangan'],
            'kesimpulan_saran' => $validatedData['kesimpulan_saran'],
            'score' => $validatedData['score'],
            'file_path' => '/storage/penilaian/' . $fileName,
            'mahasiswa_id' => $mahasiswaId,
            'penyelia_id' => $validatedData['penyelia_id'], // Ensure penyelia_id is provided and valid
        ]);

        return redirect()->route('draft_review');
    }

    public function draft_review()
    {
        $penyelia = Penyelia::all();
        $detailPenilaian = detailPenilaian::all();
        return view('mahasiswa.review_penyelia.draft_penilaian', compact('penyelia', 'detailPenilaian'));
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