@extends('layouts.app')
@section('title', 'Products | Ananya Interior')
@section('content')
@php
    $data = \App\Support\CatalogueData::data();
    $filters = collect($data['filters']);
    $categories = collect($data['categories']);
    $allProducts = collect($data['allProducts']);

    $whatsapp = \App\Models\Setting::get('whatsapp', 'https://wa.me/917351400063?text=Hi%20Ananya%20Interior%2C%20I%20want%20a%20trade%20consultation.');
    $phoneLink = \App\Models\Setting::get('phone_link', 'tel:+917351400063');
    $heroImage = '/images/company-profile/page-01-image-01.png';
    $kitchenImage = '/images/company-profile/page-04-image-03.png';
    $livingImage = '/images/company-profile/page-23-image-01.png';
    $textureImage = '/images/company-profile/page-25-image-01.png';
    $luxuryImage = '/images/company-profile/page-04-image-01.png';

    $q = trim((string) request('q', ''));
    $groupLabel = (string) request('group', 'All');
    $categorySlug = (string) request('category', '');
    $sort = (string) request('sort', 'featured');
    $view = (string) request('view', '');

    $activeGroup = $filters->firstWhere('label', $groupLabel);
    $selectedCategory = $categories->firstWhere('slug', $categorySlug);
    $term = mb_strtolower($q);

    $visible = $categories->filter(function ($c) use ($categorySlug, $activeGroup, $term) {
        $inGroup = (bool) $categorySlug || ! $activeGroup || ! $activeGroup['ids'] || in_array($c['id'], $activeGroup['ids']);
        $inCategory = ! $categorySlug || $c['slug'] === $categorySlug;
        $matches = ! $term
            || str_contains(mb_strtolower($c['name']), $term)
            || collect($c['brands'])->contains(fn ($b) => str_contains(mb_strtolower($b), $term))
            || collect($c['types'])->contains(fn ($t) => str_contains(mb_strtolower($t), $term));
        return $inGroup && $inCategory && $matches;
    });

    if ($sort === 'name-asc') $visible = $visible->sortBy('name', SORT_NATURAL | SORT_FLAG_CASE)->values();
    if ($sort === 'name-desc') $visible = $visible->sortByDesc('name', SORT_NATURAL | SORT_FLAG_CASE)->values();

    $collectionTitle = $selectedCategory
        ? $selectedCategory['name']
        : ($activeGroup && $activeGroup['label'] !== 'All' ? $activeGroup['label'] : 'Everyday favourites');
    $headingNote = $selectedCategory ? 'collection' : 'for your space';
    $carouselItems = $visible->isNotEmpty() ? $visible : $categories->take(10);

    $slides = [
        ['image' => $heroImage, 'eyebrow' => 'The Ananya Edit', 'title' => 'Materials that make a home', 'text' => 'Plywood, laminates, veneers and finishes chosen for the way you actually live.', 'cta' => 'Shop materials', 'href' => '/products'],
        ['image' => $kitchenImage, 'eyebrow' => 'Kitchen Collection', 'title' => 'Built around the way you cook', 'text' => 'Moisture-resistant boards, easy-clean laminates and hardware that keeps up.', 'cta' => 'Explore kitchen picks', 'href' => '/products?group=Boards%20%26%20Laminates'],
        ['image' => $livingImage, 'eyebrow' => 'Living Spaces', 'title' => 'Warmth in every detail', 'text' => 'Textured veneers, fluted panels and lighting-friendly finishes for calm interiors.', 'cta' => 'Explore living picks', 'href' => '/products?group=Wood%20%26%20Panels'],
        ['image' => $textureImage, 'eyebrow' => 'Surfaces & Finishes', 'title' => 'Beauty you can feel', 'text' => 'Wood-look laminates, veneers and rich textures that bring depth to every surface.', 'cta' => 'Browse finishes', 'href' => '/products?group=Boards%20%26%20Laminates'],
    ];

    $collectionGroups = $filters->filter(fn ($f) => $f['label'] !== 'All')->values();
    $activeCollectionLabel = $collectionGroups->firstWhere('label', $groupLabel) ? $groupLabel : $collectionGroups->first()['label'];
    $activeCollectionIds = $filters->firstWhere('label', $activeCollectionLabel)['ids'] ?? [];
    $collectionList = $categories->filter(fn ($c) => in_array($c['id'], $activeCollectionIds))->values();

    $rooms = [
        ['id' => 'home-interiors', 'name' => 'Home Interiors', 'image' => '/images/company-profile/page-26-image-01.png', 'group' => 'Boards & Laminates'],
        ['id' => 'living-room', 'name' => 'Living Room', 'image' => '/images/company-profile/page-02-image-01.png', 'group' => 'Wood & Panels'],
        ['id' => 'bedroom', 'name' => 'Bedroom', 'image' => '/images/company-profile/page-01-image-01.png', 'group' => 'Doors & WPC'],
        ['id' => 'modular-kitchen', 'name' => 'Modular Kitchen', 'image' => $kitchenImage, 'group' => 'Flooring'],
        ['id' => 'wardrobe', 'name' => 'Wardrobe', 'image' => '/images/company-profile/page-10-image-01.png', 'group' => 'Facade & Ceiling'],
    ];

    $midpoint = (int) ceil($allProducts->count() / 2);
    $rangeRows = [$allProducts->slice(0, $midpoint)->values(), $allProducts->slice($midpoint)->values()];

    $editorials = [
        ['title' => 'Trading a Calm, Luxurious Living Room', 'category' => 'Trade Ideas', 'date' => '12 Jan 2026', 'image' => 'https://images.unsplash.com/photo-1618221195710-dd6b41faaea6?q=80&w=800&auto=format&fit=crop'],
        ['title' => 'The Smart Way to Plan a Modular Kitchen', 'category' => 'Kitchen', 'date' => '28 Oct 2025', 'image' => 'https://images.unsplash.com/photo-1556911220-bff31c812dba?q=80&w=800&auto=format&fit=crop'],
        ['title' => 'Bedroom Retreats: Warm Neutrals That Work', 'category' => 'Bedroom', 'date' => '09 Nov 2025', 'image' => 'https://images.unsplash.com/photo-1616594039964-ae9021a400a0?q=80&w=800&auto=format&fit=crop'],
        ['title' => 'Designing a Focused Home Workspace', 'category' => 'Workspace', 'date' => '27 Sep 2025', 'image' => 'https://images.unsplash.com/photo-1497366216548-37526070297c?q=80&w=800&auto=format&fit=crop'],
    ];

    $stories = [
        ['name' => 'Rohit Sharma', 'location' => 'Agra', 'date' => 'Feb 2026', 'text' => 'Excellent work, planning and explanation. The overall experience was very good. Team understood our needs and finished on time.'],
        ['name' => 'Priya Verma', 'location' => 'Agra', 'date' => 'Jan 2026', 'text' => 'Amazing trade, great experience and beautiful finishing. Our living room now feels like a hotel lounge.'],
        ['name' => 'Amit Agarwal', 'location' => 'Agra', 'date' => 'Jan 2026', 'text' => 'Good work and professional behaviour. Kitchen storage planning is very practical for daily use.'],
    ];
