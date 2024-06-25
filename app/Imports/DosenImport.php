<?php

namespace App\Imports;

use App\Models\DosenPembimbing;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class DosenImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new DosenPembimbing([
            'npp' => $row['npp'],
            'nama' => $row['nama'],
            'bidang_kajian' => $row['bidang_kajian'],
            'kuota' => $row['kuota'],
        ]);
    }
}
