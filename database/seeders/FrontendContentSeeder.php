<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Media;
use App\Models\Project;
use App\Models\Setting;
use App\Models\Testimonial;
use Illuminate\Database\Seeder;

class FrontendContentSeeder extends Seeder
{
    public function run(): void
    {
        $catalogue = require app_path('Support/catalogue.php');
        $content = require app_path('Support/frontend_content.php');

        /* Group assignments for the shop filter pills. */
        $groupFor = [];
        foreach ($catalogue['filters'] as $filter) {
            foreach ($filter['ids'] ?? [] as $id) {
                $groupFor[$id] = $filter['label'];
            }
        }

        foreach ($catalogue['categories'] as $index => $row) {
            $category = Category::where('slug', $row['slug'])->first();
            if (! $category) {
                continue;
            }

            $featured = $content['featured_categories'][$row['slug']] ?? null;
            $looks = $content['category_looks'][$row['slug']] ?? $content['category_looks']['_default'];

            $category->update([
                'group' => $groupFor[$row['slug']] ?? null,
                'features' => $row['features'] ?? [],
                'applications' => $row['applications'] ?? [],
                'variants' => $featured['variants'] ?? [],
                'pdf_page' => $row['pdfPage'] ?? null,
                'featured' => (bool) $featured,
                'tag' => $featured['tag'] ?? null,
                'note' => $featured['note'] ?? null,
                'look_one_image' => $looks[0]['image'],
                'look_one_caption' => $looks[0]['caption'],
                'look_two_image' => $looks[1]['image'],
                'look_two_caption' => $looks[1]['caption'],
                'sort_order' => $index,
            ]);
        }

        /* Keep the product PDF references in sync with their category. */
        foreach (Category::pluck('pdf_page', 'id') as $categoryId => $pdfPage) {
            Category::find($categoryId)->products()->update(['pdf_page' => $pdfPage]);
        }

        /* The eight brand logos that appear in the scrolling marquees. */
        Brand::query()->update(['featured' => false]);
        foreach ($content['featured_brands'] as $name) {
            Brand::where('name', $name)->update(['featured' => true]);
        }

        foreach ($content['project_highlights'] as $slug => $highlights) {
            Project::where('slug', $slug)->update(['highlights' => $highlights]);
        }

        foreach ($content['testimonials'] as $row) {
            Testimonial::where('name', $row['name'])->update([
                'image' => $row['image'],
                'date' => $row['date'],
            ]);
        }

        /* Gallery + reel media are managed from Admin → Media. */
        foreach ($content['showcase'] as $index => $row) {
            Media::updateOrCreate(
                ['path' => $row['src']],
                [
                    'filename' => basename(parse_url($row['src'], PHP_URL_PATH) ?: $row['src']),
                    'alt_text' => $row['title'],
                    'title' => $row['title'],
                    'category' => $row['category'],
                    'mime_type' => 'image/jpeg',
                    'folder' => 'showcase',
                    'size' => null,
                    'meta' => null,
                ]
            );
        }

        foreach ($content['reels'] as $index => $row) {
            Media::updateOrCreate(
                ['path' => $row['src']],
                [
                    'filename' => basename($row['src']),
                    'alt_text' => $row['title'],
                    'title' => $row['title'],
                    'category' => null,
                    'mime_type' => 'video/mp4',
                    'folder' => 'reels',
                    'size' => null,
                    'meta' => [
                        'caption' => $row['caption'],
                        'overlay' => $row['overlay'],
                        'tip' => $row['tip'],
                    ],
                ]
            );
        }

        Setting::set('stats_about', json_encode($content['stats']['about']), 'content');
        Setting::set('stats_contact', json_encode($content['stats']['contact']), 'content');
    }
}
