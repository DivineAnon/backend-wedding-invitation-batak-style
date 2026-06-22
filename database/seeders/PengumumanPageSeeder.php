<?php

namespace Database\Seeders;

use App\Models\PengumumanPage;
use Illuminate\Database\Seeder;

class PengumumanPageSeeder extends Seeder
{
    public function run(): void
    {
        PengumumanPage::firstOrCreate(
            ['id' => 1],
            [
                'hero_image' => null,
            ]
        );
    }
}
