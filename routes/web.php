<?php

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
