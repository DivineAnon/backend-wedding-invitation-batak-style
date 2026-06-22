<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IntensiMisa extends Model
{
    protected $table = 'intensi_misa';

    protected $fillable = [
        'nomor_wa',
        'pesan',
    ];

    /**
     * Ambil data intensi misa (selalu satu baris).
     */
    public static function getData(): self
    {
        return static::firstOrCreate([], [
            'nomor_wa' => '6281234567890',
            'pesan'    => 'Halo, saya ingin mendaftarkan Intensi Misa.',
        ]);
    }
}
