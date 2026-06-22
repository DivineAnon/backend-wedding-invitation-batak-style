<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Pengumuman extends Model
{
    protected $table = 'pengumuman';

    protected $fillable = [
        'judul',
        'kategori',
        'isi',
        'tanggal',
        'foto',
        'is_pinned',
        'is_active',
    ];

    protected $casts = [
        'tanggal'   => 'date',
        'is_pinned' => 'boolean',
        'is_active' => 'boolean',
    ];

    public const KATEGORI_PILIHAN = [
        'Jadwal Misa',
        'Sakramen',
        'Kegiatan',
        'Pelayanan',
        'Sosial',
        'Administrasi',
        'Keuangan',
        'Pengumuman Umum',
    ];

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    public function scopePinned(Builder $query): Builder
    {
        return $query->where('is_pinned', true);
    }
}
