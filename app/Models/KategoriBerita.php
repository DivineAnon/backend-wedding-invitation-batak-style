<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class KategoriBerita extends Model
{
    protected $table = 'kategori_berita';

    protected $fillable = ['nama', 'slug'];

    protected static function booted(): void
    {
        static::creating(function (self $model) {
            if (empty($model->slug)) {
                $model->slug = Str::slug($model->nama);
            }
        });

        static::updating(function (self $model) {
            if ($model->isDirty('nama')) {
                $model->slug = Str::slug($model->nama);
            }
        });
    }

    public function berita(): HasMany
    {
        return $this->hasMany(Berita::class, 'kategori_berita_id');
    }
}
