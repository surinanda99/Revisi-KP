<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Dosen;
use App\Models\Mahasiswa;
use App\Models\Pengajuan;
use Illuminate\Http\Request;
use App\Models\DetailPenilaian;
use App\Models\DosenPembimbing;
use App\Models\PengajuanSidang;
use App\Models\StatusMahasiswa;
use App\Models\LogbookBimbingan;
use Spatie\Activitylog\Models\Activity;
use Illuminate\Support\Facades\DB;

class DosenPembimbingController extends Controller
{
    // public function index()
    // {
    //     $user = auth()->user();
    //     $dosen = Dosen::where('email', $user->email)->first();
    //     $logbook = LogbookBimbingan::where('id_dsn', $dosen->id_dospem)->paginate(10);
    //     $status = StatusMahasiswa::all();
    //     $mahasiswa = Mahasiswa::all();

    //     return view(
    //         'dosen.logbook_bimbingan.logbook_bimbingan_mhs',
    //         compact('dosen', 'logbook', 'status', 'mahasiswa')
    //     );
    // }

    // public function update(Request $request)
    // {
    //     $logbook = LogbookBimbingan::findOrFail($request->id_logbook);
    //     $logbook->status_logbook = $request->status;
    //     $logbook->save();

    //     return redirect()->back();
    // }

    // public function index()
    // {
    //     return view('dosen.dashboard');
    // }

    public function dashboard_dsn()
    {
        return view('dosen.dashboard');
    }

    public function daftar_mhs_bimbingan()
    {
        $user = auth()->user();
        $dosen = Dosen::where('email', $user->email)->first();
        $pengajuan = Pengajuan::where('id_dsn', $dosen->id)->with('mahasiswa')->get();
        return view('dosen.daftar_bimbingan.daftar_bimbingan', compact('pengajuan'));
    }

    public function update_pengajuan(Request $request)
    {
        $pengajuan = Pengajuan::findOrFail($request->id);
        
        if (!$pengajuan) {
            return redirect()->back()->with('error', 'Pengajuan tidak ditemukan.');
        }

        $pengajuan->status = $request->status;
        $pengajuan->save();
        
        $status = StatusMahasiswa::where('id_mhs', $pengajuan->id_mhs)->first();
        $status->id_dsn = $pengajuan->id_dsn;
        $status->save();

        return redirect()->back()->with('success', 'Status pengajuan berhasil diperbarui.');
    }

    // public function logbook_bimbingan_mhs()
    // {
    //     $status = StatusMahasiswa::with(['mahasiswa', 'dospem', 'pengajuan', 'sidang'])->get();
    //     $logbooks = LogbookBimbingan::with(['mahasiswa', 'dosen'])
    //             ->whereIn('id_mhs', $status->pluck('id_mhs'))->get();

    //     return view('dosen.logbook_bimbingan.logbook_bimbingan_mhs', compact('status', 'logbooks'));
    // }

    public function logbook_bimbingan_mhs()
    {
        $dosen = Dosen::where('email', auth()->user()->email)->first();
        $status = StatusMahasiswa::with('mahasiswa')->where('id_dsn', $dosen->id)->get();

        return view(
            'dosen.logbook_bimbingan.logbook_bimbingan_mhs',
            compact('dosen', 'status')
        );
    }

    // public function logbook_bimbingan_mhs()
    // {
    //     // Ambil semua status mahasiswa yang sudah diterima sebagai mahasiswa bimbingan
    //     $status = StatusMahasiswa::with(['mahasiswa'])
    //         ->whereNotNull('id_dsn') // Pastikan mahasiswa sudah diterima sebagai bimbingan
    //         ->get();

    //     // Ambil logbook hanya untuk mahasiswa yang sudah mengisi logbook
    //     $logbooks = LogbookBimbingan::with(['mahasiswa', 'dosen'])
    //         ->whereIn('id_mhs', $status->pluck('id_mhs'))
    //         ->whereNotNull('tanggal')  // Pastikan logbook sudah diisi
    //         ->get();

    //     // Ambil mahasiswa yang sudah mengisi logbook dan sudah diterima sebagai bimbingan
    //     $acceptedStudents = $status->pluck('id_mhs');
    //     $logbookEntries = LogbookBimbingan::whereIn('id_mhs', $acceptedStudents)
    //         ->whereNotNull('tanggal')
    //         ->get();

    //     // Ambil daftar mahasiswa yang sudah diterima dan sudah mengisi logbook
    //     $studentsWithLogbook = $acceptedStudents->intersect($logbookEntries->pluck('id_mhs'));

    //     // Filter status untuk mahasiswa yang sudah mengisi logbook
    //     $filteredStatus = $status->filter(function ($st) use ($studentsWithLogbook) {
    //         return $studentsWithLogbook->contains($st->id_mhs);
    //     });