@endphp

{{-- 1. ANNOUNCEMENT BAR --}}
<div class="w-full bg-charcoal text-cream">
    <div class="mx-auto flex max-w-[1600px] flex-wrap items-center justify-center gap-x-6 gap-y-1 px-4 py-2 text-[10px] tracking-[0.14em] text-cream/80 sm:justify-between">
        <span>FREE TRADE CONSULTATION &middot; AGRA &amp; NEARBY</span>
        <span class="hidden items-center gap-5 sm:flex">
            <span class="inline-flex items-center gap-1.5"><svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" class="text-gold"><path d="M3 7h11v10H3zM14 10h4l3 3v4h-7z"/><circle cx="7" cy="18" r="2"/><circle cx="17.5" cy="18" r="2"/></svg> Free site visit</span>
            <span class="inline-flex items-center gap-1.5"><svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" class="text-gold"><path d="M12 3 4 6v6c0 5 3.4 8.5 8 9 4.6-.5 8-4 8-9V6z"/><path d="m9 12 2 2 4-4"/></svg> Genuine brands</span>
            <span class="inline-flex items-center gap-1.5"><svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" class="text-gold"><path d="M3 12a9 9 0 1 0 3-6.7L3 8"/><path d="M3 3v5h5"/></svg> Easy exchange</span>
        </span>
        <a href="{{ $whatsapp }}" target="_blank" rel="noreferrer" class="text-gold hover:underline">Chat with us &rarr;</a>
    </div>
</div>

