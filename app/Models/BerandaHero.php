<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BerandaHero extends Model
{
    protected $table = 'beranda_hero';

    protected $fillable = [
        'hero_image',
        'tagline',
        'card_title',
        'card_desc',
        'button_text',
        'button_link',
    ];
}
