<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['key', 'value', 'group'])]
class Setting extends Model
{
    public static function get(string $key, ?string $default = null): ?string
    {
        return static::where('key', $key)->value('value') ?? $default;
    }

    public static function set(string $key, ?string $value, string $group = 'general'): void
    {
        static::updateOrCreate(['key' => $key], ['value' => $value, 'group' => $group]);
    }

    /** Split the configured phone list into clickable tel: links. */
    public static function phones(): array
    {
        $value = (string) static::get('phone', '');

        return collect(preg_split('/\s*(?:\/|,|\|)\s*/', $value))
            ->map(fn ($phone) => trim((string) $phone))
            ->filter()
            ->map(fn ($phone) => [
                'label' => $phone,
                'tel' => 'tel:'.preg_replace('/[^\d+]/', '', $phone),
            ])
            ->values()
            ->all();
    }
}