{{-- 2. CATEGORY NAV STRIP --}}
<section data-drag-scope class="w-full border-b border-charcoal/5 bg-white" aria-label="Shop by product">
    <div class="mx-auto max-w-[1600px] px-4 md:px-8">
        <div class="flex items-center justify-between gap-4 py-3">
            <p class="text-[10px] font-medium uppercase tracking-[0.3em] text-golddark">Product range</p>
            <div class="flex items-center gap-2">
                <a href="/products" class="inline-flex items-center gap-1 rounded-full border border-gold/50 bg-white px-3 py-1.5 text-[11px] font-medium uppercase tracking-[0.12em] text-golddark transition-colors hover:bg-gold hover:text-charcoal">View all <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="m9 18 6-6 6-6"/></svg></a>
                <button type="button" data-drag-prev aria-label="Scroll products left" class="grid h-7 w-7 place-items-center rounded-full border border-charcoal/10 bg-white text-charcoal transition-colors hover:border-gold hover:text-golddark"><svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="m15 18-6-6 6-6"/></svg></button>
                <button type="button" data-drag-next aria-label="Scroll products right" class="grid h-7 w-7 place-items-center rounded-full border border-charcoal/10 bg-white text-charcoal transition-colors hover:border-gold hover:text-golddark"><svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="m9 18 6-6 6-6"/></svg></button>
            </div>
        </div>
        <div data-drag-rail class="no-scrollbar flex cursor-grab gap-3 overflow-x-auto pb-3 active:cursor-grabbing" style="touch-action: pan-x;">
            @foreach ($allProducts as $product)
                <a href="/products/{{ $product['categorySlug'] }}?item={{ $product['id'] }}" class="group relative flex w-[130px] shrink-0 snap-start flex-col gap-2 rounded-xl border bg-white p-2 pb-3 text-center transition-all duration-300 sm:w-[140px] {{ request('item') === $product['id'] ? 'border-gold shadow-card ring-1 ring-gold/40' : 'border-charcoal/5 shadow-sm hover:border-gold/60 hover:shadow-card' }}">
                    <span class="relative block h-[96px] w-full overflow-hidden rounded-lg bg-[#EFE9E1] p-2 sm:h-[104px]">
                        <img src="{{ $product['image'] }}" alt="{{ $product['name'] }}" loading="lazy" draggable="false" class="h-full w-full object-contain object-center transition-transform duration-500 ease-out group-hover:scale-[1.07]">
                    </span>
                    <span class="line-clamp-2 min-h-[34px] font-serif text-[13px] leading-tight transition-colors sm:text-[14px] {{ request('item') === $product['id'] ? 'text-golddark' : 'text-charcoal group-hover:text-golddark' }}">{{ $product['name'] }}</span>
                    @if (request('item') === $product['id'])<span class="absolute inset-x-3 bottom-0 h-[3px] rounded-full bg-gold"></span>@endif
                </a>
            @endforeach
        </div>
    </div>
</section>

{{-- 3. SHOP HERO SLIDER --}}
<section class="w-full bg-cream px-4 py-4 md:px-8 md:py-6" aria-label="Featured collections">
    <div data-hero-slider data-interval="5500" class="relative mx-auto h-[330px] max-w-[1600px] overflow-hidden rounded-xl bg-[#EDE5D9] sm:h-[420px] lg:h-[500px]">
        @foreach ($slides as $index => $slide)
            <div data-slide class="absolute inset-0">
                <img src="{{ $slide['image'] }}" alt="" class="absolute inset-0 h-full w-full object-cover object-center">
                <div class="absolute inset-0 bg-gradient-to-r from-charcoal/80 via-charcoal/30 to-transparent"></div>
                <div class="relative z-10 flex h-full max-w-xl flex-col justify-center px-6 sm:px-10 md:px-14">
                    <p data-slide-caption style="--d:.08s" class="text-[11px] font-medium uppercase tracking-[0.3em] text-gold">{{ $slide['eyebrow'] }}</p>
                    <h2 data-slide-caption style="--d:.14s" class="mt-3 font-serif text-3xl leading-tight text-white sm:text-4xl md:text-5xl">{{ $slide['title'] }}</h2>
                    <p data-slide-caption style="--d:.2s" class="mt-3 max-w-md text-[13px] leading-relaxed text-cream/80 sm:text-sm">{{ $slide['text'] }}</p>
                    <div data-slide-caption style="--d:.26s" class="mt-6">
                        <a href="{{ $slide['href'] }}" class="group inline-flex items-center gap-2 rounded-full bg-gold px-6 py-3 text-[12px] font-semibold uppercase tracking-[0.12em] text-charcoal transition-colors hover:bg-cream">{{ $slide['cta'] }} <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="transition-transform group-hover:translate-x-1"><path d="M5 12h14m-6-6 6 6-6 6"/></svg></a>
                    </div>
                </div>
            </div>
        @endforeach
        <div class="absolute bottom-4 left-1/2 z-10 flex -translate-x-1/2 items-center gap-2">
            @foreach ($slides as $index => $slide)
                <button type="button" data-slide-go aria-label="Go to slide {{ $index + 1 }}" class="{{ $index === 0 ? 'w-7 bg-gold' : 'w-1.5 bg-white/60' }} h-1.5 rounded-full transition-all"></button>
            @endforeach
        </div>
        <button type="button" data-slide-prev aria-label="Previous slide" class="absolute left-3 top-1/2 z-10 grid h-9 w-9 -translate-y-1/2 place-items-center rounded-full bg-white/85 text-charcoal hover:bg-white sm:left-5"><svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="m15 18-6-6 6-6"/></svg></button>
        <button type="button" data-slide-next aria-label="Next slide" class="absolute right-3 top-1/2 z-10 grid h-9 w-9 -translate-y-1/2 place-items-center rounded-full bg-white/85 text-charcoal hover:bg-white sm:right-5"><svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="m9 18 6-6 6-6"/></svg></button>
    </div>
</section>

