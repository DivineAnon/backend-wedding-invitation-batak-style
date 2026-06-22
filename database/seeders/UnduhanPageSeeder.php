<?php

namespace Database\Seeders;

use App\Models\UnduhanPage;
use Illuminate\Database\Seeder;

class UnduhanPageSeeder extends Seeder
{
    public function run(): void
    {
        UnduhanPage::firstOrCreate(
            ['id' => 1],
            [
                'hero_image' => null,
            ]
        );
    }
}
