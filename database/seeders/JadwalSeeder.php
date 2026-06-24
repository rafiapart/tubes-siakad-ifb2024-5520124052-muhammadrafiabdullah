<?php

namespace Database\Seeders;

use App\Models\Jadwal;
use Illuminate\Database\Seeder;

class JadwalSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['kode_matakuliah' => 'IF010101', 'nidn' => '1001000001', 'kelas' => 'A', 'hari' => 'Senin', 'jam' => '08:00'],
            ['kode_matakuliah' => 'IF010102', 'nidn' => '1001000002', 'kelas' => 'A', 'hari' => 'Selasa', 'jam' => '10:00'],
            ['kode_matakuliah' => 'IF010103', 'nidn' => '1001000003', 'kelas' => 'B', 'hari' => 'Rabu', 'jam' => '13:00'],
            ['kode_matakuliah' => 'IF010104', 'nidn' => '1001000004', 'kelas' => 'A', 'hari' => 'Kamis', 'jam' => '08:00'],
        ];

        foreach ($data as $item) {
            Jadwal::create($item);
        }
    }
}
