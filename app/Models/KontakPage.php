<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KontakPage extends Model
{
    protected $table = 'kontak_page';
    
    protected $fillable = [
        'hero_image',
        'accent_text',
    ];
}
