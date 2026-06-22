<?php

namespace Database\Seeders;

use App\Models\IntensiMisa;
use Illuminate\Database\Seeder;

class IntensiMisaSeeder extends Seeder
{
    public function run(): void
    {
        IntensiMisa::updateOrCreate(
            ['id' => 1],
            [
                'nomor_wa' => '6281234567890',
                'pesan'    => 'Halo Romo, saya ingin mendaftarkan Intensi Misa. Mohon informasi lebih lanjut. Terima kasih.',
            ]
        );
    }
}
