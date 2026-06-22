<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ActivityLog extends Model
{
    protected $fillable = [
        'admin_id',
        'admin_name',
        'action',
        'module',
        'target_label',
        'target_id',
        'changes',
        'ip_address',
        'user_agent',
    ];

    protected $casts = [
        'changes' => 'array',
    ];

    // Label warna per aksi untuk badge di view
    public const ACTION_COLORS = [
        'created'  => '#22c55e',   // hijau
        'updated'  => '#3b82f6',   // biru
        'deleted'  => '#ef4444',   // merah
        'login'    => '#a855f7',   // ungu
        'logout'   => '#6b7280',   // abu
        'uploaded' => '#f59e0b',   // kuning
        'download' => '#06b6d4',   // cyan
        'read'     => '#10b981',   // teal
        'unread'   => '#f97316',   // oranye
    ];

    public function admin(): BelongsTo
    {
        return $this->belongsTo(Admin::class);
    }

    public function getActionColorAttribute(): string
    {
        return self::ACTION_COLORS[$this->action] ?? '#6b7280';
    }

    public function getActionLabelAttribute(): string
    {
        $labels = [
            'created'  => 'Tambah',
            'updated'  => 'Perbarui',
            'deleted'  => 'Hapus',
            'login'    => 'Login',
            'logout'   => 'Logout',
            'uploaded' => 'Upload',
            'download' => 'Unduh',
            'read'     => 'Baca',
            'unread'   => 'Tandai Belum Dibaca',
        ];

        return $labels[$this->action] ?? ucfirst($this->action);
    }
}
