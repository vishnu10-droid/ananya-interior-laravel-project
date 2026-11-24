<?php

namespace App\Livewire\Admin;

use App\Models\Setting;
use Livewire\Component;

class SettingsManager extends Component
{
    public array $values = [];

    public function mount(): void
    {
        $this->values = Setting::all()->pluck('value', 'key')->toArray();
    }

    public function save(): void
    {
        $this->validate(['values' => 'array']);
        foreach ($this->values as $key => $value) {
            Setting::set($key, $value);
        }
        session()->flash('message', 'Settings saved to the database.');
    }

    public function render()
    {
        $groups = [
            'Contact' => ['site_name', 'site_email', 'office_name', 'office_name_hi', 'phone', 'phone_link', 'whatsapp', 'mobile', 'address', 'display_centre', 'godown', 'maps_url', 'maps_embed', 'website'],
            'Social' => ['instagram_url', 'facebook_url', 'youtube_url', 'linkedin_url'],
            'SEO' => ['seo_title', 'seo_description', 'seo_keywords'],
            'Footer' => ['footer_description'],
            'Content' => ['stats_about', 'stats_contact'],
        ];

        return view('livewire.admin.settings-manager', ['groups' => $groups]);
    }
}
