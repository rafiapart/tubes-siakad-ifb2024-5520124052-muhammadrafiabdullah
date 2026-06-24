<?php

namespace Database\Seeders;

use App\Models\Krs;
use Illuminate\Database\Seeder;

class KrsSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['npm' => '2201000001', 'kode_matakuliah' => 'IF010101'],
            ['npm' => '2201000001', 'kode_matakuliah' => 'IF010102'],
            ['npm' => '2201000002', 'kode_matakuliah' => 'IF010101'],
            ['npm' => '2201000003', 'kode_matakuliah' => 'IF010103'],
        ];

        foreach ($data as $item) {
            Krs::create($item);
        }
    }
}
