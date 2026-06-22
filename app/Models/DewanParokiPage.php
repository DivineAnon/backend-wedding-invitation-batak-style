<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DewanParokiPage extends Model
{
    protected $table = 'dewan_paroki_page';

    protected $fillable = [
        'hero_image',
        'accent_text',
    ];
}