{{-- 4. PRODUCT CAROUSEL --}}
<section class="bg-cream py-10 md:py-14">
    <div class="mx-auto max-w-[1600px] px-4 md:px-8">
        <p class="text-[10px] font-semibold uppercase tracking-[0.28em] text-golddark">{{ $selectedCategory ? 'Selected category' : 'The collection' }}</p>
        <div class="mt-2 flex flex-wrap items-end justify-between gap-3">
            <h2 class="font-serif text-2xl text-charcoal md:text-3xl">{{ $collectionTitle }} <em class="italic text-golddark">{{ $headingNote }}</em></h2>
            <div class="flex items-center gap-2">
                <button type="button" data-scroll-to="catalogue" class="mr-2 text-[11px] uppercase tracking-[0.14em] text-golddark hover:underline">View all</button>
                <button type="button" data-drag-prev aria-label="Scroll products left" class="grid h-8 w-8 place-items-center rounded-full border border-charcoal/10 bg-white text-charcoal hover:border-gold"><svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="m15 18-6-6 6-6"/></svg></button>
                <button type="button" data-drag-next aria-label="Scroll products right" class="grid h-8 w-8 place-items-center rounded-full border border-charcoal/10 bg-white text-charcoal hover:border-gold"><svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="m9 18 6-6 6-6"/></svg></button>
            </div>
        </div>
        <div data-drag-scope>
            <div data-drag-rail class="no-scrollbar mt-6 flex snap-x gap-3 overflow-x-auto pb-2">
                @foreach ($carouselItems as $i => $card)
                    <div data-slide-card class="w-[62%] shrink-0 snap-start sm:w-[45%] md:w-[30%] lg:w-[19%]">
                        @include('partials.shop-product-card', ['card' => $card, 'index' => $i, 'compact' => true])
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

{{-- 5. CATALOGUE --}}
<section id="catalogue" class="scroll-mt-24 bg-white py-10 md:py-14">
    <div class="mx-auto max-w-[1600px] px-4 md:px-8">
        <p class="text-[10px] font-semibold uppercase tracking-[0.28em] text-golddark" data-reveal="up">The catalogue</p>
        <div class="mt-2 flex flex-wrap items-end justify-between gap-3">
            <h2 class="font-serif text-2xl text-charcoal md:text-3xl" data-reveal="up" data-delay="60">Explore <em class="italic text-golddark">materials</em></h2>
            <p class="text-[11px] text-stonewarm">{{ $visible->count() }} result{{ $visible->count() === 1 ? '' : 's' }}</p>
        </div>

        <div class="mt-6 flex flex-col gap-4">
            <div class="no-scrollbar flex gap-2 overflow-x-auto pb-1">
                @foreach ($filters as $filter)
                    <a href="{{ $filter['label'] === 'All' ? '/products' : '/products?group='.rawurlencode($filter['label']) }}" class="shrink-0 rounded-full px-4 py-2 text-[11px] tracking-wide transition-all {{ $groupLabel === $filter['label'] && ! $categorySlug ? 'bg-charcoal text-cream' : 'border border-charcoal/10 text-coffee hover:border-gold' }}">{{ $filter['label'] }}</a>
                @endforeach
            </div>
            <form method="GET" action="/products" class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                @if ($groupLabel !== 'All')<input type="hidden" name="group" value="{{ $groupLabel }}">@endif
                @if ($categorySlug)<input type="hidden" name="category" value="{{ $categorySlug }}">@endif
                <label class="relative block w-full max-w-sm">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="pointer-events-none absolute left-3.5 top-1/2 -translate-y-1/2 text-stonewarm"><circle cx="11" cy="11" r="7"/><path d="m20 20-4-4"/></svg>
                    <input type="search" name="q" value="{{ $q }}" placeholder="Search a material or brand" class="w-full rounded-full border border-charcoal/10 bg-cream py-2.5 pl-10 pr-4 text-[13px] text-charcoal">
                    <button type="submit" class="sr-only">Search</button>
                </label>
                <label class="flex items-center gap-2 text-[11px] text-coffee">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="text-golddark"><path d="M4 6h16M7 12h10m-7 6h4"/></svg>
                    <span class="sr-only">Sort products</span>
                    <select name="sort" onchange="this.form.submit()" class="rounded-full border border-charcoal/10 bg-white px-4 py-2 text-[12px] text-charcoal">
                        <option value="featured" @selected($sort === 'featured')>Featured</option>
                        <option value="name-asc" @selected($sort === 'name-asc')>Name: A &ndash; Z</option>
                        <option value="name-desc" @selected($sort === 'name-desc')>Name: Z &ndash; A</option>
                    </select>
                </label>
            </form>

            @if ($categorySlug || $q)
                <div class="flex flex-wrap items-center gap-2 text-[11px] text-coffee">
                    <span>Filtered by:</span>
                    @if ($selectedCategory)<span class="rounded-full bg-gold/15 px-3 py-1 text-golddark">{{ $selectedCategory['name'] }}</span>@endif
                    @if ($q)<span class="rounded-full bg-gold/15 px-3 py-1 text-golddark">&ldquo;{{ $q }}&rdquo;</span>@endif
                    <a href="/products" class="text-golddark underline underline-offset-2 hover:text-charcoal">Clear all</a>
                </div>
            @endif
        </div>

        <div class="mt-8">
            @if ($visible->isNotEmpty())
                <div class="grid grid-cols-2 gap-3 sm:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5">
                    @foreach ($visible as $i => $card)
                        @include('partials.shop-product-card', ['card' => $card, 'index' => $i, 'compact' => false])
                    @endforeach
                </div>
            @else
                <div class="rounded-xl border border-charcoal/10 bg-cream py-16 text-center">
                    <p class="text-[13px] font-medium text-charcoal">No materials match your filters.</p>
                    <p class="mt-1 text-[12px] text-coffee">Try another category, brand or search term.</p>
                    <a href="/products" class="mt-5 inline-block rounded-full bg-charcoal px-6 py-2.5 text-[11px] uppercase tracking-[0.12em] text-cream">Reset filters</a>
                </div>
            @endif
        </div>
    </div>
