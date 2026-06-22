<?php

namespace Database\Seeders;

use App\Models\JadwalMisa;
use Illuminate\Database\Seeder;

class JadwalMisaSeeder extends Seeder
{
    public function run(): void
    {
        JadwalMisa::truncate();

        $data = [
            // Senin — Jumat
            ['hari_group' => 'Senin — Jumat', 'jam' => '06.00', 'tipe' => 'Misa Harian',       'urutan' => 0],
            ['hari_group' => 'Senin — Jumat', 'jam' => '12.00', 'tipe' => 'Misa Siang',         'urutan' => 1],

            // Sabtu
            ['hari_group' => 'Sabtu', 'jam' => '06.00', 'tipe' => 'Misa Harian',       'urutan' => 0],
            ['hari_group' => 'Sabtu', 'jam' => '17.00', 'tipe' => 'Misa Vigili Minggu', 'urutan' => 1],
            ['hari_group' => 'Sabtu', 'jam' => '19.00', 'tipe' => 'Misa Vigili Minggu', 'urutan' => 2],

            // Minggu
            ['hari_group' => 'Minggu', 'jam' => '06.00', 'tipe' => 'Misa Pertama', 'urutan' => 0],
            ['hari_group' => 'Minggu', 'jam' => '08.00', 'tipe' => 'Misa Kedua',   'urutan' => 1],
            ['hari_group' => 'Minggu', 'jam' => '10.00', 'tipe' => 'Misa Ketiga',  'urutan' => 2],
            ['hari_group' => 'Minggu', 'jam' => '17.00', 'tipe' => 'Misa Sore',    'urutan' => 3],
            ['hari_group' => 'Minggu', 'jam' => '19.00', 'tipe' => 'Misa Malam',   'urutan' => 4],

            // Jumat Pertama (replaces "Hari Raya")
            ['hari_group' => 'Jumat Pertama', 'jam' => '06.00', 'tipe' => 'Misa Pertama', 'urutan' => 0],
            ['hari_group' => 'Jumat Pertama', 'jam' => '09.00', 'tipe' => 'Misa Kedua',   'urutan' => 1],
            ['hari_group' => 'Jumat Pertama', 'jam' => '17.00', 'tipe' => 'Misa Sore',    'urutan' => 2],
        ];

        foreach ($data as $row) {
            JadwalMisa::create($row);
        }
    }
}
