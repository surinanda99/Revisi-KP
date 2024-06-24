<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Buat Role
        $roles = ['dosen', 'mahasiswa', 'koor', 'admin'];

        foreach ($roles as $role) {
            Role::create(['name' => $role]);
        }

        // Buat user dan assign role
        $users = [
            ['name' => 'Admin', 'email' => 'admin@bimbingan.online', 'password' => bcrypt('123456'), 'role' => 'admin'],
            ['name' => 'Dosen', 'email' => 'adhitya@dsn.dinus.ac.id', 'password' => bcrypt('123456'), 'role' => 'dosen'],
            ['name' => 'Mahasiswa', 'email' => '111202113472@mhs.dinus.ac.id', 'password' => bcrypt('123456'), 'role' => 'mahasiswa'],
            ['name' => 'Mahasiswa', 'email' => '111202113489@mhs.dinus.ac.id', 'password' => bcrypt('123456'), 'role' => 'mahasiswa'],
            ['name' => 'Koor', 'email' => 'koordinator@bimbingan.online', 'password' => bcrypt('123456'), 'role' => 'koor'],
        ];

        foreach ($users as $userData) {
            $user = User::create([
                'name' => $userData['name'],
                'email' => $userData['email'],
                'password' => $userData['password'],
            ]);
            $user->assignRole($userData['role']);
        }
    }
}
