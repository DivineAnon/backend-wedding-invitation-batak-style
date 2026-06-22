<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RenunganPage extends Model
{
    protected $table = 'renungan_page';
    
    protected $fillable = [
        'hero_image',
        'accent_text',
    ];
}
