<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Enquiry;
use App\Models\Product;
use App\Models\Project;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $chart = Enquiry::select(
            DB::raw("DATE_FORMAT(created_at, '%b %Y') as label"),
            DB::raw('COUNT(*) as total')
        )
            ->groupBy('label')
            ->orderByRaw('MIN(created_at)')
            ->limit(8)
            ->get();

        return view('admin.dashboard', [
            'stats' => [
                'products' => Product::count(),
                'categories' => Category::count(),
                'brands' => Brand::count(),
                'enquiries' => Enquiry::count(),
                'new' => Enquiry::where('status', 'new')->count(),
                'followups' => Enquiry::whereNotNull('follow_up_at')->where('follow_up_at', '<=', now())->count(),
                'projects' => Project::count(),
                'blogs' => Blog::count(),
            ],
            'chart' => $chart,
            'recentEnquiries' => Enquiry::latest()->take(5)->get(),
            'recentProjects' => Project::latest()->take(5)->get(),
            'popularCategories' => Category::withCount('products')->orderByDesc('products_count')->take(5)->get(),
        ]);
    }
}
