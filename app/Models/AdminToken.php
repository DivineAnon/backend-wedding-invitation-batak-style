<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdminToken extends Model
{
    protected $fillable = ['admin_id', 'token', 'expires_at'];

    protected $casts = ['expires_at' => 'datetime'];

    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }

    public function isExpired(): bool
    {
        return $this->expires_at && $this->expires_at->isPast();
    }
}
