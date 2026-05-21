<?php

namespace App\Services;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class ImageServices
{
    protected $manager;

    public function __construct()
    {
        $this->manager = new ImageManager(new Driver());
    }

    public function storeImage($image, $sizes = ['150x150', '300x300', '1024x1024'])
    {
        $filename = Str::random(20);
        $folder = date('Y/m'); // WordPress style
        $disk = Storage::disk(env('FILESYSTEM_DISK'));

        $generatedImages = [];

        // Read original image
        $img = $this->manager->read($image);

        // Save original
        $originalPath = "$folder/$filename.webp";
        $disk->put($originalPath, (string) $img->toWebp(90));

        foreach ($sizes as $size) {
            [$width, $height] = explode('x', $size);

            $resized = $this->manager->read($image)
                ->cover((int)$width, (int)$height);

            $resizedPath = "$folder/$filename-$size.webp";

            $disk->put($resizedPath, (string) $resized->toWebp(90));

            $generatedImages[$size] = $resizedPath;
        }

        return [
            'original' => $originalPath,
            'sizes' => $generatedImages,
            // 'url' => $disk->url($originalPath) // direct access URL
        ];
    }
}
