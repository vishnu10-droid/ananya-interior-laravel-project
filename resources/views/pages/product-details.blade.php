@extends('layouts.app')
@section('title', ($title ?? ($product->name ?? 'Product')).' | Ananya Interior')
@section('content')
@php
    /* Database-backed catalogue (admin-managed). */
    $data            = \App\Support\CatalogueData::data();
    $reactCategories = collect($data['categories']);
    $reactProducts   = collect($data['allProducts']);

    $phone         = \App\Models\Setting::get('phone', '+91 7351400063 / +91 90847 27055');
    $phoneLink     = \App\Models\Setting::get('phone_link', 'tel:+917351400063');
    $displayCentre = \App\Models\Setting::get('display_centre', 'G-8 Kailash Tower, Near ICICI Bank, Sanjay Place, Agra - 282002');
    $address       = \App\Models\Setting::get('address', 'Mangal Sen Bhawan, 21/18, Freeganj Rd, Belanganj, Civil Lines, Agra, Uttar Pradesh 282003');

    $reactCategory    = $reactCategory ?? null;
    $selectedItem     = $selectedItem ?? null;
    $categoryProducts = $categoryProducts ?? collect();

    $category = $product?->category;
    $rc       = $reactCategory ?: $reactCategories->firstWhere('slug', optional($category)->slug);
    $rp       = $product ? $reactProducts->firstWhere('name', $product->name) : $selectedItem;

    $title       = $product->name ?? ($selectedItem['name'] ?? ($rc['name'] ?? 'Products'));
    $description = $product ? ($product->short_description ?: $product->description)
                 : ($selectedItem['description'] ?? ($rc['description'] ?? ''));
    $fallbackImg = '/images/company-profile/page-06-image-01.png';
    $heroImage   = ($product && $product->image) ? $product->image
                 : ($selectedItem['image'] ?? ($rc['image'] ?? $fallbackImg));

    $catName     = $rc['name'] ?? ($category->name ?? 'Products');
    $catTypes    = $rc['types'] ?? (is_array($category->types ?? null) ? $category->types : []);
    $catFeatures = $rc['features'] ?? (($product && is_array($product->features ?? null)) ? $product->features : []);
    $catApps     = $rc['applications'] ?? ['Residential interiors', 'Commercial spaces', 'Furniture &amp; joinery', 'Renovation projects'];
    $catBrands   = $rc['brands'] ?? [];

    if (empty($catBrands)) {
        if ($product?->brand) { $catBrands[] = $product->brand->name; }
        if ($category && is_array($category->brands)) {
            foreach ($category->brands as $brandName) {
                if (! in_array($brandName, $catBrands, true)) { $catBrands[] = $brandName; }
            }
        }
    }

    $bestFor = $rp['bestFor'] ?? null;

    if ($product) {
        /* Product Range gallery — [product, ...related], with the product's own
           images used as the category-style fallback when nothing else is related. */
        $gallery = collect([$product])->merge($related)->values();
        $galleryItems = $gallery->map(function ($item) use ($product, $fallbackImg) {
            return [
                'id'       => (string) $item->id,
                'item'     => (string) $item->id,
                'dom_id'   => 'product-'.$item->id,
                'name'     => $item->name,
                'image'    => $item->image ?: $fallbackImg,
                'href'     => $item->slug ? '/products/'.$item->slug : null,
                'selected' => (int) $item->id === (int) $product->id,
            ];
        });

        if ($galleryItems->count() <= 1 && $product->images->count() > 0) {
            $extraImages = $product->images;
            $imageItems  = $extraImages->map(function ($image, $i) use ($extraImages, $catTypes, $catName) {
                return [
                    'id'       => 'product-'.$i,
                    'item'     => 'product-'.$i,
                    'dom_id'   => 'product-'.$i,
                    'name'     => $catTypes[$i] ?? ($extraImages->count() > 1 ? $catName.' '.($i + 1) : $catName),
                    'image'    => $image->path,
                    'href'     => null,
                    'selected' => false,
                ];
            });
            $galleryItems = $galleryItems->merge($imageItems)->values();
        }
    } else {
        /* Category route (/products/{categorySlug}) — same gallery from the
           exact React catalogue data, with the ?item= selection highlighted. */
        $galleryItems = $categoryProducts->map(function ($item) use ($selectedItem, $fallbackImg) {
            return [
                'id'       => (string) $item['id'],
                'item'     => (string) $item['id'],
                'dom_id'   => 'product-'.$item['id'],
                'name'     => $item['name'],
                'image'    => $item['image'] ?: $fallbackImg,
                'href'     => '/products/'.$item['categorySlug'].'?item='.rawurlencode($item['id']),
                'selected' => $selectedItem && $item['id'] === $selectedItem['id'],
            ];
        })->values();
    }

    $relatedCategories = $reactCategories
        ->filter(fn ($c) => ($c['slug'] ?? null) !== ($rc['slug'] ?? null))
        ->take(6)
        ->values();
