<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PastorPage extends Model
{
    protected $table = 'pastor_page';

    protected $fillable = [
        'hero_image',
        'accent_text',
    ];
}
