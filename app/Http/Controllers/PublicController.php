<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Enquiry;
use App\Models\Product;
use App\Models\Project;
use App\Models\Service;
use App\Models\Setting;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PublicController extends Controller
{
    public function home()
    {
        return view('pages.home', [
            'categories' => Category::active()->orderBy('sort_order')->get(),
            'brands' => Brand::active()->whereNotNull('logo')->orderBy('sort_order')->get(),
            'services' => Service::active()->orderBy('sort_order')->get(),
            'projects' => Project::published()->orderBy('sort_order')->get(),
            'testimonials' => Testimonial::approved()->orderBy('sort_order')->get(),
            'blogs' => Blog::published()->latest('published_at')->get(),
            'products' => Product::active()->featured()->orderBy('sort_order')->get(),
        ]);
    }

    public function about()
    {
        return view('pages.about');
    }

    public function services()
    {
        return view('pages.services', [
            'services' => Service::active()->orderBy('sort_order')->get(),
        ]);
    }

    public function serviceDetail(string $id)
    {
        $service = Service::where('slug', $id)->firstOrFail();

        return view('pages.service-detail', ['service' => $service]);
    }

    public function products(Request $request)
    {
        $query = Product::active()->with(['category', 'brand']);

        if ($request->filled('q')) {
            $term = $request->string('q')->toString();
            $query->where(function ($q) use ($term) {
                $q->where('name', 'like', "%{$term}%")
                    ->orWhere('short_description', 'like', "%{$term}%")
                    ->orWhereHas('brand', fn ($b) => $b->where('name', 'like', "%{$term}%"));
            });
        }

        if ($request->filled('category')) {
            $query->whereHas('category', fn ($c) => $c->where('slug', $request->string('category')->toString()));
        }

        if ($request->string('sort')->toString() === 'name-asc') {
            $query->orderBy('name');
        } elseif ($request->string('sort')->toString() === 'name-desc') {
            $query->orderByDesc('name');
        } else {
            $query->orderBy('sort_order');
        }

        return view('pages.products', [
            'products' => $query->paginate(20)->withQueryString(),
            'categories' => Category::active()->orderBy('sort_order')->get(),
            'brands' => Brand::active()->orderBy('sort_order')->get(),
            'services' => Service::active()->orderBy('sort_order')->get(),
            'projects' => Project::published()->orderBy('sort_order')->get(),
            'testimonials' => Testimonial::approved()->orderBy('sort_order')->get(),
        ]);
    }

    public function productDetails(string $slug)
    {
        $product = Product::where('slug', $slug)->firstOrFail();

        return view('pages.product-details', [
            'product' => $product,
            'related' => Product::active()->where('category_id', $product->category_id)
                ->where('id', '!=', $product->id)->limit(8)->get(),
        ]);
    }

    public function brands()
    {
        return view('pages.brands', [
            'brands' => Brand::active()->orderBy('sort_order')->get(),
        ]);
    }

    public function categories(?string $slug = null)
    {
        $categories = Category::active()->orderBy('sort_order')->get();
        $active = $slug ? Category::where('slug', $slug)->firstOrFail() : $categories->first();

        return view('pages.categories', [
            'categories' => $categories,
            'active' => $active,
            'products' => $active ? Product::active()->where('category_id', $active->id)->orderBy('sort_order')->get() : collect(),
            'brands' => Brand::active()->orderBy('sort_order')->get(),
        ]);
    }

    public function blog()
    {
        return view('pages.blog', [
            'blogs' => Blog::published()->latest('published_at')->get(),
        ]);
    }

    public function contact()
    {
        return view('pages.contact');
    }

    public function storeEnquiry(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:120',
            'phone' => 'required|string|max:20|regex:/^[0-9+\s-]{8,15}$/',
            'email' => 'nullable|email|max:160',
            'type' => 'nullable|string|max:120',
            'role' => 'required|string|max:120',
            'city' => 'nullable|string|max:120',
            'area' => 'nullable|string|max:160',
            'pincode' => 'nullable|digits:6',
            'requirements' => 'nullable|string|max:160',
            'message' => 'required|string',
        ]);

        Enquiry::create([
            'name' => $validated['name'],
            'phone' => $validated['phone'],
            'email' => $validated['email'] ?? null,
            'project_type' => $validated['type'] ?? null,
            'profession' => $validated['role'],
            'city' => $validated['city'] ?? null,
            'area' => $validated['area'] ?? null,
            'pincode' => $validated['pincode'] ?? null,
            'requirements' => $validated['requirements'] ?? null,
            'message' => $validated['message'],
            'source' => 'contact',
        ]);

        return redirect()->route('contact')->with('enquiry_sent', true)->with('enquiry_name', $validated['name']);
    }
}
