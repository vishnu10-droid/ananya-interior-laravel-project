<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

#[Fillable([
    'title', 'slug', 'thumbnail', 'content', 'author', 'category', 'highlights',
    'seo_title', 'meta_description', 'published', 'published_at',
])]
class Blog extends Model
{
    protected function casts(): array
    {
        return [
            'highlights' => 'array',
            'published' => 'boolean',
            'published_at' => 'datetime',
        ];
    }

    protected static function booted(): void
    {
        static::creating(function (Blog $blog) {
            if (empty($blog->slug)) {
                $blog->slug = Str::slug($blog->title);
            }
        });
    }

    public function scopePublished($query)
    {
        return $query->where('published', true);
    }
}