@endphp

{{-- DARK SPLIT HERO --}}
<section class="relative overflow-hidden bg-[#1C1109] text-[#F7EEDF]">
    {{-- ambient gold glow + hairline framing --}}
    <div class="pointer-events-none absolute -left-32 -top-24 h-96 w-96 rounded-full bg-[#D9B45B]/[0.07] blur-3xl"></div>
    <div class="pointer-events-none absolute -bottom-40 right-0 h-96 w-96 rounded-full bg-[#D9B45B]/[0.05] blur-3xl"></div>
    <div class="absolute inset-x-0 top-0 h-px bg-gradient-to-r from-transparent via-[#D9B45B]/35 to-transparent"></div>

    <div class="relative mx-auto grid max-w-7xl gap-10 px-5 pb-14 pt-10 md:px-8 lg:grid-cols-[1.05fr_0.95fr] lg:items-center lg:gap-14 lg:pb-16 lg:pt-14">
        {{-- copy --}}
        <div class="motion-in-right" style="--d:.08s">
            <nav class="flex flex-wrap items-center gap-1.5 text-[11px] text-[#D9CBB4]/70" aria-label="Breadcrumb">
                <a href="/" class="hover:text-[#D9B45B]">Home</a>
                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="text-[#8A6A46]" aria-hidden="true"><path d="m9 18 6-6-6-6"/></svg>
                <a href="/products" class="hover:text-[#D9B45B]">Products</a>
                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="text-[#8A6A46]" aria-hidden="true"><path d="m9 18 6-6-6-6"/></svg>
                <span class="text-[#F4E4C6]">{{ $catName }}</span>
            </nav>

            <div class="mt-9 flex items-center gap-3">
                <span class="h-px w-10 bg-[#D9B45B]"></span>
                <p class="text-[10px] font-medium uppercase tracking-[0.3em] text-[#D9B45B]">The Collection &middot; Premium Materials</p>
            </div>

            <h1 class="mt-4 font-serif text-[40px] leading-[1.05] text-[#FBF3E7] sm:text-5xl lg:text-[56px]">{{ $title }}</h1>
            <p class="mt-4 max-w-xl text-[13px] leading-relaxed text-[#D9CBB4]">{{ $description }}</p>
            <p class="mt-3 text-[11px] font-medium uppercase tracking-[0.16em] text-[#D9B45B]">Part of the {{ $catName }} collection</p>
            @if ($bestFor)
                <p class="mt-2 max-w-xl text-[12px] leading-relaxed text-[#D9CBB4]/85"><span class="font-medium text-[#F4E4C6]">Best for:</span> {{ $bestFor }}</p>
            @endif

            @if (count($catBrands) > 0)
                <div class="mt-6 flex flex-wrap items-center gap-2">
                    <span class="mr-1 text-[10px] uppercase tracking-[0.2em] text-[#D9CBB4]/55">Featured brands</span>
                    @foreach (array_slice($catBrands, 0, 4) as $brand)
                        <span class="rounded-full border border-[#D9B45B]/25 bg-[#D9B45B]/5 px-3 py-1 text-[10px] tracking-wide text-[#F4E4C6]">{{ $brand }}</span>
                    @endforeach
                </div>
            @endif

            <div class="mt-8 flex flex-wrap items-center gap-3">
                <a href="#category-products" class="group inline-flex items-center gap-2 rounded-full bg-[#D9B45B] px-6 py-3 text-[11px] font-semibold uppercase tracking-[0.1em] text-[#24160D] transition-colors hover:bg-[#F0D48A]">
                    Explore the collection
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="transition-transform duration-300 group-hover:translate-y-0.5"><path d="M12 5v14m-6-6 6 6 6-6"/></svg>
                </a>
                <a href="/products" class="inline-flex items-center gap-2 rounded-full border border-[#D9B45B]/45 px-6 py-3 text-[11px] font-medium uppercase tracking-[0.1em] text-[#F4E4C6] transition-colors hover:bg-[#D9B45B]/10">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 12H5m6 6-6-6 6-6"/></svg>
                    All products
                </a>
            </div>
        </div>

        {{-- image --}}
        <div class="relative h-[280px] sm:h-[340px] lg:h-[440px] motion-in-left" style="--d:.16s">
            <div class="absolute inset-0 overflow-hidden rounded-2xl border border-[#D9B45B]/20 shadow-[0_30px_80px_-30px_rgba(0,0,0,0.8)]">
                <img src="{{ $heroImage }}" alt="{{ $title }}" loading="lazy" class="h-full w-full object-cover object-center">
                <div class="absolute inset-0 bg-gradient-to-t from-[#1C1109]/45 via-transparent to-transparent"></div>
            </div>

            {{-- decorative gold arc + circular material close-up --}}
            <svg class="pointer-events-none absolute -left-6 -top-6 h-[120%] w-[120%]" viewBox="0 0 500 500" fill="none" aria-hidden="true">
                <path d="M -20 380 C 90 120, 360 -20, 520 120" stroke="#D9B45B" stroke-width="1" opacity="0.55" />
                <path d="M 40 430 C 140 230, 340 150, 500 220" stroke="#D9B45B" stroke-width="0.8" opacity="0.35" />
            </svg>
            <div class="absolute -bottom-5 -left-5 hidden h-24 w-24 overflow-hidden rounded-full border-[3px] border-[#D9B45B] shadow-[0_0_30px_rgba(217,180,91,0.35)] sm:block">
                <img src="{{ $heroImage }}" alt="{{ $title }} detail" loading="lazy" class="h-full w-full scale-150 object-cover object-center">
            </div>
            <span class="absolute -right-3 top-6 hidden rounded-full border border-[#D9B45B]/30 bg-[#140C07]/85 px-4 py-2 font-serif text-[11px] tracking-[0.18em] text-[#F4E4C6] backdrop-blur sm:block">THE EDIT &middot; 01</span>
        </div>
    </div>
