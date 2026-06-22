<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PetaParoki extends Model
{
    protected $table = 'peta_paroki';

    protected $fillable = [
        'alamat',
        'kota',
        'telepon',
        'faks',
        'email',
        'maps_embed_url',
        'gambar',
        'hero_image',
        'jam_senin_jumat',
        'jam_sabtu',
        'jam_minggu',
        'catatan_pelayanan',
        'accent_text',
    ];
}
