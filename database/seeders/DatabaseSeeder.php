<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Gift;
use App\Models\Guest;
use App\Models\Story;
use App\Models\Wedding;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Admin account
        Admin::updateOrCreate(
            ['email' => 'admin@wedding.com'],
            [
                'name'     => 'Administrator',
                'email'    => 'admin@wedding.com',
                'password' => Hash::make('wedding2024'),
            ]
        );

        // Wedding data (Batak themed)
        Wedding::updateOrCreate(
            ['is_active' => true],
            [
                'couple_name_1'   => 'Boru Situmorang',
                'couple_name_2'   => 'Putra Sinaga',
                'marga_1'         => 'Situmorang',
                'marga_2'         => 'Sinaga',
                'bio_1'           => 'Putri dari Bapak Saut Situmorang dan Ibu Rosalina br Purba. Lahir dan besar di Balige, Toba Samosir.',
                'bio_2'           => 'Putra dari Bapak Maruli Sinaga dan Ibu Nelly br Siahaan. Lahir di Medan, besar di Jakarta.',
                'akad_date'       => '2027-12-14',
                'akad_time'       => '10:00',
                'akad_venue'      => 'Gereja HKBP Menteng',
                'akad_address'    => 'Jl. Jambu No.1, Menteng, Jakarta Pusat, DKI Jakarta 10350',
                'resepsi_date'    => '2027-12-14',
                'resepsi_time'    => '12:00',
                'resepsi_venue'   => 'Ballroom Grand Hyatt Jakarta',
                'resepsi_address' => 'Jl. M.H. Thamrin Kav. 28-30, Jakarta Pusat, DKI Jakarta 10350',
                'maps_url'        => 'https://maps.google.com',
                'love_story'      => 'Pertemuan yang tak terduga di sebuah pesta adat Batak di Medan, menjadi awal dari kisah cinta yang indah ini.',
                'music_title'     => 'Angin Sepoi Sepoi - Batak Song',
                'music_url'       => 'https://www.soundhelix.com/examples/mp3/SoundHelix-Song-1.mp3',
                'is_active'       => true,
            ]
        );

        // Sample guests
        $guestData = [
            ['name' => 'Keluarga Besar Situmorang',   'category' => 'Keluarga', 'language' => 'id'],
            ['name' => 'Keluarga Besar Sinaga',        'category' => 'Keluarga', 'language' => 'id'],
            ['name' => 'Bapak & Ibu Pardede',          'category' => 'Keluarga', 'language' => 'id'],
            ['name' => 'Ito Riana Siahaan',            'category' => 'Teman',    'language' => 'id'],
            ['name' => 'John & Sarah Anderson',        'category' => 'Colleague', 'language' => 'en'],
        ];

        foreach ($guestData as $g) {
            Guest::updateOrCreate(
                ['name' => $g['name']],
                array_merge($g, ['slug' => Str::slug($g['name'] . '-' . Str::random(6))])
            );
        }

        // Gift / Bank accounts
        Gift::updateOrCreate(['account_number' => '1234567890'], [
            'bank_name'      => 'Bank BCA',
            'account_number' => '1234567890',
            'account_name'   => 'Boru Situmorang',
            'order'          => 1,
        ]);

        Gift::updateOrCreate(['account_number' => '0987654321'], [
            'bank_name'      => 'Bank Mandiri',
            'account_number' => '0987654321',
            'account_name'   => 'Putra Sinaga',
            'order'          => 2,
        ]);

        // Love Stories
        $stories = [
            [
                'title'          => 'Pertemuan Pertama',
                'title_en'       => 'First Meeting',
                'event_date'     => '2021-06-15',
                'description'    => 'Kami pertama kali bertemu di pesta adat Batak di Medan. Sebuah pertemuan yang tidak terduga yang mengubah segalanya.',
                'description_en' => 'We first met at a Batak traditional ceremony in Medan. An unexpected encounter that changed everything.',
                'order'          => 1,
            ],
            [
                'title'          => 'Jatuh Cinta',
                'title_en'       => 'Falling in Love',
                'event_date'     => '2021-12-25',
                'description'    => 'Setelah berbulan-bulan bersahabat, kami menyadari bahwa ada perasaan yang lebih dalam di antara kami.',
                'description_en' => 'After months of friendship, we realized there were deeper feelings between us.',
                'order'          => 2,
            ],
            [
                'title'          => 'Manortor Bersama',
                'title_en'       => 'Dancing the Tortor Together',
                'event_date'     => '2022-08-17',
                'description'    => 'Bersama di pesta adat Batak, kami menari Tortor untuk pertama kalinya bersama. Momen yang tidak terlupakan.',
                'description_en' => 'Together at a Batak ceremony, we danced the Tortor for the first time together. An unforgettable moment.',
                'order'          => 3,
            ],
            [
                'title'          => 'Marhusip (Lamaran)',
                'title_en'       => 'The Proposal',
                'event_date'     => '2023-12-14',
                'description'    => 'Dengan restu keluarga dan adat Batak, lamaran resmi diucapkan. Dimulailah perjalanan menuju pernikahan.',
                'description_en' => 'With family blessings and Batak customs, the official proposal was made. A journey toward marriage began.',
                'order'          => 4,
            ],
        ];

        foreach ($stories as $s) {
            Story::updateOrCreate(['title' => $s['title']], $s);
        }
    }
}
