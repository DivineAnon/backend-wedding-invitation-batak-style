<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;

class CloudinaryService
{
    /**
     * Upload a file to Cloudinary and return the secure URL.
     *
     * @param  UploadedFile  $file
     * @param  string        $folder  Sub-folder inside parokimatraman/ (e.g. 'beranda', 'berita')
     * @return string Cloudinary secure URL
     */
    public static function upload(UploadedFile $file, string $folder): string
    {
        $result = cloudinary()->uploadApi()->upload($file->getRealPath(), [
            'folder'        => 'parokimatraman/' . $folder,
            'resource_type' => 'auto',
        ]);

        return $result['secure_url'];
    }

    /**
     * Delete a Cloudinary asset by its stored secure URL.
     * Safely skips if the value is empty or not a Cloudinary URL
     * (backward-compatible with old local filenames stored in DB).
     *
     * @param  string|null  $url  Value stored in the database field
     */
    public static function destroy(?string $url): void
    {
        if (empty($url) || !str_contains($url, 'res.cloudinary.com')) {
            return;
        }

        // URL pattern:
        //   https://res.cloudinary.com/{cloud}/{type}/upload/v{version}/{public_id}.{ext}
        // We extract {type} and {public_id} (without extension) for the API call.
        if (preg_match(
            '#res\.cloudinary\.com/[^/]+/(image|video|raw)/upload/(?:v\d+/)?(.+?)(?:\.[^./]+)?$#',
            $url,
            $m
        )) {
            try {
                cloudinary()->uploadApi()->destroy($m[2], ['resource_type' => $m[1]]);
            } catch (\Exception $e) {
                \Log::warning('CloudinaryService::destroy failed: ' . $e->getMessage(), ['url' => $url]);
            }
        }
    }
}
