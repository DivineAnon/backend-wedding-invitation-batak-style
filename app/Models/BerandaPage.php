<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BerandaPage extends Model
{
    protected $table = 'beranda_page';

    protected $fillable = [
        // Jadwal Misa
        'jadwal_label',
        'jadwal_title',
        // Sejarah
        'sejarah_label',
        'sejarah_body1',
        'sejarah_body2',
        'sejarah_quote',
        'sejarah_button_text',
        // Renungan
        'renungan_eyebrow',
        'renungan_title',
        'renungan_title_em',
        'renungan_sub',
        'renungan_cta',
        // Berita
        'berita_label',
        'berita_title',
        'berita_cta',
        // Pengumuman
        'pengumuman_eyebrow',
        'pengumuman_title',
        'pengumuman_cta',
        // Footer
        'footer_brand',
        'footer_tagline',
        'footer_copyright',
    ];
}
