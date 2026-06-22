<?php

namespace Database\Seeders;

use App\Models\Kontak;
use Illuminate\Database\Seeder;

class KontakSeeder extends Seeder
{
    public function run(): void
    {
        Kontak::create([
            'alamat'        => 'Jl. Matraman Raya 127',
            'alamat_sub'    => 'Jakarta Timur, 13320',
            'telp'          => '(021) 858-3782',
            'telp_sub'      => '(021) 856-8417',
            'email'         => 'info.sekre.sanyos@gmail.com',
            'email_sub'     => 'Sekretariat Paroki',
            'facebook_url'  => 'https://www.facebook.com/GerejaSantoYosephMatraman/',
            'instagram_url' => 'https://www.instagram.com/parokimatraman/',
            'youtube_url'   => 'https://www.youtube.com/channel/UCfEc2hTA5qc8APbcYJVIleg/videos',
            'map_embed_src' => 'https://maps.google.com/maps?q=Paroki+Santo+Yoseph+Matraman+Jl+Matraman+Raya+127+Jakarta&z=15&output=embed',
            'whatsapp_no'   => '62811372626',
        ]);
    }
}
