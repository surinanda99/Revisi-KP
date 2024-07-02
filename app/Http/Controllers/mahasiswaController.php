<?php

namespace App\Http\Controllers;

use App\Models\Penyelia;
use App\Models\Mahasiswa;
use App\Models\Pengajuan;
use Illuminate\Http\Request;
use App\Models\DetailPenilaian;
use App\Models\DosenPembimbing;
use App\Models\MahasiswaPenyelia;
use App\Models\tatusMahasiswa;
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
        $mhs = Mahasiswa::where('email', auth()->user()->email)->first();
        return view('mahasiswa.pengajuan_kp.pilihDosbing', compact('dosens', 'mhs'));
    }

    public function pilih_dosbing()
    {
        $dosens = DosenPembimbing::all();
        return view('mahasiswa.pengajuan_kp.pilihDosbing', compact('dosens'));
    }

    public function formPengajuan(Request $request)
    {
        $data = $request->all();
        $mhs = Mahasiswa::where('email', auth()->user()->email)->first();
        return view('mahasiswa.pengajuan_kp.formPengajuan', compact('data', 'mhs'));
    }

    public function storePengajuan(Request $request)
    {
        // dd($request->mahasiswa_id);
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
<<<<<<< HEAD
        $mhs = Mahasiswa::where('email', auth()->user()->email)->first();
=======
>>>>>>> a46af018206c3b014ef4e7975e3c94f43be92a5f

        // arahkan ke halaman draftPengajuan dengan mengirimkan parameter $id
        return redirect()->route('draftKP', ['id' => $mhs->id])
            ->with('success', 'Data Mahasiswa Berhasil Ditambahkan');
    }

    public function draft_kp(Request $request)
    {
        $mhs = Mahasiswa::where('email', auth()->user()->email)->first();
        $data = $request->all();
        if(empty($data)){
            $pengajuan = Pengajuan::where('id_mhs', $mhs)->first();
        } else {
            $pengajuan = $request->all();
        }
        return view('mahasiswa.pengajuan_kp.draftPengajuan', compact('mhs', 'pengajuan'));
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

        $mhs = Mahasiswa::where('email', auth()->user()->email)->first();

        // arahkan ke halaman draftPengajuan dengan mengirimkan parameter $id
        return redirect()->route('draftKP', ['id' => $mhs->id])
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

        $data = $request->all();

        // dd($data);

        $mhs = Mahasiswa::where('email', auth()->user()->email)->first();
        $penyelia = Penyelia::where('nama', $request->nama)->first();

        return view('mahasiswa.review_penyelia.detail_penilaian', compact('data', 'mhs', 'penyelia'));
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
        ]);

        $data = $request->all();

        // dd($request);

        // Check if file is uploaded
        // if ($request->hasFile('file')) {
        //     $file = $request->file('file');
        //     $fileName = time() . '_' . $file->getClientOriginalName();
        //     $filePath = 'storage/penilaian';

        //     // Create directory if it doesn't exist
        //     if (!file_exists($filePath)) {
        //         mkdir($filePath, 0777, true);
        //     }

        //     $file->move($filePath, $fileName);
        //     $fileFullPath = '/' . $filePath . '/' . $fileName;
        // } else {
        //     $fileFullPath = null;
        // }

        return view('mahasiswa.review_penyelia.draft_penilaian', compact('data'));
    }

    // public function draft_review()
    // {
    //     $penyelia = Penyelia::all();
    //     $detailPenilaian = detailPenilaian::all();
    //     return view('mahasiswa.review_penyelia.draft_penilaian', compact('penyelia', 'detailPenilaian'));
    // }

    public function submit_review(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string',
            'posisi' => 'required|string',
            'departemen' => 'required|string',
            'perusahaan' => 'required|string',
            'deskripsi_pekerjaan' => 'required|string|max:1000',
            'prestasi_kontribusi' => 'required|string|max:1000',
            'keterampilan_kemampuan' => 'required|string|max:1000',
            'kerjasama_keterlibatan' => 'required|string|max:1000',
            'komentar' => 'nullable|string|max:1000',
            'perkembangan' => 'required|string|max:1000',
            'kesimpulan_saran' => 'required|string|max:1000',
            'score' => 'required|numeric|min:0|max:100',
            'file' => 'nullable|file|mimes:pdf,doc,docx,txt|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $file = $request->file('file')->store('assets/file', 'public');

        DetailPenilaian::create([
            'deskripsi_pekerjaan' => $request->deskripsi_pekerjaan,
            'prestasi_kontribusi' => $request->prestasi_kontribusi,
            'keterampilan_kemampuan' => $request->keterampilan_kemampuan,
            'kerjasama_keterlibatan' => $request->kerjasama_keterlibatan,
            'komentar' => $request->komentar,
            'perkembangan' => $request->perkembangan,
            'kesimpulan_saran' => $request->kesimpulan_saran,
            'score' => $request->score,
            'file_path' => $request->file,
            'mahasiswa_id' => $request->mhs,
            'penyelia_id' => $request->penyelia,
        ]);

        MahasiswaPenyelia::create([
            'mahasiswaId' => $request->mhs,
            'penyeliaId' => $request->penyelia,
        ]);

        return redirect()->route('dashboardMahasiswa');
    }

    public function riwayat()
    {
        return view('mahasiswa.riwayat_pengajuan.riwayat_pengajuan');
    }

    public function datadiri()
    {
        $mhs = Mahasiswa::where('email', auth()->user()->email)->first();
        return view('mahasiswa.profil', compact('mhs'));
    }

    public function penilaian_sidang()
    {
        return view('mahasiswa.pengajuan_sidang.pengajuan_sidang');
    }
}
