<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Role extends Model
{
    protected $fillable = [
        'nama',
        'deskripsi',
        'permissions',
    ];

    protected function casts(): array
    {
        return [
            'permissions' => 'array',
        ];
    }

    /**
     * Daftar semua halaman (modul) yang bisa diatur permission-nya.
     * Key = slug halaman, value = label yang ditampilkan di UI.
     */
    public const PAGES = [
        'dashboard'       => 'Dashboard',
        'beranda'         => 'Hero Beranda',
        'sejarah'         => 'Sejarah',
        'visi-misi'       => 'Visi & Misi',
        'peta-paroki'     => 'Peta Paroki',
        'jam-pelayanan'   => 'Jam Pelayanan',
        'pastor'          => 'Pastor',
        'dewan-paroki'    => 'Dewan Paroki',
        'jadwal-misa'     => 'Jadwal Misa',
        'berita'          => 'Berita',
        'kategori-berita' => 'Kategori Berita',
        'pengumuman'      => 'Pengumuman',
        'renungan'        => 'Renungan',
        'unduhan'         => 'Unduhan',
        'kontak'          => 'Kontak',
        'sakramen'        => 'Sakramen',
        'intensi-misa'    => 'Intensi Misa',
        'inbox'           => 'Inbox',
        'admin-users'     => 'Kelola Admin',
        'role-master'     => 'Role Master',
        'activity-log'    => 'Activity Log',
    ];

    /**
     * Aksi yang tersedia per tipe halaman.
     */
    public const ACTIONS_CRUD      = ['view', 'create', 'edit', 'delete'];
    public const ACTIONS_EDIT_ONLY = ['view', 'edit'];
    public const ACTIONS_VIEW_DELETE = ['view', 'delete'];
    public const ACTIONS_VIEW_ONLY = ['view'];
    public const ACTIONS_BERITA    = ['view', 'create', 'edit', 'delete', 'publish'];
    public const ACTIONS_PENGUMUMAN = ['view', 'create', 'edit', 'delete', 'activate'];
    public const ACTIONS_RENUNGAN  = ['view', 'create', 'edit', 'delete', 'publish'];

    /**
     * Mapping halaman → aksi yang tersedia.
     */
    public const PAGE_ACTIONS = [
        'dashboard'       => self::ACTIONS_VIEW_ONLY,
        'beranda'         => self::ACTIONS_EDIT_ONLY,
        'sejarah'         => self::ACTIONS_EDIT_ONLY,
        'visi-misi'       => self::ACTIONS_EDIT_ONLY,
        'peta-paroki'     => self::ACTIONS_EDIT_ONLY,
        'jam-pelayanan'   => self::ACTIONS_EDIT_ONLY,
        'pastor'          => self::ACTIONS_CRUD,
        'dewan-paroki'    => self::ACTIONS_CRUD,
        'jadwal-misa'     => self::ACTIONS_CRUD,
        'berita'          => self::ACTIONS_BERITA,
        'kategori-berita' => self::ACTIONS_CRUD,
        'pengumuman'      => self::ACTIONS_PENGUMUMAN,
        'renungan'        => self::ACTIONS_RENUNGAN,
        'unduhan'         => self::ACTIONS_CRUD,
        'kontak'          => self::ACTIONS_EDIT_ONLY,
        'sakramen'        => self::ACTIONS_EDIT_ONLY,
        'intensi-misa'    => self::ACTIONS_EDIT_ONLY,
        'inbox'           => self::ACTIONS_VIEW_DELETE,
        'admin-users'     => self::ACTIONS_CRUD,
        'role-master'     => self::ACTIONS_CRUD,
        'activity-log'    => self::ACTIONS_VIEW_ONLY,
    ];

    public const ACTION_LABELS = [
        'view'     => 'Lihat',
        'create'   => 'Tambah',
        'edit'     => 'Edit',
        'delete'   => 'Hapus',
        'publish'  => 'Publish (Berita / Renungan)',
        'activate' => 'Aktifkan (Pengumuman)',
    ];

    public function admins(): BelongsToMany
    {
        return $this->belongsToMany(Admin::class, 'admin_role')->withTimestamps();
    }

    /**
     * Cek apakah role ini memiliki permission tertentu.
     */
    public function hasPermission(string $page, string $action): bool
    {
        $permissions = $this->permissions ?? [];

        return in_array($action, $permissions[$page] ?? []);
    }
}
