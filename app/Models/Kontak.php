<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kontak extends Model
{
    protected $table = 'kontak';

    protected $fillable = [
        'alamat',
        'alamat_sub',
        'telp',
        'telp_sub',
        'email',
        'email_sub',
        'facebook_url',
        'instagram_url',
        'youtube_url',
        'map_embed_src',
        'whatsapp_no',
    ];

    protected $casts = [];

    /** Always returns the single row, or a default empty instance. */
    public static function getData(): static
    {
        return static::firstOrCreate([], []);
    }
}
