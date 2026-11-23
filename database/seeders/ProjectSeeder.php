<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\ProjectImage;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    public function run(): void
    {
        foreach ($this->data('projects.json') as $index => $row) {
            $project = Project::updateOrCreate(
                ['slug' => $row['id']],
                [
                    'title' => $row['name'],
                    'category' => $row['category'] ?? null,
                    'location' => $row['location'] ?? null,
                    'date' => $row['date'] ?? null,
                    'description' => $row['description'] ?? null,
                    'image' => $row['image'] ?? null,
                    'featured' => $index < 3,
                    'published' => true,
                    'sort_order' => $index,
                ]
            );

            foreach (($row['gallery'] ?? []) as $imageIndex => $path) {
                ProjectImage::firstOrCreate([
                    'project_id' => $project->id,
                    'path' => $path,
                ], [
                    'alt_text' => $project->title,
                    'sort_order' => $imageIndex,
                ]);
            }
        }
    }

    private function data(string $file): array
    {
        return json_decode(file_get_contents(__DIR__.'/data/'.$file), true) ?: [];
    }
}
