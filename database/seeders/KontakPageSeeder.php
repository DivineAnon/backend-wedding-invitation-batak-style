<?php

namespace Database\Seeders;

use App\Models\KontakPage;
use Illuminate\Database\Seeder;

class KontakPageSeeder extends Seeder
{
    public function run(): void
    {
        KontakPage::firstOrCreate(
            ['id' => 1],
            [
                'hero_image' => null,
            ]
        );
    }
}
