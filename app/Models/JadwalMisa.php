<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JadwalMisa extends Model
{
    protected $table = 'jadwal_misa';

    protected $fillable = ['hari_group', 'jam', 'tipe', 'urutan'];

    public const HARI_GROUPS = [
        'Senin — Jumat',
        'Sabtu',
        'Minggu',
        'Jumat Pertama',
    ];

    public const TIPE_OPTIONS = [
        'Misa Harian',
        'Misa Siang',
        'Misa Vigili Minggu',
        'Misa Pertama',
        'Misa Kedua',
        'Misa Ketiga',
        'Misa Sore',
        'Misa Malam',
    ];
}