</section>

{{-- DETAILS --}}
<section class="max-w-7xl mx-auto px-5 md:px-8 py-20 md:py-28 grid lg:grid-cols-2 gap-16">
    <div class="space-y-8">
        <div data-reveal="up" class="mb-6">
            <p class="text-[11px] tracking-[0.3em] uppercase text-golddark font-medium mb-3">About {{ $title }}</p>
        </div>
        <p class="text-coffee text-base leading-relaxed" data-reveal="up" data-delay="60">{{ $description }}</p>

        @if (count($catTypes) > 0)
            <div class="bg-beige/50 rounded-2xl p-6 border border-charcoal/5" data-reveal="up">
                <h3 class="font-serif text-lg text-charcoal mb-4">Types &amp; Variants</h3>
                <ul class="grid sm:grid-cols-2 gap-3">
                    @foreach ($catTypes as $type)
                        <li class="flex items-center gap-2.5 text-sm text-charcoal/85"><span class="w-2 h-2 rounded-full bg-golddark"></span>{{ $type }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (count($catFeatures) > 0)
            <div class="bg-white rounded-2xl p-6 shadow-card border border-charcoal/5" data-reveal="up" data-delay="60">
                <h3 class="font-serif text-lg text-charcoal mb-4">Key Features</h3>
                <ul class="grid sm:grid-cols-2 gap-3">
                    @foreach ($catFeatures as $feature)
                        <li class="flex items-center gap-2.5 text-sm text-charcoal/85"><span class="w-2 h-2 rounded-full bg-golddark"></span>{{ $feature }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (count($catApps) > 0)
            <div class="bg-beige/50 rounded-2xl p-6 border border-charcoal/5" data-reveal="up" data-delay="120">
                <h3 class="font-serif text-lg text-charcoal mb-4">Applications</h3>
                <div class="flex flex-wrap gap-2.5">
                    @foreach ($catApps as $app)
                        <span class="px-3 py-1.5 rounded-full bg-white text-charcoal text-sm border border-charcoal/10">{!! $app !!}</span>
                    @endforeach
                </div>
            </div>
        @endif
    </div>

    <div class="space-y-8">
        <div class="bg-charcoal rounded-3xl p-8 text-cream" data-reveal="up">
            <h3 class="font-serif text-xl text-cream mb-6">Associated Brands</h3>
            <div class="grid sm:grid-cols-3 gap-4">
                @if (count($catBrands) > 0)
                    @foreach ($catBrands as $brand)
                        <div class="p-4 rounded-xl bg-white/5 border border-white/10 text-center"><p class="text-sm font-medium text-cream/90">{{ $brand }}</p></div>
                    @endforeach
                @else
                    <p class="text-sm text-cream/60">Brand information available upon enquiry.</p>
                @endif
            </div>
        </div>

        <div class="bg-white rounded-3xl p-8 shadow-card border border-charcoal/5" data-reveal="up" data-delay="60">
            <h3 class="font-serif text-xl text-charcoal mb-6">Get More Information</h3>
            <p class="text-coffee mb-6">Have questions about specifications, availability, or pricing? Contact our team.</p>
            <div class="space-y-4">
                <div class="flex items-start gap-3">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#A98548" stroke-width="1.8" class="text-golddark shrink-0 mt-0.5"><path d="M22 16.9v3a2 2 0 0 1-2.2 2 19.8 19.8 0 0 1-8.6-3.1 19.5 19.5 0 0 1-6-6A19.8 19.8 0 0 1 2.1 4.2 2 2 0 0 1 4.1 2h3a2 2 0 0 1 2 1.7c.1 1 .4 2 .7 2.9a2 2 0 0 1-.4 2.1L8.1 9.9a16 16 0 0 0 6 6l1.2-1.2a2 2 0 0 1 2.1-.4c.9.3 1.9.6 2.9.7a2 2 0 0 1 1.7 2z"/></svg>
                    <div>
                        <p class="text-sm text-charcoal/85">Phone</p>
                        <a href="{{ $phoneLink }}" class="font-medium text-golddark hover:underline">{{ \Illuminate\Support\Str::after($phoneLink, 'tel:') ?: $phone }}</a>
                    </div>
                </div>
                <div class="flex items-start gap-3">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#A98548" stroke-width="1.8" class="text-golddark shrink-0 mt-0.5"><path d="M20 10c0 6-8 12-8 12S4 16 4 10a8 8 0 1 1 16 0z"/><circle cx="12" cy="10" r="3"/></svg>
                    <div>
                        <p class="text-sm text-charcoal/85">Display Centre</p>
                        <p class="text-sm text-charcoal/85 leading-relaxed">{{ $displayCentre }}</p>
                    </div>
                </div>
                <div class="flex items-start gap-3">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#A98548" stroke-width="1.8" class="text-golddark shrink-0 mt-0.5"><rect x="3" y="5" width="18" height="14" rx="2"/><path d="m3 7 9 6 9-6"/></svg>
                    <div>
                        <p class="text-sm text-charcoal/85">Head Office</p>
                        <p class="text-sm text-charcoal/85 leading-relaxed">{{ $address }}</p>
                    </div>
                </div>
            </div>
            <a href="/contact" data-shine class="mt-6 inline-flex items-center gap-2 w-full bg-charcoal text-cream px-8 py-3.5 rounded-full text-sm font-medium tracking-wide hover:bg-espresso transition-colors">
                Send Enquiry
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14m-6-6 6 6-6 6"/></svg>
            </a>
        </div>
    </div>
</section>

{{-- AFTER-APPLICATION LOOK — two admin-managed cards --}}
@php
    $lookCards = collect(['one', 'two'])
        ->map(fn ($key) => [
            'image' => $rc['look_'.$key.'_image'] ?? null,
            'caption' => $rc['look_'.$key.'_caption'] ?? null,
        ])
        ->filter(fn ($card) => ! empty($card['image']))
        ->values();
@endphp
@if ($lookCards->isNotEmpty())
    <section class="bg-beige/30 py-16 md:py-20">
        <div class="max-w-7xl mx-auto px-5 md:px-8">
            <div class="mx-auto max-w-2xl text-center">
                <p data-reveal="up" class="text-[11px] tracking-[0.3em] uppercase text-golddark font-medium">In Real Spaces</p>
                <h2 data-reveal="up" data-delay="60" class="font-serif text-3xl leading-tight mt-3 text-charcoal">See {{ $catName }} <em class="italic text-golddark">at work</em></h2>
                <div data-reveal="up" data-delay="100" class="mt-4 h-px w-16 bg-gold mx-auto"></div>
                <p data-reveal="up" data-delay="140" class="mt-4 text-[15px] leading-relaxed text-coffee">A little inspiration for how this material looks once it becomes part of a room.</p>
            </div>

            <div class="mt-10 grid gap-6 sm:grid-cols-2">
                @foreach ($lookCards as $i => $card)
                    <article data-reveal="{{ $i === 0 ? 'left' : 'right' }}" data-delay="{{ $i * 90 }}" class="group">
                        <div class="relative h-[300px] overflow-hidden rounded-2xl bg-charcoal shadow-card sm:h-[360px]">
                            <img src="{{ $card['image'] }}" alt="{{ $card['caption'] ?: ($catName.' in use') }}" loading="lazy" class="h-full w-full object-cover object-center transition-transform duration-700 ease-out group-hover:scale-105">
                            <div class="absolute inset-0 bg-gradient-to-t from-charcoal/85 via-charcoal/10 to-transparent"></div>
                            <span class="absolute left-4 top-4 rounded-full border border-white/20 bg-charcoal/75 px-3 py-1 text-[10px] font-medium uppercase tracking-[0.18em] text-cream backdrop-blur">Look 0{{ $i + 1 }}</span>
                        </div>
                        <div class="mt-4 flex items-start justify-between gap-4">
                            <div>
                                <h3 class="font-serif text-lg leading-snug text-charcoal">{{ $card['caption'] ?: ($catName.' in use') }}</h3>
                                <p class="mt-1 text-xs uppercase tracking-[0.14em] text-coffee">Finished application &middot; {{ $catName }}</p>
                            </div>
                            <a href="/contact" class="shrink-0 inline-flex items-center gap-1.5 rounded-full border border-gold/50 px-4 py-2 text-[11px] font-medium text-golddark transition-colors hover:bg-gold hover:text-charcoal">
                                Get this look
                                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14m-6-6 6 6-6 6"/></svg>
                            </a>
                        </div>
                    </article>
                @endforeach
            </div>
        </div>
    </section>
@endif

{{-- PRODUCT RANGE / CATEGORY PRODUCTS --}}
@if ($galleryItems->isNotEmpty())
    <section id="category-products" class="max-w-7xl mx-auto scroll-mt-24 px-5 md:px-8 pb-16">
        <div class="text-center mx-auto max-w-2xl">
            <p data-reveal="left" data-delay="0" class="text-[11px] tracking-[0.3em] uppercase text-golddark font-medium">Product Range</p>
            <h2 data-reveal="left" data-delay="60" class="font-serif text-3xl md:text-3xl leading-tight mt-3 text-charcoal">More {{ $catName }} Products</h2>
            <div data-reveal="left" data-delay="120" class="mt-4 h-px w-16 bg-gold mx-auto"></div>
            <p data-reveal="left" data-delay="180" class="mt-4 text-[15px] leading-relaxed text-coffee">Other products in this range &mdash; tap any one for its details.</p>
        </div>

        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-5 mt-10">
            @foreach ($galleryItems as $i => $entry)
                @php
                    $openTag  = $entry['href'] ? '<a href="'.e($entry['href']).'" class="block">' : '';
                    $closeTag = $entry['href'] ? '</a>' : '';
                @endphp
                <div id="{{ $entry['dom_id'] }}" data-item="{{ $entry['item'] }}" data-gallery-card data-reveal="up" data-delay="{{ ($i % 6) * 60 }}" class="relative scroll-mt-28 rounded-2xl overflow-hidden bg-white shadow-card border transition-all {{ $entry['selected'] ? 'border-gold ring-2 ring-gold/40' : 'border-charcoal/5' }}">
                    @if ($entry['selected'])
                        <span class="absolute left-3 top-3 z-10 rounded-full bg-charcoal/85 px-3 py-1 text-[10px] font-medium uppercase tracking-wider text-cream">Selected &middot; {{ $entry['name'] }}</span>
                    @endif
                    {!! $openTag !!}
                        <img src="{{ $entry['image'] }}" alt="{{ $entry['name'] }}" loading="lazy" class="w-full h-72 object-contain p-3">
                        <p class="border-t border-charcoal/5 px-4 py-3 text-[13px] font-medium text-charcoal">{{ $entry['name'] }}</p>
                    {!! $closeTag !!}
                </div>
            @endforeach
        </div>
    </section>
@endif

{{-- RELATED CATEGORIES --}}
@if ($relatedCategories->isNotEmpty())
    <section class="bg-beige/40 py-16">
        <div class="max-w-7xl mx-auto px-5 md:px-8">
            <div class="text-center mx-auto max-w-2xl">
                <p data-reveal="right" data-delay="0" class="text-[11px] tracking-[0.3em] uppercase text-golddark font-medium">Related Categories</p>
                <h2 data-reveal="right" data-delay="60" class="font-serif text-3xl md:text-3xl leading-tight mt-3 text-charcoal">You May Also Like</h2>
                <div data-reveal="right" data-delay="120" class="mt-4 h-px w-16 bg-gold mx-auto"></div>
            </div>

            <div class="grid sm:grid-cols-3 lg:grid-cols-4 gap-6 mt-12">
                @foreach ($relatedCategories as $i => $c)
                    @php $direction = ['left', 'up', 'right'][$i % 3]; @endphp
                    <div data-reveal="{{ $direction }}" data-delay="{{ ($i % 3) * 100 }}" class="h-full">
                        <a data-lift href="/products/{{ $c['slug'] }}" class="group flex h-full flex-col overflow-hidden rounded-2xl border border-charcoal/5 bg-white shadow-card transition-all duration-300 hover:-translate-y-1 hover:border-gold/40 hover:shadow-lift">
                            <div class="relative h-44 overflow-hidden bg-beige sm:h-48">
                                <img src="{{ $c['image'] }}" alt="{{ $c['name'] }}" loading="lazy" class="h-full w-full object-cover object-center transition-transform duration-700 ease-out group-hover:scale-110">
                                <span class="absolute bottom-2.5 left-2.5 max-w-[85%] truncate rounded-full border border-white/20 bg-charcoal/85 px-3 py-1 text-[10px] font-medium tracking-wide text-white backdrop-blur">{{ ! empty($c['brands']) ? $c['brands'][0] : 'Premium' }}</span>
                            </div>
                            <div class="flex flex-grow flex-col p-4">
                                <h3 class="font-serif text-lg leading-snug text-charcoal transition-colors group-hover:text-golddark">{{ $c['name'] }}</h3>
                                <p class="mt-2 line-clamp-4 text-[13px] leading-relaxed text-coffee">{{ $c['description'] }}</p>
                                <div class="mt-auto flex min-h-7 items-center justify-between gap-2 border-t border-charcoal/5 pt-3">
                                    <div class="flex min-w-0 flex-wrap gap-1">
                                        @foreach (array_slice($c['brands'] ?? [], 0, 2) as $brand)
                                            <span class="max-w-24 truncate rounded bg-gold/10 px-2 py-1 text-[9px] font-medium text-golddark">{{ $brand }}</span>
                                        @endforeach
                                    </div>
                                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="shrink-0 text-golddark transition-transform duration-300 group-hover:translate-x-1"><path d="M5 12h14m-6-6 6 6-6 6"/></svg>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endif

@push('scripts')
<script>
    (function () {
        /* React parity: bring the selected product into view in the gallery. */
        var scrollToTarget = function (target) {
            if (target) window.setTimeout(function () {
                target.scrollIntoView({ behavior: 'smooth', block: 'center' });
            }, 150);
        };
        var params = new URLSearchParams(window.location.search);
        var item = params.get('item');
        var product = params.get('product');
        var target = null;

        if (item) {
            target = document.getElementById('product-' + item);
            if (!target) {
                document.querySelectorAll('[data-item]').forEach(function (card) {
                    if (!target && card.getAttribute('data-item') === item) target = card;
                });
            }
        }
        if (!target && product !== null) {
            var index = parseInt(product, 10);
            if (!isNaN(index)) {
                var cards = document.querySelectorAll('[data-gallery-card]');
                target = cards[Math.min(Math.max(index, 0), cards.length - 1)] || null;
            }
            if (!target) target = document.getElementById('product-' + product);
        }
        scrollToTarget(target);
    })();
</script>
@endpush
@endsection
