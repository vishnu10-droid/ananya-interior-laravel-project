<?php

namespace App\Livewire\Admin;

use App\Models\Category;
use App\Models\Enquiry;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class AnalyticsPanel extends Component
{
    public function render()
    {
        $monthly = Enquiry::select(
            DB::raw("DATE_FORMAT(created_at, '%b %Y') as label"),
            DB::raw('COUNT(*) as total')
        )->groupBy('label')->orderByRaw('MIN(created_at)')->limit(8)->get();

        $byStatus = Enquiry::select('status', DB::raw('COUNT(*) as total'))
            ->groupBy('status')->pluck('total', 'status');

        $byCategory = Category::withCount('products')->orderByDesc('products_count')->take(6)->get();

        return view('livewire.admin.analytics-panel', [
            'monthly' => $monthly,
            'byStatus' => $byStatus,
            'byCategory' => $byCategory,
            'totals' => [
                'products' => Product::count(),
                'enquiries' => Enquiry::count(),
            ],
        ]);
    }
}
