<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Sejarah extends Model
{
    protected $table = 'sejarah';

    protected $fillable = [
        'hero_image',
        'accent_text',
        'label',
        'year',
        'body',
        'source',
    ];

    protected function casts(): array
    {
        return [
            'body' => 'array',
        ];
    }

    public function milestones(): HasMany
    {
        return $this->hasMany(SejarahMilestone::class)->orderBy('urutan');
    }
}
