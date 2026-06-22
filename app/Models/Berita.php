<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class Berita extends Model
{
    protected $table = 'berita';

    protected $fillable = [
        'kategori_berita_id',
        'judul',
        'slug',
        'ringkasan',
        'penulis',
        'isi',
        'gambar',
        'cover',
        'media_type',
        'video_path',
        'youtube_url',
        'status',
        'published_at',
    ];

    protected function casts(): array
    {
        return [
            'published_at' => 'datetime',
        ];
    }

    protected static function booted(): void
    {
        static::creating(function (self $model) {
            if (empty($model->slug)) {
                $model->slug = Str::slug($model->judul);
            }
        });

        static::updating(function (self $model) {
            if ($model->isDirty('judul') && empty($model->getOriginal('slug'))) {
                $model->slug = Str::slug($model->judul);
            }
        });
    }

    public function kategori(): BelongsTo
    {
        return $this->belongsTo(KategoriBerita::class, 'kategori_berita_id');
    }

    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }
}
