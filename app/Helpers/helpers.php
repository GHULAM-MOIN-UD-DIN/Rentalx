<?php

/**
 * Get image URL - supports both Cloudinary URLs and legacy local paths.
 * If the image starts with http/https, it's a Cloudinary URL - return as-is.
 * Otherwise, prepend the local asset folder path.
 *
 * @param string|null $image
 * @param string $folder  Local folder fallback (e.g. 'products', 'car_images')
 * @return string
 */
if (!function_exists('img_url')) {
    function img_url(?string $image, string $folder = ''): string
    {
        if (empty($image)) {
            return asset('images/placeholder.png');
        }

        // Cloudinary URL - return directly
        if (str_starts_with($image, 'http://') || str_starts_with($image, 'https://')) {
            return $image;
        }

        // Legacy local path
        $path = $folder ? $folder . '/' . $image : $image;
        return asset($path);
    }
}
