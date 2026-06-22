<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DewanParokiSeeder extends Seeder
{
    public function run(): void
    {
        if (DB::table('dewan_paroki')->count() > 0) {
            $this->command->info('DewanParokiSeeder: data sudah ada, dilewati.');
            return;
        }

        // Ensure dewan-paroki image directory exists
        $dir = public_path('compro_assets/image/dewan-paroki');
        if (!is_dir($dir)) {
            mkdir($dir, 0755, true);
        }

        $now = Carbon::now();

        $anggota = [
            ['nama' => 'Romo Servatius Dange, SVD', 'jabatan' => 'Ketua (Pastor Kepala)', 'foto' => null, 'urutan' => 0],
            ['nama' => 'Yohanes Baptista Susanto',   'jabatan' => 'Wakil Ketua',           'foto' => null, 'urutan' => 1],
            ['nama' => 'Maria Goretti Wulandari',    'jabatan' => 'Sekretaris I',           'foto' => null, 'urutan' => 2],
            ['nama' => 'Antonius Hendra Kusuma',     'jabatan' => 'Sekretaris II',          'foto' => null, 'urutan' => 3],
            ['nama' => 'Theresia Sri Wahyuni',       'jabatan' => 'Bendahara I',            'foto' => null, 'urutan' => 4],
            ['nama' => 'Benediktus Ari Wibowo',      'jabatan' => 'Bendahara II',           'foto' => null, 'urutan' => 5],
            ['nama' => 'Katarina Dewi Santoso',      'jabatan' => 'Bidang Liturgi',         'foto' => null, 'urutan' => 6],
            ['nama' => 'Ignatius Budi Prasetyo',     'jabatan' => 'Bidang Pewartaan',       'foto' => null, 'urutan' => 7],
            ['nama' => 'Lucia Endang Rahayu',        'jabatan' => 'Bidang Kemasyarakatan',  'foto' => null, 'urutan' => 8],
            ['nama' => 'Fransiskus Xaverius Agung',  'jabatan' => 'Bidang Pembangunan',     'foto' => null, 'urutan' => 9],
        ];

        foreach ($anggota as $data) {
            DB::table('dewan_paroki')->insert(array_merge($data, [
                'created_at' => $now,
                'updated_at' => $now,
            ]));
        }

        $this->command->info('DewanParokiSeeder: ' . count($anggota) . ' anggota berhasil dibuat.');
    }
}
