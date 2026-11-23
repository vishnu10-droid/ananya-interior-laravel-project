<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class BrandSeeder extends Seeder
{
    public function run(): void
    {
        $data = $this->data('brands.json');
        $logos = [];

        foreach (($data['logos'] ?? []) as $logo) {
            $logos[Str::lower($logo['name'])] = $logo['image'];
        }

        foreach (($data['names'] ?? []) as $index => $name) {
            $slug = Str::slug($name);
            $existing = Brand::where('slug', $slug)->first();
            if ($existing && $existing->name !== $name) {
                $slug .= '-2';
            }

            Brand::updateOrCreate(
                ['slug' => $slug],
                [
                    'name' => $name,
                    'logo' => $logos[Str::lower($name)] ?? null,
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
