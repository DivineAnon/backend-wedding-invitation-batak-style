<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VisiMisi extends Model
{
    protected $table = 'visi_misi';

    protected $fillable = [
        'visi',
        'misi_intro',
        'misi_pillars',
        'spiritualitas',
        'nilai_nilai',
        'hero_image',
        'accent_text',
    ];

    protected $casts = [
        'misi_pillars' => 'array',
        'nilai_nilai'  => 'array',
    ];
}
