<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable([
    'name', 'phone', 'email', 'project_type', 'profession', 'city', 'area',
    'pincode', 'requirements', 'message', 'status', 'assigned_to', 'follow_up_at', 'source',
])]
class Enquiry extends Model
{
    protected function casts(): array
    {
        return ['follow_up_at' => 'datetime'];
    }

    public function assignee(): BelongsTo
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    public function notes(): HasMany
    {
        return $this->hasMany(EnquiryNote::class)->latest();
    }

    public function scopeNew($query)
    {
        return $query->where('status', 'new');
    }

    public function scopePendingFollowUp($query)
    {
        return $query->whereNotNull('follow_up_at')->where('follow_up_at', '<=', now());
    }
}
