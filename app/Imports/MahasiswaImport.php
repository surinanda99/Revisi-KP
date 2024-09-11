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
        $mahasiswa = new Mahasiswa([
            'nim' => $row['nim'],
            'nama' => $row['nama'],
            'email' => $row['email'],
            'status_kp' => $row['status_kp'],
            // 'dosen_wali' => $row['dosen_wali'],
        ]);

        $mahasiswa->save();

        $user = User::create([
            'name' => $row['nama'],
            'email' => $row['email'],
            'password' => bcrypt($row['nim'])
        ]);

        $user->assignRole('mahasiswa');

        // Buat entri StatusMahasiswa
        StatusMahasiswa::create([
            'id_mhs' => $mahasiswa->id,
            'pengajuan' => 0,
        ]);

        return $mahasiswa;

        // return new Mahasiswa([
        //     'nim' => $row['nim'],
        //     'nama' => $row['nama'],
        //     // 'ipk' => $row['ipk'],
        //     // 'transkrip_nilai' => $row['transkrip_nilai'],
        //     // 'telp_mhs' => $row['telp_mhs'],
        //     'email' => $row['email'],
        //     'dosen_wali' => $row['dosen_wali'],
        // ]);
    }
}