</section>

{{-- 6. CURATED COLLECTIONS --}}
<section class="bg-white py-12 md:py-16">
    <div class="mx-auto max-w-[1600px] px-4 md:px-8">
        <p class="text-[10px] font-semibold uppercase tracking-[0.28em] text-golddark" data-reveal="up">Handpicked for you</p>
        <h2 class="mt-2 font-serif text-2xl text-charcoal md:text-3xl" data-reveal="up" data-delay="60">Curated <em class="italic text-golddark">collections</em></h2>
        <div class="no-scrollbar mt-6 flex gap-2 overflow-x-auto pb-1">
            @foreach ($collectionGroups as $group)
                <a href="/products?group={{ rawurlencode($group['label']) }}" class="shrink-0 rounded-full px-4 py-2 text-[11px] tracking-wide transition-all {{ $activeCollectionLabel === $group['label'] ? 'bg-charcoal text-cream' : 'border border-charcoal/10 text-coffee hover:border-gold' }}">{{ $group['label'] }}</a>
            @endforeach
        </div>
        <div class="mt-6 grid grid-cols-2 gap-3 md:grid-cols-3 lg:grid-cols-5">
            @foreach ($collectionList as $i => $category)
                <a href="/products?category={{ $category['slug'] }}" data-reveal="up" data-delay="{{ min($i * 40, 200) }}" class="group overflow-hidden rounded-xl border border-charcoal/8 bg-cream text-left transition-shadow hover:shadow-card">
                    <div class="aspect-[4/3] overflow-hidden bg-beige">
                        <img src="{{ $category['image'] }}" alt="{{ $category['name'] }}" loading="lazy" class="h-full w-full object-cover object-center transition-transform duration-700 group-hover:scale-105">
                    </div>
                    <div class="p-3">
                        <p class="line-clamp-1 text-[12px] font-semibold text-charcoal group-hover:text-golddark">{{ $category['name'] }}</p>
                        <p class="mt-1 text-[10px] text-stonewarm">{{ $allProducts->where('categorySlug', $category['slug'])->count() }} designs</p>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</section>

{{-- 7. PROMO BANNER --}}
<section class="px-4 py-4 md:px-8 md:py-6">
    <div class="relative mx-auto h-[300px] max-w-[1600px] overflow-hidden rounded-xl bg-charcoal sm:h-[380px]">
        <img src="{{ $luxuryImage }}" alt="Premium interiors by Ananya" loading="lazy" class="absolute inset-0 h-full w-full object-cover object-center">
        <div class="absolute inset-0 bg-charcoal/65"></div>
        <div class="relative z-10 flex h-full max-w-lg flex-col justify-center px-6 sm:px-12">
            <p class="text-[10px] uppercase tracking-[0.3em] text-gold">Made for your space</p>
            <h2 class="mt-3 font-serif text-3xl leading-tight text-white sm:text-4xl">Your personality, made into a space.</h2>
            <p class="mt-3 text-[13px] leading-relaxed text-cream/75">From the first material sample to the final handover &mdash; every finish chosen with you.</p>
            <a href="/contact" class="group mt-6 inline-flex w-fit items-center gap-2 border border-gold px-6 py-3 text-[11px] font-semibold uppercase tracking-[0.14em] text-gold transition-colors hover:bg-gold hover:text-charcoal">Plan my space <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="transition-transform group-hover:translate-x-1"><path d="M5 12h14m-6-6 6 6-6 6"/></svg></a>
        </div>
    </div>
</section>