    //     return view('dosen.logbook_bimbingan.logbook_bimbingan_mhs', [
    //         'status' => $filteredStatus,
    //         'logbooks' => $logbookEntries
    //     ]);
    // }

    public function detail($id)
    {
        $logbook = LogbookBimbingan::where('id_mhs', $id)->get();
        return response()->json($logbook);
    }

    public function update(Request $request)
    {
        $logbook = LogbookBimbingan::findOrFail($request->id_logbook);
        $logbook->status = $request->status;
        $logbook->save();

        $status = StatusMahasiswa::where('id_mhs', $logbook->id_mhs)->first();
        $status->status = $request->status;
        $status->save();

        activity()
            ->inLog('logbook')
            ->causedBy(auth()->user())
            ->performedOn($logbook)
            ->withProperties(['id_mhs' => $logbook->id_mhs])
            ->log('Update status logbook');

        return redirect()->route('pageLogbook')->with('success', 'Logbook Sudah Di ACC.');
        // return redirect()->route('pageLogbook');
        // return redirect()->back()->with('success', 'Logbook Sudah Di ACC.');
    }

    public function show($id)
    {
        $logbook = LogbookBimbingan::where('id_mhs', $id)->get();
        return response()->json($logbook);
    }

    public function review_penyelia()
    {
        $detail_penilaians = DetailPenilaian::all();
        return view('dosen.review_penyelia_mhs.review_penyelia_mhs', compact('detail_penilaians'));
    }

    // public function updateReview(Request $request, $id)
    // {
    //     $review = DetailPenilaian::find($id);
    
    //     if ($review) {
    //         $review->status = $request->input('status');
    //         $review->save();
            
    //         return response()->json(['success' => true, 'status' => $review->status]);
    //     }
        
    //     return response()->json(['success' => false], 404);
    // }

    public function Pengajuan_sidang_mhs()
    {
        $pengajuan_sidangs = PengajuanSidang::all();
        return view('dosen.pengajuan_sidang.pengajuan_sidang_mhs', compact('pengajuan_sidangs'));
    }

    public function dash()
    {
        // $user = auth()->user();
        // $dosen = Dosen::where('email', $user->email)->first();

        // // Get the DosenPembimbing related to the Dosen
        // $dosenPembimbing = $dosen->dosen;

        // // Count the number of submissions for the DosenPembimbing
        // $jumlahAjuan = Pengajuan::where('id_dsn', $dosenPembimbing->id)->count();

        // return view('dosen.dashboard', compact('dosen', 'jumlahAjuan'));



        // Mengambil id dosen yang sedang login
        $dosen = Dosen::where('email', auth()->user()->email)->first();
        // $periode = Periode::where('status', true)->first();
        // $dsnPeriod = DosenPeriodik::where('id_dsn', $dosen->id)->where('id_periode', $periode->id)->with('status')->first();

        // Get the DosenPembimbing related to the Dosen
        $dosenPembimbing = $dosen->dosen;
        
        // Mendapatkan data Mahasiswa KP
        $jumlahAjuan = Pengajuan::where('id_dsn', $dosenPembimbing->id)->count();
        
        
        // Menghitung jumlah ajuan yang diterima
        $ajuanDiterima = Pengajuan::where('id_dsn', $dosenPembimbing->id)
            ->where('status', 'ACC') // Filter by accepted status
            ->count();

        // Mengurangi sisa kuota berdasarkan jumlah ajuan yang diterima
        $dosenPembimbing->sisa_kuota = $dosenPembimbing->kuota - $ajuanDiterima;

        // Simpan perubahan pada DosenPembimbing
        $dosenPembimbing->save();

        $logbook = LogbookBimbingan::with('mahasiswa')->where('id_dsn', $dosen->id)->get();
        $status = StatusMahasiswa::all();
        $mhs = Mahasiswa::all();

        $user = User::where('email', auth()->user()->email)->first();

        $activities = Activity::where('causer_id', $user->id)
            ->get();

        // Mendapatkan data dari tabel logbook dan mengelompokkan berdasarkan bab
        $logbooks = LogbookBimbingan::select('bab', DB::raw('count(*) as total'))
            // ->where('dosen_id', $dosen->id_dsn)
            ->groupBy('bab')
            ->get();

        // Mendapatkan data Mahasiswa TA1 & TA2
        $kpCount = StatusMahasiswa::where('bab_terakhir', '>', 0)->count();

        return view('dosen.dashboard', compact(
            'dosen', 
            'logbook', 
            'status', 
            'mhs', 
            'logbooks', 
            'kpCount',
            'activities', 
            'jumlahAjuan',
            'ajuanDiterima'
        ));
    }

    public function daftarPengajuanSidang()
    {
        $pengajuan_sidangs = PengajuanSidang::with('mahasiswa')->get();

        return view('dosen.pengajuan_sidang.pengajuan_sidang_mhs', compact('pengajuan_sidangs'));
    }
}
