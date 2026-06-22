<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Wedding extends Model
{
    protected $fillable = [
        'couple_name_1', 'couple_name_2',
        'marga_1', 'marga_2',
        'bio_1', 'bio_2',
        'photo_1', 'photo_2',
        'akad_date', 'akad_time', 'akad_venue', 'akad_address', 'akad_maps_url',
        'resepsi_date', 'resepsi_time', 'resepsi_venue', 'resepsi_address',
        'maps_url', 'love_story', 'cover_image',
        'music_url', 'music_title', 'is_active',
    ];

    protected $casts = [
        'akad_date'   => 'date',
        'resepsi_date' => 'date',
        'is_active'   => 'boolean',
    ];
}
