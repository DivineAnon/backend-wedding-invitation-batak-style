<?php

if (!function_exists('media_url')) {
    /**
     * Resolve a media field to a displayable URL.
     *
     * New uploads store a full Cloudinary secure URL (https://…) in the database.
     * Old/legacy data may still contain just a filename.  This helper handles both:
     *   - Full URL  → returned as-is
     *   - Filename  → prepended with $legacyPath and wrapped in asset()
     *
     * @param  string|null  $field       Value stored in the DB field
     * @param  string       $legacyPath  Asset path prefix for old filenames (e.g. 'assets/berita')
     * @return string
     */
    function media_url(?string $field, string $legacyPath = ''): string
    {
        if (empty($field)) {
            return '';
        }

        $field = trim($field, " \t\n\r\0\x0B\"'");
        
        $lowerField = strtolower($field);
        if (str_starts_with($lowerField, 'http://') || str_starts_with($lowerField, 'https://')) {
            return $field;
        }

        return $legacyPath ? asset($legacyPath . '/' . $field) : asset($field);
    }
}
