<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['name', 'designation', 'image', 'review', 'rating', 'approved', 'sort_order'])]
class Testimonial extends Model
{
    protected function casts(): array
    {
        return ['approved' => 'boolean'];
    }

    public function scopeApproved($query)
    {
        return $query->where('approved', true);
    }
}
