<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $categories = Category::all()->keyBy('slug');
        $brands = Brand::all()->keyBy(fn ($brand) => Str::lower($brand->name));

        foreach ($this->data('products.json') as $index => $row) {
            $category = $categories->get($row['categorySlug'] ?? '');
            if (! $category) {
                continue;
            }

            $brandName = Str::lower($row['brands'][0] ?? '');
            $brand = $brands->get($brandName);

            $product = Product::updateOrCreate(
                ['slug' => Str::slug($row['name'])],
                [
                    'category_id' => $category->id,
                    'brand_id' => $brand?->id,
                    'name' => $row['name'],
                    'short_description' => $row['description'] ?? null,
                    'description' => 'Best for '.($row['bestFor'] ?? ''),
                    'features' => array_filter([$row['bestFor'] ?? null]),
                    'image' => $row['image'] ?? $category->image,
                    'hover_image' => $category->hover_image,
                    'pdf_page' => $category->pdf_page,
                    'active' => true,
                    'sort_order' => $index,
                ]
            );

            if ($product->wasRecentlyCreated && $product->image) {
                ProductImage::create([
                    'product_id' => $product->id,
                    'path' => $product->image,
                    'alt_text' => $product->name,
                    'sort_order' => 0,
                ]);
            }
        }
    }

    private function data(string $file): array
    {
        return json_decode(file_get_contents(__DIR__.'/data/'.$file), true) ?: [];
    }
}
