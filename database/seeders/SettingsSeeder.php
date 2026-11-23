<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingsSeeder extends Seeder
{
    public function run(): void
    {
        $settings = $this->data('settings.json');

        $values = [
            'site_name' => 'Ananya Interior',
            'site_email' => 'contact@ananyadesigns.com',
            'phone' => $settings['phone'] ?? null,
            'phone_link' => $settings['phone_link'] ?? null,
            'whatsapp' => $settings['whatsapp'] ?? null,
            'maps_url' => $settings['maps'] ?? null,
            'address' => $settings['address'] ?? null,
            'display_centre' => $settings['display_centre'] ?? null,
            'godown' => $settings['godown'] ?? null,
            'mobile' => $settings['mobile'] ?? null,
            'website' => $settings['website'] ?? null,
            'footer_description' => 'Premium residential and commercial interior design studio in Agra — modern, elegant and functional spaces.',
            'instagram_url' => 'https://www.instagram.com/',
            'facebook_url' => 'https://www.facebook.com/',
            'youtube_url' => 'https://www.youtube.com/',
            'linkedin_url' => 'https://www.linkedin.com/',
            'seo_title' => 'Ananya Interior | Agra',
            'seo_description' => 'Ananya Interior — Premium interior design studio in Agra. Home interiors, modular kitchens, offices & renovations.',
            'seo_keywords' => 'interior design Agra, plywood, laminates, veneers, modular kitchen, Ananya Interior',
        ];

        foreach (($settings['images'] ?? []) as $key => $path) {
            $values['image_'.$key] = $path;
        }

        foreach ($values as $key => $value) {
            Setting::set($key, $value, str_starts_with($key, 'image_') ? 'images' : 'general');
        }
    }

    private function data(string $file): array
    {
        return json_decode(file_get_contents(__DIR__.'/data/'.$file), true) ?: [];
    }
}
