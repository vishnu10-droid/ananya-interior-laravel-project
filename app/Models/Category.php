<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

#[Fillable(['name', 'slug', 'description', 'image', 'hover_image', 'icon', 'types', 'brands', 'features', 'applications', 'variants', 'pdf_page', 'group', 'featured', 'tag', 'note', 'look_one_image', 'look_one_caption', 'look_two_image', 'look_two_caption', 'status', 'sort_order'])]
class Category extends Model
{
    protected function casts(): array
    {
        return [
            'types' => 'array',
            'brands' => 'array',
            'features' => 'array',
            'applications' => 'array',
            'variants' => 'array',
            'status' => 'boolean',
            'featured' => 'boolean',
        ];
    }

    protected static function booted(): void
    {
        static::creating(function (Category $category) {
            if (empty($category->slug)) {
                $category->slug = Str::slug($category->name);
            }
        });
    }

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    public function scopeActive($query)
    {
        return $query->where('status', true);
    }

    public function scopeFeatured($query)
    {
        return $query->where('featured', true);
    }
}
