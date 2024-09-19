<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Mahasiswa;
use App\Models\Pengajuan;
use App\Events\PengajuanKP;
use Illuminate\Http\Request;
use App\Models\DosenPembimbing;
use App\Models\StatusMahasiswa;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;

class PengajuanController extends Controller
{
    public function index()
    {
        // Fetch the current Mahasiswa based on logged-in user's nim
        $mhs = Mahasiswa::where('nim', auth()->user()->nim)->first();
        $pengajuan = Pengajuan::where('id_mhs', $mhs->id)->latest()->first();

        // Check if the Mahasiswa has a Dosen Pembimbing
        if ($mhs && $mhs->id_dsn) {
            // Redirect to the draft page if the Mahasiswa already has a Dosen Pembimbing
            return redirect()->route('draft-pengajuan-mahasiswa');
        } elseif ($pengajuan && $pengajuan->status == 'PENDING') {
            return redirect()->route('draft-pengajuan-mahasiswa');
        }

        // Get the list of Dosen with their DosenPembimbing details
        $filteredDosen = Dosen::with(['dosen' => function ($query) {
            $query->selectRaw('dosen_pembimbings.*, (kuota - (SELECT COUNT(*) FROM status_mahasiswas WHERE status_mahasiswas.id_dsn = dosen_pembimbings.id_dsn)) as sisa_kuota');
        }])->get();

        // Update jumlah_ajuan for each Dosen
        // foreach ($filteredDosen as $dosen) {
        //     if ($dosen->dosen) {
        //         // Count the number of Pengajuan related to the Dosen
        //         $dosen->dosen->jumlah_ajuan = Pengajuan::where('id_dsn', $dosen->id)->count();
        //         $dosen->dosen->save();
        //     }
        // }

        // Filter out Dosen with sisa_kuota <= 0
        $filteredDosen = $filteredDosen->filter(function($dosen) {
            return $dosen->dosen && $dosen->dosen->sisa_kuota > 0;
        });

        // Fetch the status of the Mahasiswa
        $status = StatusMahasiswa::where('id_mhs', $mhs->id)->first();

        // Fetch the history of Pengajuan that have been rejected
        $history = Pengajuan::where('id_mhs', $mhs->id)->where('status', 'TOLAK')->get();

        // Return the view for choosing a Dosen Pembimbing
        return view('mahasiswa.pengajuan_kp.pilihDosbing', compact('status', 'filteredDosen', 'history'));
    }

    public function form(Request $request)
    {
        $data = $request->all();
        $data['tanggal_mulai'] = $data['tanggal_mulai'] ?? ''; 
        $data['tanggal_selesai'] = $data['tanggal_selesai'] ?? ''; 
        return view('mahasiswa.pengajuan_kp.formPengajuan', compact('data'));
    }

