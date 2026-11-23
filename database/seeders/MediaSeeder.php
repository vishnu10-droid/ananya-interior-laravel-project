<?php

namespace Database\Seeders;

use App\Models\Media;
use Illuminate\Database\Seeder;

class MediaSeeder extends Seeder
{
    public function run(): void
    {
        $data = $this->data('media.json');
        $paths = [];

        foreach ($data as $group => $items) {
            foreach ($items as $path) {
                if (! is_string($path) || $path === '' || in_array($path, $paths, true)) {
                    continue;
                }
                $paths[] = $path;

                Media::firstOrCreate(
                    ['path' => $path],
                    [
                        'filename' => basename(parse_url($path, PHP_URL_PATH) ?: $path),
                        'alt_text' => ucfirst(str_replace('-', ' ', $group)),
                        'mime_type' => $this->mime($path),
                        'folder' => $group,
                    ]
                );
            }
        }
    }

    private function mime(string $path): string
    {
        $extension = strtolower(pathinfo(parse_url($path, PHP_URL_PATH) ?: $path, PATHINFO_EXTENSION));

        return match ($extension) {
            'png' => 'image/png',
            'jpg', 'jpeg' => 'image/jpeg',
            'svg' => 'image/svg+xml',
            'mp4' => 'video/mp4',
            default => 'application/octet-stream',
        };
    }

    private function data(string $file): array
    {
        return json_decode(file_get_contents(__DIR__.'/data/'.$file), true) ?: [];
    }
}
