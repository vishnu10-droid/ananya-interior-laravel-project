<?php

namespace Database\Seeders;

use App\Models\Blog;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class BlogSeeder extends Seeder
{
    public function run(): void
    {
        foreach ($this->data('blogs.json') as $index => $row) {
            Blog::updateOrCreate(
                ['slug' => $row['id']],
                [
                    'title' => $row['title'],
                    'thumbnail' => $row['image'] ?? null,
                    'content' => $row['body'] ?? null,
                    'author' => 'Ananya Interior',
                    'category' => $row['category'] ?? null,
                    'highlights' => $row['highlights'] ?? [],
                    'seo_title' => $row['title'],
                    'meta_description' => $row['excerpt'] ?? null,
                    'published' => true,
                    'published_at' => $this->date($row['date'] ?? null),
                ]
            );
        }
    }

    private function date(?string $value): ?Carbon
    {
        if (! $value) {
            return null;
        }

        try {
            return Carbon::createFromFormat('d M Y', $value)->startOfDay();
        } catch (\Throwable) {
            return null;
        }
    }

    private function data(string $file): array
    {
        return json_decode(file_get_contents(__DIR__.'/data/'.$file), true) ?: [];
    }
}