    public function draft(Request $request)
    {
        // Fetch Mahasiswa based on the authenticated user
        $mahasiswa = Mahasiswa::where('nim', auth()->user()->nim)->first();
    
        // Check if Mahasiswa is found
        if (!$mahasiswa) {
            return redirect()->back()->with('error', 'Mahasiswa not found.');
        }
    
        // Fetch StatusMahasiswa for the Mahasiswa
        $status = StatusMahasiswa::where('id_mhs', $mahasiswa->id)->first();
    
        // Fetch Pengajuan data if exists
        $pengajuan = Pengajuan::where('id_mhs', $status->id_mhs)
            ->whereIn('status', ['ACC', 'PENDING'])
            ->first();
    
        // Default data setup
        if ($pengajuan) {
            $data = [
                'id_dospem' => $mahasiswa->id_dsn ? $mahasiswa->id_dsn : $request->id_dospem,
                'judul' => $pengajuan->judul ? $pengajuan->judul : $request->judul,
                'perusahaan' => $pengajuan->perusahaan ? $pengajuan->perusahaan : $request->perusahaan,
                'posisi' => $pengajuan->perusahaan ? $pengajuan->posisi : $request->posisi,
                'tanggal_mulai' => $pengajuan->tanggal_mulai ? $pengajuan->tanggal_mulai : $request->tanggal_mulai,
                'tanggal_selesai' => $pengajuan->tanggal_selesai ? $pengajuan->tanggal_selesai : $request->tanggal_selesai,
            ];
        } else {
            $data = [
                'id_dospem' => $mahasiswa->id_dsn ? $mahasiswa->id_dsn : $request->id_dospem,
                'judul' => $pengajuan ? $pengajuan->judul : $request->judul,
                'perusahaan' => $pengajuan ? $pengajuan->perusahaan : $request->perusahaan,
                'posisi' => $pengajuan ? $pengajuan->posisi : $request->posisi,
                'tanggal_mulai' => $pengajuan ? $pengajuan->tanggal_mulai : $request->tanggal_mulai,
                'tanggal_selesai' => $pengajuan ? $pengajuan->tanggal_selesai : $request->tanggal_selesai,
            ];
        }

        if ($status->id_dsn != 0) {
            $dospil = Dosen::where('id', $mahasiswa->id_dsn)->first();
        } else {
            $dospil = $pengajuan ? Dosen::where('id', $pengajuan->id_dsn)->first() : Dosen::where('id', $request->id_dospem)->first();
        }

        // if ($status->id_dsn != 0) {
        //     // Fetch dosen pembimbing
        //     $dospil = Dosen::where('id', $mahasiswa->id_dsn)->first();
        //     // dd($dospil);
        // } else {
        //     if ($pengajuan) {
        //         $dospil = Dosen::where('id', $pengajuan->id_dsn)->first();
        //     } else {
        //         $dospil = Dosen::where('id', $request->id_dospem)->first();
        //     }
        // }
    
        // Fetch history of rejected pengajuan
        $history = Pengajuan::with('dosen')
            ->where('id_mhs', $status->id_mhs)
            ->where('status', 'TOLAK')
            ->get();
    
        // Determine status message
        $statusMessage = $pengajuan
            ? ($pengajuan->status == 'ACC'
                ? 'Disetujui - Untuk tahap selanjutnya, silahkan melakukan bimbingan dengan dosen pembimbing dengan melakukan pengisian logbook bimbingan.'
                : 'Draft - Untuk mengajukan Kerja Praktek ke dosen pembimbing, klik tombol Ajukan di bawah'
            )
            : 'Draft - Untuk mengajukan Kerja Praktek ke dosen pembimbing, klik tombol Ajukan di bawah';
    
        $checkDosen = $request->id_dospem;

        $checkPengajuan = false;
        if ($pengajuan) {
            $columns = Schema::getColumnListing('pengajuans');
            foreach ($columns as $column) {
                if (is_null($pengajuan->$column) && $column !== 'alasan') {
                    $checkPengajuan = true;
                    break;
                }
            }
        }

        // Return draft pengajuan view with necessary data
        return view('mahasiswa.pengajuan_kp.draftPengajuan', compact(
            'data',
            'mahasiswa',
            'status',
            'dospil',
            'history',
            'statusMessage',
            'pengajuan',
            'checkDosen',
            'checkPengajuan' // Ensure $pengajuan is available in the view
        ));
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $mahasiswa = Mahasiswa::where('nim', auth()->user()->nim)->first();
        $status = StatusMahasiswa::where('id_mhs', $mahasiswa->id)->first();
        
        // $statusPengajuan = 'PENDING';
        $statusPengajuan = $mahasiswa->id_dsn ? 'ACC' : 'PENDING';

        // if ($mahasiswa->id_dsn != null) {
        //     $statusPengajuan = 'ACC';
        // }

        // Cek apakah ini adalah pengajuan baru atau edit
        $pengajuan = Pengajuan::where('id_mhs', $status->id_mhs)->first();

        if (!$pengajuan) {
            // Jika tidak ada pengajuan sebelumnya, maka kita tambahkan 1 ke field pengajuan
            $status->pengajuan = 1; // Tetap 1 untuk pengajuan baru
            $status->save();
        } else {
            // Jika pengajuan sudah ada, pastikan pengajuan tetap 1
            $status->pengajuan = 1;
            $status->save();
        }

        // Save or update pengajuan
        $pengajuan = Pengajuan::updateOrCreate(
            ['id_mhs' => $status->id_mhs],
            [
                'id_dsn' => $data['id_dsn'],
                'judul' => $data['judul'] ?? null,
                'perusahaan' => $data['perusahaan'] ?? null,
                'posisi' => $data['posisi'] ?? null,
                'tanggal_mulai' => $data['tanggal_mulai'] ?? null,
                'tanggal_selesai' => $data['tanggal_selesai'] ?? null,
                'status' => $statusPengajuan,
            ]
        );
        
        // Log activity
        activity()
            ->inLog('Pengajuan')
            ->causedBy(auth()->user())
            ->performedOn($pengajuan)
            ->withProperties(['id_dsn' => $data['id_dsn'], 'id_mhs' => $status->id_mhs])
            ->log('Melakukan pengajuan Kerja Praktek');
        
        // Update dosen pembimbing data
        // if ($status->id_dsn != 0) {
            // if (isset($data['id_dsn'])) {
            //     $dosen = DosenPembimbing::where('id_dsn', $data['id_dsn'])->first();
            //     Log::info('Before Update:', ['id_dsn' => $data['id_dsn'], 'jumlah_ajuan' => $dosen->jumlah_ajuan]);
            //     if ($dosen) {
            //         $dosen->jumlah_ajuan = $dosen->jumlah_ajuan + 1;
            //         $dosen->save();

            //         Log::info('After Update:', ['id_dsn' => $data['id_dsn'], 'jumlah_ajuan' => $dosen->jumlah_ajuan]);
            //     }
            // }
            
            // Trigger event
            $dsn = Dosen::where('id', $data['id_dsn'])->first();
            event(new PengajuanKP($mahasiswa, $dsn));    
        // }

        // $dosen = DosenPembimbing::where('id_dsn', $pengajuan->id_dsn)->first();
        // $dosen->jumlah_ajuan++;
        // $dosen->save();

        // $status->pengajuan++;
        // $status->save();

        return redirect()->route('pengajuan-mahasiswa');
    }

    public function show($id_dospem)
    {
        $dosen = Dosen::find($id_dospem);
        return response()->json($dosen);
    }
}
