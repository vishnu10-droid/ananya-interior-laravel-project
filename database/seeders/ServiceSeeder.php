<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        foreach ($this->data('services.json') as $index => $row) {
            Service::updateOrCreate(
                ['slug' => $row['id']],
                [
                    'name' => $row['name'],
                    'short_description' => $row['desc'] ?? null,
                    'description' => $row['desc'] ?? null,
                    'image' => $row['image'] ?? null,
                    'icon' => $row['icon'] ?? null,
                    'active' => ($row['status'] ?? 'Active') === 'Active',
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
