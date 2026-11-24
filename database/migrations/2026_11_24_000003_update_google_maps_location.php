<?php

use App\Models\Setting;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /** New "Ananya Endless Decor" Google Maps location (lat, lng). */
    private const DESTINATION = '27.1990526%2C78.0058476';

    public function up(): void
    {
        Setting::set('maps_url', 'https://www.google.com/maps/dir/?api=1&destination='.self::DESTINATION, 'general');
        Setting::set('maps_embed', 'https://www.google.com/maps?q='.self::DESTINATION.'&z=17&output=embed', 'general');
    }

    public function down(): void
    {
        Setting::set('maps_url', 'https://www.google.com/maps/dir/?api=1&destination=Mangal+Sen+Bhawan%2C+21%2F18%2C+Freeganj+Rd%2C+Belanganj%2C+Civil+Lines%2C+Agra%2C+Uttar+Pradesh+282003', 'general');
        Setting::set('maps_embed', 'https://www.google.com/maps?q=Mangal+Sen+Bhawan%2C+21%2F18%2C+Freeganj+Rd%2C+Belanganj%2C+Civil+Lines%2C+Agra%2C+Uttar+Pradesh+282003&output=embed', 'general');
    }
};
