<?php

namespace App\Imports;

use App\Models\User;
use App\Models\Mahasiswa;
use App\Models\StatusMahasiswa;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class MahasiswaImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        // Lakukan upsert untuk mahasiswa agar tidak ada duplikat berdasarkan nim
        $mahasiswa = Mahasiswa::updateOrCreate(
            ['nim' => $row['nim']],
            [
                'nama' => $row['nama'],
                'email' => $row['email'],
                'status_kp' => $row['status_kp'],
            ]
        );

        // Jika mahasiswa baru dibuat, tambahkan juga data StatusMahasiswa
        if ($mahasiswa->wasRecentlyCreated) {
            StatusMahasiswa::create([
                'id_mhs' => $mahasiswa->id,
                'pengajuan' => 0,
            ]);
        }

        // Lakukan pengecekan apakah user sudah ada berdasarkan nim
        $user = User::firstOrCreate(
            ['nim' => $row['nim']],
            [
                'npp' => null,
                'email' => $row['email'],
                'password' => bcrypt('Dinus-123'),
            ]
        );

        // Assign role jika user baru dibuat
        if ($user->wasRecentlyCreated) {
            $user->assignRole('mahasiswa');
        }

        // Kembalikan instance mahasiswa
        return $mahasiswa;
    }
}
