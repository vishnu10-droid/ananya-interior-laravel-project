<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['filename', 'path', 'alt_text', 'mime_type', 'size', 'folder'])]
class Media extends Model
{
    //
}