{{-- 8. SHOP BY ROOM --}}
<section class="bg-cream py-12 md:py-16">
    <div class="mx-auto max-w-[1600px] px-4 md:px-8">
        <p class="text-[10px] font-semibold uppercase tracking-[0.28em] text-golddark" data-reveal="up">Room by room</p>
        <h2 class="mt-2 font-serif text-2xl text-charcoal md:text-3xl" data-reveal="up" data-delay="60">Shop by <em class="italic text-golddark">room</em></h2>
        <div class="no-scrollbar mt-6 flex gap-3 overflow-x-auto pb-2">
            @foreach ($rooms as $i => $room)
                <button type="button" data-room="{{ $room['id'] }}" data-room-group="{{ $room['group'] }}" data-room-name="{{ $room['name'] }}" class="flex shrink-0 items-center gap-3 rounded-xl border px-3 py-2 text-left transition-all {{ $i === 0 ? 'border-gold bg-white shadow-card' : 'border-charcoal/8 bg-white/60 hover:border-gold/50' }}">
                    <img src="{{ $room['image'] }}" alt="" loading="lazy" class="h-10 w-10 rounded-lg object-cover">
                    <span class="text-[12px] font-medium text-charcoal">{{ $room['name'] }}</span>
                </button>
            @endforeach
        </div>
        <p class="mt-4 text-[11px] text-stonewarm" data-room-label>Showing materials for {{ $rooms[0]['name'] }}</p>
        @foreach ($rooms as $ri => $room)
            @php $roomIds = $filters->firstWhere('label', $room['group'])['ids'] ?? []; @endphp
            <div class="no-scrollbar mt-4 flex gap-3 overflow-x-auto pb-2" data-room-panel="{{ $room['id'] }}" @if ($ri !== 0) hidden @endif>
                @foreach ($categories->filter(fn ($c) => in_array($c['id'], $roomIds))->take(10) as $i => $card)
                    <div data-slide-card class="w-[62%] shrink-0 sm:w-[45%] md:w-[30%] lg:w-[19%]">
                        @include('partials.shop-product-card', ['card' => $card, 'index' => $i, 'compact' => true])
                    </div>
                @endforeach
            </div>
        @endforeach
        <button type="button" data-room-clear class="mt-5 text-[11px] uppercase tracking-[0.14em] text-golddark hover:underline">Clear room filter</button>
    </div>
</section>

{{-- 9. PRODUCT RANGE --}}
@if ($allProducts->isNotEmpty())
<section class="overflow-hidden bg-beige/50 py-20 md:py-24">
    <div class="mx-auto max-w-7xl px-5 text-center md:px-8" data-reveal="up">
        <p class="text-[10px] font-semibold uppercase tracking-[0.28em] text-golddark">Product Range</p>
        <h2 class="mt-3 font-serif text-3xl text-charcoal md:text-4xl">Everything <em class="italic text-golddark">Under One Roof</em></h2>
        <p class="mx-auto mt-4 max-w-2xl text-[13px] leading-relaxed text-coffee">A curated range of interior and exterior materials &mdash; from boards and laminates to cladding, flooring and more &mdash; with the trusted brands behind each one.</p>
        <p class="mt-5 text-[11px] uppercase tracking-[0.18em] text-stonewarm">{{ $allProducts->count() }} products &middot; tap any product for details</p>
    </div>
    <div class="mt-10 space-y-4">
        @foreach ($rangeRows as $rowIndex => $row)
            <div class="marquee-fade relative overflow-hidden py-1">
                <div class="{{ $rowIndex % 2 === 0 ? 'animate-marquee' : 'animate-marquee-reverse' }} gap-4 px-2 sm:gap-5" style="animation-duration: {{ max(45, $row->count() * 1.6) }}s;">
                    @foreach ([...$row, ...$row] as $index => $item)
                        <a href="/products/{{ $item['categorySlug'] }}?item={{ $item['id'] }}" class="group flex h-full w-[210px] shrink-0 flex-col overflow-hidden rounded-2xl border border-charcoal/5 bg-white shadow-card transition-all duration-300 hover:-translate-y-1 hover:border-gold/50 hover:shadow-lift sm:w-[260px] lg:w-[300px]" @if ($index >= $row->count()) aria-hidden="true" tabindex="-1" @endif>
                            <div class="relative aspect-[4/3] w-full shrink-0 overflow-hidden bg-beige">
                                <img src="{{ $item['image'] }}" alt="{{ $item['name'] }}" loading="lazy" decoding="async" class="h-full w-full object-cover object-center transition-transform duration-700 ease-out group-hover:scale-110">
                                <div class="pointer-events-none absolute inset-0 bg-gradient-to-t from-charcoal/25 via-transparent to-transparent"></div>
                                <span class="absolute left-3 top-3 max-w-[80%] truncate rounded-full border border-white/20 bg-charcoal/85 px-3 py-1 text-[10px] font-medium tracking-wide text-white backdrop-blur">{{ $item['categoryName'] }}</span>
                                <span class="absolute bottom-3 right-3 grid h-8 w-8 place-items-center rounded-full bg-white/95 text-charcoal/70 shadow-sm transition-colors group-hover:bg-gold group-hover:text-charcoal"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M7 17 17 7M7 7h10v10"/></svg></span>
                            </div>
                            <div class="flex flex-1 flex-col p-4">
                                <h3 class="line-clamp-2 min-h-[40px] text-[14px] font-medium leading-snug text-charcoal transition-colors group-hover:text-golddark">{{ $item['name'] }}</h3>
                                <div class="mt-2 flex flex-wrap content-start gap-1.5 overflow-hidden">
                                    @foreach (array_slice($item['brands'], 0, 3) as $brand)
                                        <span class="rounded-full bg-beige/70 px-2.5 py-1 text-[10px] font-medium uppercase tracking-wider text-coffee">{{ $brand }}</span>
                                    @endforeach
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        @endforeach
    </div>
