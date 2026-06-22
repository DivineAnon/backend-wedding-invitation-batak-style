<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sakramen extends Model
{
    protected $table = 'sakramen';

    protected $fillable = [
        'slug',
        'hero_image',
        'accent_text',
        'judul',
        'deskripsi',
        'sections',
        'kontak_nama',
        'kontak_telepon',
        'kontak_email',
        'kontak_catatan',
        'unduhan',
    ];

    protected $casts = [
        'sections' => 'array',
        'unduhan'  => 'array',
    ];
}
