<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Unduhan extends Model
{
    protected $table = 'unduhan';

    public const KATEGORI = [
        'dokumen' => 'Dokumen Biasa',
        'ebook'   => 'Ebook',
    ];

    protected $fillable = [
        'judul',
        'deskripsi',
        'kategori',
        'nama_file',
        'original_name',
        'mime_type',
        'ukuran',
        'link',
        'urutan',
    ];

    /** Short format label derived from file extension (or LINK for ebook). */
    public function getFormatLabelAttribute(): string
    {
        if ($this->kategori === 'ebook') return 'LINK';
        $ext = strtolower(pathinfo($this->nama_file ?? '', PATHINFO_EXTENSION));
        return match ($ext) {
            'pdf'                       => 'PDF',
            'doc', 'docx'              => 'DOC',
            'xls', 'xlsx'              => 'XLS',
            'csv'                       => 'CSV',
            'png', 'jpg', 'jpeg',
            'webp', 'gif'              => 'IMG',
            default                     => strtoupper($ext) ?: 'FILE',
        };
    }

    /** Hex colour for the format badge. */
    public function getFormatColorAttribute(): string
    {
        if ($this->kategori === 'ebook') return '#e67e22';
        $ext = strtolower(pathinfo($this->nama_file ?? '', PATHINFO_EXTENSION));
        return match ($ext) {
            'pdf'                       => '#e74c3c',
            'doc', 'docx'              => '#2980b9',
            'xls', 'xlsx'              => '#27ae60',
            'csv'                       => '#16a085',
            'png', 'jpg', 'jpeg',
            'webp', 'gif'              => '#8e44ad',
            default                     => '#7f8c8d',
        };
    }

    /** Human-readable file size, or empty string for ebook (link-only). */
    public function getUkuranFormatAttribute(): string
    {
        if ($this->kategori === 'ebook') return '';
        $bytes = $this->ukuran;
        if ($bytes >= 1_048_576) return round($bytes / 1_048_576, 1) . ' MB';
        if ($bytes >= 1_024)     return round($bytes / 1_024, 1) . ' KB';
        return $bytes . ' B';
    }
}
