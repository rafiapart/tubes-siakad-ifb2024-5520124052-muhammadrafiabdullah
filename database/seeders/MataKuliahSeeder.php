<?php

namespace Database\Seeders;

use App\Models\MataKuliah;
use Illuminate\Database\Seeder;

class MataKuliahSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['kode_matakuliah' => 'IF010101', 'nama_matakuliah' => 'Pemrograman Web II', 'sks' => 3],
            ['kode_matakuliah' => 'IF010102', 'nama_matakuliah' => 'Basis Data', 'sks' => 3],
            ['kode_matakuliah' => 'IF010103', 'nama_matakuliah' => 'Struktur Data', 'sks' => 3],
            ['kode_matakuliah' => 'IF010104', 'nama_matakuliah' => 'Jaringan Komputer', 'sks' => 2],
            ['kode_matakuliah' => 'IF010105', 'nama_matakuliah' => 'Rekayasa Perangkat Lunak', 'sks' => 3],
        ];

        foreach ($data as $item) {
            MataKuliah::create($item);
        }
    }
}
