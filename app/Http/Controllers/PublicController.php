<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Enquiry;
use App\Models\Media;
use App\Models\Product;
use App\Models\Project;
use App\Models\Service;
use App\Models\Setting;
use App\Models\Testimonial;
use App\Support\CatalogueData;
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

            /* Every block below is DB-backed — add/edit/delete in the admin
               panel immediately changes what the home page renders. */
            'featuredBrands' => Brand::active()->where('featured', true)->orderBy('sort_order')
                ->get()->map(fn ($brand) => [
                    'name' => $brand->name,
                    'image' => $brand->logo,
                ])->all(),

            'featured' => Category::active()->featured()->orderBy('sort_order')
                ->get()->map(fn ($category) => [
                    'name' => $category->name,
                    'slug' => $category->slug,
                    'tag' => $category->tag ?: 'The Edit',
                    'note' => $category->note ?: $category->description,
                    'image' => $category->image ?: '/images/company-profile/page-06-image-01.png',
                    'details' => $category->description,
                    'features' => $category->features ?? [],
                    'variants' => $category->variants ?? [],
                    'brands' => $category->brands ?? [],
                ])->all(),

            'showcase' => Media::where('folder', 'showcase')->orderBy('id')
                ->get()->map(fn ($media) => [
                    'src' => $media->path,
                    'title' => $media->title ?: $media->alt_text,
                    'category' => $media->category,
                ])->all(),

            'featuredProjects' => Project::published()->where('featured', true)
                ->with('images')->orderBy('sort_order')->get()->map(fn ($project) => [
                    'name' => $project->title,
                    'category' => $project->category,
                    'location' => $project->location,
                    'image' => $project->image,
                    'description' => $project->description,
                    'highlights' => $project->highlights ?? [],
                    'gallery' => $project->images->pluck('path')->all() ?: [$project->image],
                ])->all(),

            'stories' => Testimonial::approved()->orderBy('sort_order')
                ->get()->map(fn ($review) => [
                    'name' => $review->name,
                    'location' => $review->designation,
                    'date' => $review->date ?: $review->created_at?->format('M Y'),
                    'rating' => (int) $review->rating,
                    'avatar' => $review->image ?: 'https://images.unsplash.com/photo-1535713875002-d1d0cf377fde?w=400&h=400&fit=crop&crop=faces',
                    'text' => $review->review,
                ])->all(),

            'blogPosts' => Blog::published()->latest('published_at')
                ->get()->map(fn ($post) => [
                    'id' => $post->slug,
                    'title' => $post->title,
                    'category' => $post->category,
                    'filter' => $this->blogFilter($post->category),
                    'date' => $post->published_at?->format('j M Y'),
                    'image' => $post->thumbnail,
                    'excerpt' => $post->meta_description,
                    'body' => $post->content,
                    'highlights' => $post->highlights ?? [],
                ])->all(),

            'reels' => Media::where('folder', 'reels')->orderBy('id')
                ->get()->map(fn ($media) => [
                    'title' => $media->title ?: $media->alt_text,
                    'src' => $media->path,
                    'caption' => $media->meta['caption'] ?? null,
                    'overlay' => $media->meta['overlay'] ?? null,
                    'tip' => $media->meta['tip'] ?? null,
                ])->all(),
        ]);
    }

    private function blogFilter(?string $category): string
    {
        return match (true) {
            str_contains((string) $category, 'Kitchen') => 'materials space',
            str_contains((string) $category, 'Bedroom') => 'design trends',
            str_contains((string) $category, 'Workspace') => 'space trends',
            default => 'design materials',
        };
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
        $product = Product::where('slug', $slug)->first();

        /* The reference site routes product details by CATEGORY slug
           (e.g. /products/plywood) and picks an individual item with ?item=. */
        if (! $product) {
            $data = CatalogueData::data();
            $reactCategory = collect($data['categories'])->firstWhere('slug', $slug);
            if (! $reactCategory) {
                abort(404);
            }

            $reactProducts = collect($data['allProducts']);
            $itemId = request('item') ?: request('product');

            return view('pages.product-details', [
                'product' => null,
                'related' => collect(),
                'reactCategory' => $reactCategory,
                'selectedItem' => $itemId ? $reactProducts->firstWhere('id', $itemId) : null,
                'categoryProducts' => $reactProducts->where('categorySlug', $slug)->values(),
            ]);
        }

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
