<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Story extends Model
{
    protected $fillable = [
        'title', 'title_en', 'event_date',
        'description', 'description_en',
        'image_path', 'order',
    ];

    protected $casts = ['event_date' => 'date'];
}
