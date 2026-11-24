<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['filename', 'path', 'alt_text', 'title', 'category', 'meta', 'mime_type', 'size', 'folder'])]
class Media extends Model
{
    protected function casts(): array
    {
        return ['meta' => 'array'];
    }
}
