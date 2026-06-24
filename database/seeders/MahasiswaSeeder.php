<?php

namespace Database\Seeders;

use App\Models\Mahasiswa;
use Illuminate\Database\Seeder;

class MahasiswaSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['npm' => '2201000001', 'nidn' => '1001000001', 'nama' => 'Andi Pratama'],
            ['npm' => '2201000002', 'nidn' => '1001000001', 'nama' => 'Dewi Lestari'],
            ['npm' => '2201000003', 'nidn' => '1001000002', 'nama' => 'Fajar Nugroho'],
            ['npm' => '2201000004', 'nidn' => '1001000003', 'nama' => 'Maya Sari'],
        ];

        foreach ($data as $item) {
            Mahasiswa::create($item);
        }
    }
}
