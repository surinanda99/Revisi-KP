<?php

namespace App\Imports;

use App\Models\User;
use App\Models\Dosen;
use App\Models\DosenPembimbing;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class DosenImport implements ToCollection, WithHeadingRow
{
    public function collection(Collection $rows)
    {
        // Urutkan data berdasarkan nama yang sudah di-trim (hapus spasi ekstra)
        $sortedRows = $rows->sortBy(function ($row) {
            return trim($row['nama']);
        });

        foreach ($sortedRows as $row) {
            // Lakukan upsert untuk dosen agar tidak ada duplikat berdasarkan npp
            $dosen = Dosen::updateOrCreate(
                ['npp' => $row['npp']],
                [
                    'nama' => $row['nama'],
                    // 'bidang_kajian' => $row['bidang_kajian'],
                    // 'telp' => $row['telp'],
                ]
            );

            // Jika dosen baru dibuat, tambahkan juga data Dosen Pembimbing
            if ($dosen->wasRecentlyCreated) {
                DosenPembimbing::create([
                    'id_dsn' => $dosen->id,
                    // 'kuota' => 0,
                    // 'kuota' => $row['kuota'],
                ]);
            }

            // Lakukan pengecekan apakah user sudah ada berdasarkan npp
            $user = User::firstOrCreate(
                ['npp' => $row['npp']],
                [
                    'nim' => null,
                    'email' => $row['email'] ?? null,
                    'password' => bcrypt('DSN_PmbNG+$&KP__357%'),
                ]
            );

            // Assign role jika user baru dibuat
            if ($user->wasRecentlyCreated) {
                $user->assignRole('dosen');
            }
        }
    }
}
