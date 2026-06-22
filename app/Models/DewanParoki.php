<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DewanParoki extends Model
{
    protected $table = 'dewan_paroki';

    protected $fillable = [
        'nama',
        'jabatan',
        'foto',
        'urutan',
    ];
}
