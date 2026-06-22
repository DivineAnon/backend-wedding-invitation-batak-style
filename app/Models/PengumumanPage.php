<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PengumumanPage extends Model
{
    protected $table = 'pengumuman_page';

    protected $fillable = [
        'hero_image',
        'accent_text',
    ];
}
