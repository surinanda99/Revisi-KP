<?php

namespace App\Imports;

use App\Models\Mahasiswa;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class MahasiswaImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new Mahasiswa([
            'nim' => $row['nim'],
            'nama' => $row['nama'],
            // 'ipk' => $row['ipk'],
            // 'telp_mhs' => $row['telp_mhs'],
            'email' => $row['email'],
            'dosen_wali' => $row['dosen_wali'],
            // 'transkrip_nilai' => $row['transkrip_nilai'],
        ]);
    }
}
