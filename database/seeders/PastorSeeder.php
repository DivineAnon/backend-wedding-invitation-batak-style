<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PastorSeeder extends Seeder
{
    public function run(): void
    {
        if (DB::table('pastors')->count() > 0) {
            $this->command->info('PastorSeeder: data sudah ada, dilewati.');
            return;
        }

        $now = Carbon::now();

        // Ensure pastor image directory exists
        $dir = public_path('compro_assets/image/pastor');
        if (!is_dir($dir)) {
            mkdir($dir, 0755, true);
        }

        // Copy hero.jpg as placeholder for the pinned pastor
        $src  = public_path('compro_assets/image/hero.jpg');
        $dest = $dir . '/pastor_1.jpg';
        if (file_exists($src) && !file_exists($dest)) {
            copy($src, $dest);
        }

        $pastors = [
            // Current head pastor (urutan 0 = first)
            [
                'nama'            => 'P. Servatius Dange, SVD',
                'ordo'            => 'SVD',
                'jabatan'         => 'Pastor Kepala Paroki',
                'periode_mulai'   => '2019',
                'periode_selesai' => null,
                'bio'             => 'Romo Servatius Dange SVD memimpin Paroki Santo Yoseph Matraman sebagai pastor kepala. Di bawah kepemimpinannya, paroki terus mengembangkan karya pastoral yang berakar pada spiritualitas SVD — Serikat Sabda Allah — dengan semangat misi dan pelayanan kepada seluruh umat.',
                'foto'            => 'pastor_1.jpg',
                'urutan'          => 0,
            ],
            // Historical pastors (ordered newest → oldest)
            ['nama' => 'P. Dominikus Beda Udjan, SVD',            'ordo' => 'SVD', 'jabatan' => 'Pastor Kepala Paroki', 'periode_mulai' => '2012', 'periode_selesai' => '2019', 'bio' => null, 'foto' => null, 'urutan' => 1],
            ['nama' => 'P. Agustinus I. Nyoman Murtika, SVD',     'ordo' => 'SVD', 'jabatan' => 'Pastor Kepala Paroki', 'periode_mulai' => '2006', 'periode_selesai' => '2012', 'bio' => null, 'foto' => null, 'urutan' => 2],
            ['nama' => 'P. Cornelius Fallo, SVD',                 'ordo' => 'SVD', 'jabatan' => 'Pastor Kepala Paroki', 'periode_mulai' => '2003', 'periode_selesai' => '2006', 'bio' => null, 'foto' => null, 'urutan' => 3],
            ['nama' => 'P. Johanes Madia Adnyana, SVD',           'ordo' => 'SVD', 'jabatan' => 'Pastor Kepala Paroki', 'periode_mulai' => '2000', 'periode_selesai' => '2003', 'bio' => null, 'foto' => null, 'urutan' => 4],
            ['nama' => 'P. Johanes Djawa, SVD',                   'ordo' => 'SVD', 'jabatan' => 'Pastor Kepala Paroki', 'periode_mulai' => '1991', 'periode_selesai' => '2000', 'bio' => null, 'foto' => null, 'urutan' => 5],
            ['nama' => 'P. Paulus Boli Lamak, SVD',               'ordo' => 'SVD', 'jabatan' => 'Pastor Kepala Paroki', 'periode_mulai' => '1981', 'periode_selesai' => '1991', 'bio' => null, 'foto' => null, 'urutan' => 6],
            ['nama' => 'P. Michael Mige Raya, SVD',               'ordo' => 'SVD', 'jabatan' => 'Pastor Kepala Paroki', 'periode_mulai' => '1979', 'periode_selesai' => '1981', 'bio' => null, 'foto' => null, 'urutan' => 7],
            ['nama' => 'P. Jan Lali, SVD (Pastor Pribumi Pertama)','ordo' => 'SVD', 'jabatan' => 'Pastor Kepala Paroki', 'periode_mulai' => '1974', 'periode_selesai' => '1979', 'bio' => null, 'foto' => null, 'urutan' => 8],
            ['nama' => 'P. C. van Iersel, SVD',                   'ordo' => 'SVD', 'jabatan' => 'Pastor Kepala Paroki', 'periode_mulai' => null,   'periode_selesai' => null,   'bio' => null, 'foto' => null, 'urutan' => 9],
            ['nama' => 'P. Piet Nooy, SVD',                       'ordo' => 'SVD', 'jabatan' => 'Pastor Kepala Paroki', 'periode_mulai' => null,   'periode_selesai' => null,   'bio' => null, 'foto' => null, 'urutan' => 10],
            ['nama' => 'P. Motter, SVD',                          'ordo' => 'SVD', 'jabatan' => 'Pastor Kepala Paroki', 'periode_mulai' => '1954', 'periode_selesai' => null,   'bio' => null, 'foto' => null, 'urutan' => 11],
            ['nama' => 'P. B. Schneider, OFM',                    'ordo' => 'OFM', 'jabatan' => 'Pastor Kepala Paroki', 'periode_mulai' => '1940', 'periode_selesai' => '1953', 'bio' => null, 'foto' => null, 'urutan' => 12],
            ['nama' => 'P. W. Hellings, SJ',                      'ordo' => 'SJ',  'jabatan' => 'Pastor Kepala Paroki', 'periode_mulai' => '1922', 'periode_selesai' => null,   'bio' => null, 'foto' => null, 'urutan' => 13],
            ['nama' => 'P. A. Mathijsen, SJ',                     'ordo' => 'SJ',  'jabatan' => 'Pastor Kepala Paroki', 'periode_mulai' => '1920', 'periode_selesai' => null,   'bio' => null, 'foto' => null, 'urutan' => 14],
            ['nama' => 'P. Th. van Swieten, SJ',                  'ordo' => 'SJ',  'jabatan' => 'Pastor Kepala Paroki', 'periode_mulai' => '1910', 'periode_selesai' => null,   'bio' => null, 'foto' => null, 'urutan' => 15],
            ['nama' => 'P. J. Hoevenaars, SJ (Pastor Kepala Pertama)', 'ordo' => 'SJ', 'jabatan' => 'Pastor Kepala Paroki', 'periode_mulai' => '1906', 'periode_selesai' => null, 'bio' => null, 'foto' => null, 'urutan' => 16],
        ];

        foreach ($pastors as $data) {
            DB::table('pastors')->insert(array_merge($data, [
                'created_at' => $now,
                'updated_at' => $now,
            ]));
        }

        $this->command->info('PastorSeeder: ' . count($pastors) . ' pastor berhasil dibuat.');
    }
}
