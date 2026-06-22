<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BeritaPage extends Model
{
    protected $table = 'berita_page';

    protected $fillable = [
        'hero_image',
        'accent_text',
    ];
}
