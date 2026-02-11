<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Users;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'admin',
                'email' => 'admin@example.com',
                'role' => 'admin',
                'nama_lengkap' => 'admin',
                'status' => 'PT',
                'unit' => 'yayasan',
                'jabatan' => 'staf sdm'
            ],
            [
                'name' => 'lia',
                'email' => 'lia@example.com',
                'role' => 'guru',
                'nama_lengkap' => 'Lia Puspita Dewi',
                'status' => 'Honorer',
                'unit' => 'yayasan',
                'jabatan' => 'staf sdm'
            ],
            [
                'name' => 'novida',
                'email' => 'novida@example.com',
                'role' => 'staf',
                'nama_lengkap' => 'Novida Nursyadharmawati',
                'status' => 'PT',
                'unit' => 'yayasan',
                'jabatan' => 'Koordinator Kepegawaian'
            ],
            [
                'name' => 'saidah',
                'email' => 'saidah@example.com',
                'role' => 'kabid',
                'nama_lengkap' => 'Saidah',
                'status' => 'PT',
                'unit' => 'yayasan',
                'jabatan' => 'Kepala Bidang SDM'
            ],
            [
                'name' => 'andika',
                'email' => 'andika@example.com',
                'role' => 'kanit',
                'nama_lengkap' => 'Andika',
                'status' => 'PT',
                'unit' => 'SDIT',
                'jabatan' => 'Kepala Sekolah'
            ],
        ];

        foreach ($users as $user) {
            Users::create([
                'name' => $user['name'],
                'email' => $user['email'],
                'password' => Hash::make('12345678'),
                'role' => $user['role'],
            ]);
        }
    }
}
