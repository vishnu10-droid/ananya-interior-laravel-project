<?php

namespace Database\Seeders;

use App\Models\Testimonial;
use Illuminate\Database\Seeder;

class TestimonialSeeder extends Seeder
{
    public function run(): void
    {
        foreach ($this->data('testimonials.json') as $index => $row) {
            Testimonial::updateOrCreate(
                ['name' => $row['name'], 'review' => $row['text']],
                [
                    'designation' => $row['location'] ?? null,
                    'review' => $row['text'],
                    'rating' => $row['rating'] ?? 5,
                    'approved' => ($row['status'] ?? 'Pending') === 'Approved',
                    'sort_order' => $index,
                ]
            );
        }
    }

    private function data(string $file): array
    {
        return json_decode(file_get_contents(__DIR__.'/data/'.$file), true) ?: [];
    }
}
