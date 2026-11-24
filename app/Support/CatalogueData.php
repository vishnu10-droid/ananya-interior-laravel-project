<?php

namespace App\Support;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;

/* Builds the catalogue payload the public Blade pages consume. Everything is
   read from MySQL, so admin add/edit/delete changes show up immediately. */
class CatalogueData
{
    /** Display names used by the category hero (kept as labels, not content). */
    private const RANGE_NAMES = [
        'plywood' => 'Plywood & Block Boards',
        'doors' => 'Doors',
        'decorative-laminate' => 'Decorative Laminates',
        'veneers' => 'Decorative Veneers',
        'decmore-wall-panels' => 'Interior Wall Cladding',
    ];

    public static function data(): array
    {
        $categories = Category::active()->with('products.images')->orderBy('sort_order')->get();

        return [
            'filters' => self::filters($categories),
            'categories' => self::categories($categories),
            'allProducts' => self::products($categories),
            'productRange' => self::productRange($categories),
            'featuredBrands' => self::featuredBrands(),
            'allBrands' => self::allBrands(),
            'productImages' => self::productImages($categories),
        ];
    }

    public static function filters($categories): array
    {
        $groups = $categories->pluck('group')->filter()->unique()->values()->all();

        $filters = [['label' => 'All', 'ids' => null]];
        foreach ($groups as $group) {
            $filters[] = [
                'label' => $group,
                'ids' => $categories->where('group', $group)->pluck('slug')->values()->all(),
            ];
        }

        return $filters;
    }

    private static function categories($categories): array
    {
        return $categories->map(fn (Category $category) => [
            'id' => $category->slug,
            'name' => $category->name,
            'slug' => $category->slug,
            'description' => $category->description,
            'types' => $category->types ?? [],
            'features' => $category->features ?? [],
            'applications' => $category->applications ?? [],
            'brands' => $category->brands ?? [],
            'image' => $category->image ?: '/images/company-profile/page-06-image-01.png',
            'hoverImage' => $category->hover_image ?: $category->image,
            'pdfPage' => $category->pdf_page,
            'pdfImageCount' => 6,
            'look_one_image' => $category->look_one_image,
            'look_one_caption' => $category->look_one_caption,
            'look_two_image' => $category->look_two_image,
            'look_two_caption' => $category->look_two_caption,
        ])->values()->all();
    }

    private static function products($categories): array
    {
        return $categories->flatMap(function (Category $category) {
            return $category->products->where('active', true)->map(function (Product $product) use ($category) {
                $brand = $product->brand?->name ?? ($category->brands[0] ?? 'Premium');

                return [
                    'id' => $product->slug,
                    'name' => $product->name,
                    'description' => $product->short_description ?? $product->description,
                    'bestFor' => $product->features[0] ?? null,
                    'image' => $product->image ?: $category->image,
                    'categoryName' => $category->name,
                    'categorySlug' => $category->slug,
                    'guideId' => $category->slug,
                    'brands' => array_values(array_unique(array_filter([
                        $brand,
                        ...($category->brands ?? []),
                    ]))),
                ];
            });
        })->values()->all();
    }

    private static function productRange($categories): array
    {
        return $categories->map(fn (Category $category) => [
            'name' => self::RANGE_NAMES[$category->slug] ?? $category->name,
            'image' => $category->image,
            'brands' => $category->brands ?? [],
        ])->values()->all();
    }

    public static function featuredBrands(): array
    {
        return Brand::active()->where('featured', true)->orderBy('sort_order')
            ->get(['name', 'logo'])
            ->map(fn (Brand $brand) => [
                'name' => $brand->name,
                'image' => $brand->logo,
            ])->values()->all();
    }

    public static function allBrands(): array
    {
        return Brand::active()->orderBy('sort_order')->pluck('name')->all();
    }

    private static function productImages($categories): array
    {
        $images = [];

        foreach ($categories as $category) {
            $paths = array_values(array_unique(array_filter([
                $category->image,
                $category->hover_image,
                ...$category->products->flatMap(fn (Product $product) => [
                    $product->image,
                    ...$product->images->pluck('path')->all(),
                ])->all(),
            ])));

            $images[$category->slug] = array_slice($paths, 0, 6) ?: [$category->image];
        }

        return $images;
    }
}