</section>
@endif

{{-- 10. EDITORIAL --}}
<section class="bg-white py-12 md:py-16">
    <div class="mx-auto max-w-[1600px] px-4 md:px-8">
        <p class="text-[10px] font-semibold uppercase tracking-[0.28em] text-golddark" data-reveal="up">From the studio</p>
        <h2 class="mt-2 font-serif text-2xl text-charcoal md:text-3xl" data-reveal="up" data-delay="60">Stories worth <em class="italic text-golddark">reading</em></h2>
        <div class="mt-6 grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
            @foreach ($editorials as $i => $post)
                <article data-reveal="up" data-delay="{{ $i * 50 }}" class="group overflow-hidden rounded-xl border border-charcoal/8 bg-cream">
                    <div class="aspect-[16/10] overflow-hidden bg-beige"><img src="{{ $post['image'] }}" alt="{{ $post['title'] }}" loading="lazy" class="h-full w-full object-cover transition-transform duration-700 group-hover:scale-105"></div>
                    <div class="p-4">
                        <p class="text-[9px] uppercase tracking-[0.18em] text-golddark">{{ $post['category'] }} &middot; {{ $post['date'] }}</p>
                        <h3 class="mt-2 line-clamp-2 text-[13px] font-semibold leading-snug text-charcoal group-hover:text-golddark">{{ $post['title'] }}</h3>
                        <a href="/blog" class="mt-3 inline-flex items-center gap-1 text-[11px] font-medium text-golddark hover:underline">Read more <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14m-6-6 6 6-6 6"/></svg></a>
                    </div>
                </article>
            @endforeach
        </div>
    </div>
</section>

{{-- 11. SHOP TESTIMONIALS --}}
<section class="relative overflow-hidden">
    <div class="absolute inset-0"><img src="{{ $luxuryImage }}" alt="" loading="lazy" class="h-full w-full object-cover object-center"><div class="absolute inset-0 bg-charcoal/85"></div></div>
    <div class="relative mx-auto max-w-[1600px] px-4 py-14 md:px-8 md:py-20">
        <div class="flex flex-wrap items-end justify-between gap-6" data-reveal="up">
            <div>
                <p class="text-[10px] uppercase tracking-[0.3em] text-gold">Client stories</p>
                <h2 class="mt-2 font-serif text-3xl text-white md:text-4xl">Loved by the people we build for.</h2>
            </div>
            <div class="flex items-center gap-3 rounded-xl border border-white/15 bg-white/5 px-5 py-3">
                <span class="font-serif text-4xl text-white">4.8</span>
                <div><p class="flex gap-0.5 text-gold">@for ($s = 0; $s < 5; $s++)<span>&#9733;</span>@endfor</p><p class="mt-1 text-[10px] text-cream/60">from 5 verified reviews</p></div>
            </div>
        </div>
        <div class="mt-8 grid gap-4 md:grid-cols-3">
            @foreach ($stories as $i => $story)
                <div class="rounded-xl border border-white/15 bg-white/5 p-5 backdrop-blur-sm" data-reveal="up" data-delay="{{ $i * 80 }}">
                    <p class="flex gap-0.5 text-gold">@for ($s = 0; $s < 5; $s++)<span>&#9733;</span>@endfor</p>
                    <p class="mt-3 text-[13px] leading-relaxed text-cream/85">&ldquo;{{ $story['text'] }}&rdquo;</p>
                    <p class="mt-4 text-[12px] font-semibold text-white">{{ $story['name'] }}</p>
                    <p class="text-[10px] text-cream/50">{{ $story['location'] }} &middot; {{ $story['date'] }}</p>
                </div>
            @endforeach
        </div>
        <div class="mt-6 flex items-center gap-2 text-[11px] text-cream/60"><span class="text-gold">&#9733;</span> Rated 4.8/5 by our clients in Agra</div>
    </div>
</section>

{{-- 12. WISHLIST / SHORTLIST OVERLAY (view param) --}}
@if ($view === 'wishlist' || $view === 'cart')
<div class="fixed inset-0 z-[110] grid place-items-center bg-charcoal/70 p-4 backdrop-blur-sm">
    <div class="w-full max-w-md rounded-2xl bg-white p-6 shadow-lift">
        <div class="flex items-center justify-between">
            <h3 class="font-serif text-xl text-charcoal">{{ $view === 'cart' ? 'Your shortlist' : 'Saved materials' }}</h3>
            <a href="/products" aria-label="Close" class="grid h-8 w-8 place-items-center rounded-full border border-charcoal/10 text-charcoal"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 6 6 18M6 6l12 12"/></svg></a>
        </div>
        <div class="mt-5 space-y-2"><p class="rounded-xl bg-cream py-10 text-center text-[12px] text-coffee">Nothing saved yet. Tap the heart or bag on a product.</p></div>
    </div>
</div>
@endif

