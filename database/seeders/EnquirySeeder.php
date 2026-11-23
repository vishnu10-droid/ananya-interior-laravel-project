<?php

namespace Database\Seeders;

use App\Models\Enquiry;
use Illuminate\Database\Seeder;

class EnquirySeeder extends Seeder
{
    public function run(): void
    {
        $statuses = [
            'New' => 'new',
            'Contacted' => 'contacted',
            'In Progress' => 'in_progress',
            'Completed' => 'converted',
        ];

        foreach ($this->data('leads.json') as $row) {
            Enquiry::updateOrCreate(
                ['name' => $row['name'], 'phone' => $row['phone']],
                [
                    'project_type' => $row['type'] ?? null,
                    'message' => 'Budget: '.($row['budget'] ?? '').' · Date: '.($row['date'] ?? ''),
                    'status' => $statuses[$row['status'] ?? 'New'] ?? 'new',
                    'source' => 'demo',
                ]
            );
        }
    }

    private function data(string $file): array
    {
        return json_decode(file_get_contents(__DIR__.'/data/'.$file), true) ?: [];
    }
}
