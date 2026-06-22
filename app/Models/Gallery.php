<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    protected $fillable = ['image_path', 'caption', 'order', 'type', 'is_visible'];

    protected $casts = ['is_visible' => 'boolean'];
}