{{-- 13. CALL TO ACTION --}}
<section class="relative overflow-hidden bg-charcoal py-20 md:py-28">
    <div class="absolute inset-0 bg-gradient-to-r from-charcoal via-espresso to-charcoal"></div>
    <div class="relative mx-auto max-w-7xl px-5 text-center md:px-8" data-reveal="up">
        <p class="mb-4 text-[11px] font-medium uppercase tracking-[0.3em] text-gold">Ready to transform your space?</p>
        <h2 class="font-serif text-3xl text-cream md:text-5xl">Looking for a Specific Material?</h2>
        <p class="mx-auto mb-10 mt-4 max-w-2xl text-base leading-relaxed text-cream/60 md:text-lg">Our team can help you select the right products for your project. Visit our Agra display centre or send an enquiry.</p>
        <div class="flex flex-col items-center justify-center gap-4 sm:flex-row">
            <a href="/contact" class="inline-flex items-center gap-2.5 rounded-full bg-gold px-10 py-4 text-sm font-medium tracking-wide text-charcoal shadow-lg shadow-gold/25 transition-colors hover:bg-white">Contact Us <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14m-6-6 6 6-6 6"/></svg></a>
            <a href="{{ $phoneLink }}" class="inline-flex items-center gap-2.5 rounded-full border border-white/30 bg-white/5 px-8 py-4 text-sm font-medium tracking-wide text-white backdrop-blur-md transition-all hover:border-white/70 hover:bg-white hover:text-charcoal"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M22 16.9v3a2 2 0 0 1-2.2 2 19.8 19.8 0 0 1-8.6-3.1 19.5 19.5 0 0 1-6-6A19.8 19.8 0 0 1 2.1 4.2 2 2 0 0 1 4.1 2h3a2 2 0 0 1 2 1.7c.1 1 .4 2 .7 2.9a2 2 0 0 1-.4 2.1L8.1 9.9a16 16 0 0 0 6 6l1.2-1.2a2 2 0 0 1 2.1-.4c.9.3 1.9.6 2.9.7a2 2 0 0 1 1.7 2z"/></svg> Call Now</a>
        </div>
    </div>
</section>

{{-- SAVED TO LIST MODAL --}}
<div data-modal id="saved-modal" hidden>
    <div class="modal-backdrop absolute inset-0 bg-charcoal/70 backdrop-blur-sm" data-modal-close></div>
    <div class="modal-panel relative mx-auto w-full max-w-md rounded-3xl bg-cream p-8 shadow-lift">
        <button type="button" data-modal-close aria-label="Close" class="absolute right-4 top-4 grid h-8 w-8 place-items-center rounded-full border border-charcoal/10 text-charcoal transition-colors hover:bg-charcoal hover:text-cream"><svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 6 6 18M6 6l12 12"/></svg></button>
        <span class="grid h-12 w-12 place-items-center rounded-full bg-gold/15 text-golddark"><svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M20.8 4.6a5.5 5.5 0 0 0-7.8 0L12 5.7l-1-1.1a5.5 5.5 0 0 0-7.8 7.8l1.1 1L12 21l7.7-7.6 1.1-1a5.5 5.5 0 0 0 0-7.8Z"/></svg></span>
        <h3 class="mt-5 font-serif text-2xl text-charcoal">Saved to your list</h3>
        <p class="mt-2 text-[13px] leading-relaxed text-coffee">We&rsquo;ve noted your interest. Our trade team will follow up with availability and pricing for your project.</p>
        <button type="button" data-modal-close class="mt-6 inline-flex rounded-full bg-charcoal px-6 py-2.5 text-[11px] font-semibold uppercase tracking-[0.12em] text-cream hover:bg-espresso">Continue browsing</button>
    </div>
</div>

@push('scripts')
<script>
    /* Shop by room: switch the visible product rail and the "Showing…" label. */
    (function () {
        var chips = Array.prototype.slice.call(document.querySelectorAll('[data-room]'));
        if (!chips.length) return;
        function activate(chip) {
            chips.forEach(function (c) {
                var on = c === chip;
                c.className = 'flex shrink-0 items-center gap-3 rounded-xl border px-3 py-2 text-left transition-all ' +
                    (on ? 'border-gold bg-white shadow-card' : 'border-charcoal/8 bg-white/60 hover:border-gold/50');
            });
            document.querySelectorAll('[data-room-panel]').forEach(function (panel) {
                var on = panel.getAttribute('data-room-panel') === chip.dataset.room;
                panel.hidden = !on;
                /* Reveal hooks inside a hidden rail never intersect the viewport. */
                if (on) panel.querySelectorAll('[data-reveal]').forEach(function (el) { el.classList.add('is-visible'); });
            });
            var label = document.querySelector('[data-room-label]');
            if (label) label.textContent = 'Showing materials for ' + chip.dataset.roomName;
        }
        chips.forEach(function (chip) { chip.addEventListener('click', function () { activate(chip); }); });
        document.querySelector('[data-room-clear]')?.addEventListener('click', function () { activate(chips[0]); });
        activate(chips[0]);
    })();
</script>
@endpush
@endsection
