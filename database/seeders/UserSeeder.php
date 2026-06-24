<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name'     => 'Admin',
            'email'    => 'admin@gmail.com',
            'password' => Hash::make('password'),
            'role'     => 'admin',
            'npm'      => null,
        ]);

        User::create([
            'name'     => 'Andi Pratama',
            'email'    => 'mahasiswa@gmail.com',
            'password' => Hash::make('password'),
            'role'     => 'mahasiswa',
            'npm'      => '2201000001', //match npm di MahasiswaSeeder
        ]);
    }
}