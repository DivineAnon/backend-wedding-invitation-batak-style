<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PhotoBooth extends Model
{
    protected $fillable = ['guest_id', 'guest_name', 'image_path', 'caption', 'is_approved'];

    protected $casts = ['is_approved' => 'boolean'];

    public function guest()
    {
        return $this->belongsTo(Guest::class);
    }
}
