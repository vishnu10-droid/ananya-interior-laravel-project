<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\PublicController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PublicController::class, 'home'])->name('home');
Route::get('/about', [PublicController::class, 'about'])->name('about');
Route::get('/services', [PublicController::class, 'services'])->name('services');
Route::get('/services/{id}', [PublicController::class, 'serviceDetail'])->name('service.detail');
Route::get('/products', [PublicController::class, 'products'])->name('products');
Route::get('/products/{slug}', [PublicController::class, 'productDetails'])->name('product.detail');
Route::get('/brands', [PublicController::class, 'brands'])->name('brands');
Route::get('/categories', [PublicController::class, 'categories'])->name('categories');
Route::get('/categories/{slug}', [PublicController::class, 'categories'])->name('category.detail');
Route::get('/blog', [PublicController::class, 'blog'])->name('blog');
Route::get('/contact', [PublicController::class, 'contact'])->name('contact');
Route::post('/contact/enquiry', [PublicController::class, 'storeEnquiry'])->name('contact.enquiry');

Route::get('/robots.txt', fn () => response(
    "User-agent: *\nAllow: /\n\nSitemap: ".url('/sitemap.xml')."\n",
    200,
    ['Content-Type' => 'text/plain']
));

Route::get('/sitemap.xml', function () {
    $urls = collect(['/', '/about', '/services', '/products', '/brands', '/categories', '/blog', '/contact'])
        ->merge(\App\Models\Product::active()->pluck('slug')->map(fn ($s) => '/products/'.$s))
        ->merge(\App\Models\Category::active()->pluck('slug')->map(fn ($s) => '/categories/'.$s))
        ->merge(\App\Models\Service::active()->pluck('slug')->map(fn ($s) => '/services/'.$s));

    $xml = '<?xml version="1.0" encoding="UTF-8"?>'."\n".'<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">'."\n";
    foreach ($urls as $path) {
        $xml .= '  <url><loc>'.e(url($path)).'</loc></url>'."\n";
    }
    $xml .= '</urlset>';

    return response($xml, 200, ['Content-Type' => 'application/xml']);
});

/* Laravel's auth middleware redirects to the "login" route name. */
Route::get('/login', fn () => redirect()->route('admin.login'))->name('login');

/* ---------------- Admin authentication ---------------- */
Route::get('/admin/login', [AuthController::class, 'showLogin'])->name('admin.login');
Route::post('/admin/login', [AuthController::class, 'login'])->name('admin.login.post');
Route::post('/admin/logout', [AuthController::class, 'logout'])->name('admin.logout');

/* ---------------- Protected admin panel ---------------- */
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    $modules = [
        'products' => 'product-manager',
        'categories' => 'category-manager',
        'brands' => 'brand-manager',
        'customers' => 'enquiry-manager',
        'testimonials' => 'testimonial-manager',
        'blogs' => 'blog-manager',
        'analytics' => 'analytics-panel',
        'settings' => 'settings-manager',
        'users' => 'user-manager',
    ];

    foreach ($modules as $slug => $component) {
        Route::get('/'.$slug, fn () => view('admin.module', ['component' => $component]))->name($slug);
    }
});
