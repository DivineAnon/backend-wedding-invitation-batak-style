<?php

namespace App\Services;

use App\Models\ActivityLog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

class ActivityLogger
{
    /**
     * Catat aksi CRUD ke tabel activity_logs.
     *
     * @param  string  $action  'created' | 'updated' | 'deleted' | 'login' | 'logout' | dll
     * @param  string  $module  Nama modul/fitur, e.g. 'Berita', 'Pastor'
     * @param  string|null  $targetLabel  Judul / label item yang dikenai aksi
     * @param  int|null  $targetId  ID record (jika ada)
     * @param  array|null  $changes  Diff data untuk aksi 'updated': ['before'=>[], 'after'=>[]]
     */
    public static function log(
        string $action,
        string $module,
        ?string $targetLabel = null,
        ?int $targetId = null,
        ?array $changes = null
    ): void {
        $admin = Auth::guard('admin')->user();

        // Superadmin tidak dicatat di log
        if ($admin && $admin->is_superadmin) {
            return;
        }

        ActivityLog::create([
            'admin_id' => $admin?->id,
            'admin_name' => $admin ? $admin->nama_lengkap : 'System',
            'action' => $action,
            'module' => $module,
            'target_label' => $targetLabel,
            'target_id' => $targetId,
            'changes' => $changes,
            'ip_address' => Request::ip(),
            'user_agent' => mb_substr(Request::userAgent() ?? '', 0, 255),
        ]);
    }

    // ── Shorthand helpers ───────────────────────────────────────────────────

    public static function created(string $module, string $label, int $id): void
    {
        self::log('created', $module, $label, $id);
    }

    public static function updated(string $module, string $label, int $id, array $before, array $after): void
    {
        // Hanya simpan field yang benar-benar berubah
        $changed = [];
        foreach ($after as $key => $newVal) {
            $oldVal = $before[$key] ?? null;
            if ($oldVal != $newVal) {
                $changed[$key] = ['before' => $oldVal, 'after' => $newVal];
            }
        }

        self::log('updated', $module, $label, $id, $changed ?: null);
    }

    public static function deleted(string $module, string $label, int $id): void
    {
        self::log('deleted', $module, $label, $id);
    }

    public static function login(string $adminName): void
    {
        self::log('login', 'Autentikasi', $adminName);
    }

    public static function logout(string $adminName): void
    {
        self::log('logout', 'Autentikasi', $adminName);
    }
}
