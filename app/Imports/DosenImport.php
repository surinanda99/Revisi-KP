<?php

namespace App\Imports;

use App\Models\User;
use App\Models\Dosen;
use App\Models\DosenPembimbing;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class DosenImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        // Create the Dosen record
        $dosen = Dosen::create([
            'npp' => $row['npp'],
            'nama' => $row['nama'],
            'bidang_kajian' => $row['bidang_kajian'],
            'email' => $row['email'],
            'telp' => $row['telp'],
        ]);

        // Create the DosenPembimbing record
        DosenPembimbing::create([
            'id_dsn' => $dosen->id,
            'kuota' => $row['kuota'],
        ]);

        $user = User::create([
            'name' => $row['nama'],
            'email' => $row['email'],
            'password' => bcrypt($row['npp'])
        ]);

        $user->assignRole('dosen');

        return $dosen;
    }
}
