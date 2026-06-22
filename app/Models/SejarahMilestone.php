<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SejarahMilestone extends Model
{
    protected $fillable = [
        'sejarah_id',
        'tahun',
        'judul',
        'deskripsi',
        'urutan',
    ];

    public function sejarah(): BelongsTo
    {
        return $this->belongsTo(Sejarah::class);
    }
}
