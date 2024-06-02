<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DummyUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userData = [
            [
                'name'=> 'mahasiswa',
                'email'=> 'mahasiswa@mhs.dinus.ac.id',
                'role' => 'mahasiswa',
                'password'=>bcrypt('123456')
            ],
            [
                'name'=> 'dosen',
                'email'=> 'dosen@dsn.dinus.ac.id',
                'role' => 'dosen',
                'password'=>bcrypt('123456')
            ],
            [
                'name'=> 'koor',
                'email'=> 'koor@kor.dinus.ac.id',
                'role' => 'koor',
                'password'=>bcrypt('123456')
            ],
            [
                'name'=> 'admin',
                'email'=> 'admin@adm.dinus.ac.id',
                'role' => 'admin',
                'password'=>bcrypt('123456')
            ],
        ];

        foreach($userData as $key => $val){
            User::create($val);
        }
    }
}
