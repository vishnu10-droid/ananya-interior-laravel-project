<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        foreach ($this->data('categories.json') as $index => $row) {
            Category::updateOrCreate(
                ['slug' => $row['slug']],
                [
                    'name' => $row['name'],
                    'description' => $row['description'] ?? null,
                    'image' => $row['image'] ?? null,
                    'hover_image' => $row['hoverImage'] ?? null,
                    'types' => $row['types'] ?? [],
                    'brands' => $row['brands'] ?? [],
                    'status' => true,
                    'sort_order' => $index,
                ]
            );
        }
    }

    private function data(string $file): array
    {
        return json_decode(file_get_contents(__DIR__.'/data/'.$file), true) ?: [];
    }
}
