<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pastor extends Model
{
    protected $fillable = [
        'nama',
        'ordo',
        'jabatan',
        'periode_mulai',
        'periode_selesai',
        'bio',
        'foto',
        'urutan',
    ];
}
