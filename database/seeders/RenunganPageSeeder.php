<?php

namespace Database\Seeders;

use App\Models\RenunganPage;
use Illuminate\Database\Seeder;

class RenunganPageSeeder extends Seeder
{
    public function run(): void
    {
        RenunganPage::firstOrCreate(
            ['id' => 1],
            [
                'hero_image' => null,
            ]
        );
    }
}
