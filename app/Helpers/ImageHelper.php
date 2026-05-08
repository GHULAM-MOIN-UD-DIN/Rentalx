<?php

namespace App\Helpers;

class ImageHelper
{
    /**
     * Get the proper image URL.
     * If image is a full Cloudinary URL (starts with http), return as-is.
     * Otherwise, fall back to local asset path.
     */
    public static function url(?string $image, string $folder = ''): string
    {
        if (empty($image)) {
            return asset('images/placeholder.png');
        }

        // If it's already a full URL (Cloudinary), return directly
        if (str_starts_with($image, 'http://') || str_starts_with($image, 'https://')) {
            return $image;
        }

        // Legacy local path fallback
        $path = $folder ? $folder . '/' . $image : $image;
        return asset($path);
    }
}
