<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UnduhanPage extends Model
{
    protected $table = 'unduhan_page';
    
    protected $fillable = [
        'hero_image',
    ];
}
