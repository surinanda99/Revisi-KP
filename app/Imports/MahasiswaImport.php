<?php

namespace App\Imports;

use App\Models\User;
use App\Models\Dosen;
use App\Models\Mahasiswa;
use App\Models\DosenPembimbing;
use App\Models\StatusMahasiswa;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class MahasiswaImport implements ToCollection, WithHeadingRow
{
    public function collection(Collection $rows)
    {
        // Urutkan rows berdasarkan NIM (bagian numerik setelah A11.2021.)
        $sortedRows = $rows->sortBy(function ($row) {
            // Asumsikan format NIM seperti: A11.2021.xxxxx
            // Ambil bagian numerik dari NIM mulai dari karakter ke-9
            return intval(substr($row['nim'], 9));
        });

        // Proses setiap row yang sudah diurutkan
        foreach ($sortedRows as $row) {
            // Cari dosen berdasarkan npp
            $dosen = null;
            if (!empty($row['npp'])) {
                $dosen = Dosen::where('npp', $row['npp'])->first();
            }

            // Lakukan upsert untuk mahasiswa agar tidak ada duplikat berdasarkan nim
            $mahasiswa = Mahasiswa::updateOrCreate(
                ['nim' => $row['nim']],
                [
                    'nama' => $row['nama'],
                    'email' => $row['email'],
                    'status_kp' => $row['status_kp'],
                    'id_dsn' => $dosen ? $dosen->id : null
                ]
            );

            // Jika mahasiswa baru dibuat dan memiliki dosen pembimbing, tambahkan data StatusMahasiswa
            if ($mahasiswa->wasRecentlyCreated && $dosen) {
                StatusMahasiswa::create([
                    'id_mhs' => $mahasiswa->id,
                    'id_dsn' => $dosen->id,
                    'status' => 'ACC',
                    'pengajuan' => 1,
                ]);

                // Update table dosen_pembimbings
                $dosenPembimbing = DosenPembimbing::where('id_dsn', $dosen->id)->first();
                if ($dosenPembimbing) {
                    $dosenPembimbing->increment('jumlah_ajuan');
                    $dosenPembimbing->increment('ajuan_diterima');
                    $dosenPembimbing->decrement('sisa_kuota');
                    $dosenPembimbing->status = $dosenPembimbing->sisa_kuota > 0 ? 'Tersedia' : 'Penuh';
                    $dosenPembimbing->save();
                }
            } else {
                // Update status mahasiswa jika sudah ada di database
                StatusMahasiswa::updateOrCreate(
                    ['id_mhs' => $mahasiswa->id],
                    [
                        'pengajuan' => 0,
                        'status' => $dosen ? 'ACC' : 'Pending',
                    ]
                );
            }

            // Lakukan pengecekan apakah user sudah ada berdasarkan nim
            $user = User::updateOrCreate(
                ['nim' => $row['nim']],
                [
                    'email' => $row['email'],
                    'password' => bcrypt('Dinus-123'), // Default password for mahasiswa
                ]
            );

            // Assign role jika user baru dibuat
            if (!$user->hasRole('mahasiswa')) {
                $user->assignRole('mahasiswa');
            }
        }
    }
}