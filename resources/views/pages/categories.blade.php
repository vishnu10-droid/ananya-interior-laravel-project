@extends('layouts.app')
@section('title', ($category['name'] ?? 'Categories').' | Ananya Interior')
@section('content')
@php
    $data = \App\Support\CatalogueData::data();
    $categories = collect($data['categories']);
    $productRange = collect($data['productRange']);
    $featuredBrands = collect($data['featuredBrands']);
    $allBrands = collect($data['allBrands']);
    $productImages = $data['productImages'];

    $slug = (string) request()->route('slug', '');
    $activeSlug = $slug !== '' ? $slug : 'plywood';
    $category = $categories->firstWhere('slug', $activeSlug) ?: $categories->first();
    $categorySlug = $category['slug'];

    /* Only these five slugs get a productRange hero item in the reference site. */
    $featuredNames = [
        'plywood' => 'Plywood & Block Boards',
        'doors' => 'Doors',
        'decorative-laminate' => 'Decorative Laminates',
        'veneers' => 'Decorative Veneers',
        'decmore-wall-panels' => 'Interior Wall Cladding',
    ];
    $rangeItem = isset($featuredNames[$categorySlug])
        ? $productRange->firstWhere('name', $featuredNames[$categorySlug])
        : null;
    $heroName = $rangeItem['name'] ?? $category['name'];
    $heroImage = $rangeItem['image'] ?? $category['image'];
    $nameParts = preg_split('/\s+&\s+/', (string) $heroName);

    $viewAll = $slug === '' || request('viewall') === '1';
    $brandFilter = (string) request('brand', '');
    $sort = (string) request('sort', 'featured');

    /* buildProducts() from CategoryShowcase.jsx — images are the category's
       curated + guide photographs, names are "{brand} {type}". */
    $buildProducts = function ($source) use ($productImages) {
        $images = $productImages[$source['slug']] ?? [$source['image']];
        $brands = $source['brands'] ?? [];
        $types = $source['types'] ?? [];
        return collect($images)->map(function ($image, $i) use ($source, $brands, $types) {
            $brand = count($brands) ? $brands[$i % count($brands)] : 'Premium';
            $type = count($types) ? $types[$i % count($types)] : $source['name'];
            return [
                'id' => $source['slug'].'-'.$i,
                'slug' => $source['slug'],
                'image' => $image,
                'name' => trim($brand.' '.$type),
                'brand' => $brand,
                'thickness' => $type,
                'detail' => $source['description'],
                'eyebrow' => $source['name'],
                'description' => $source['description'],
                'details' => $source['description'],
                'brands' => $brands,
                'features' => $source['features'] ?? [],
                'variants' => $types,
            ];
        })->values();
    };

    $categoryProducts = $buildProducts($category);
    $allBuilt = $categories->flatMap(fn ($c) => $buildProducts($c));
    $availableBrands = $allBuilt->pluck('brand')->filter()->unique()->sort()->values();

    if ($viewAll) $visible = $allBuilt;
    elseif ($brandFilter !== '') $visible = $allBuilt->where('brand', $brandFilter);
    else $visible = $categoryProducts;

    if ($sort === 'name-asc') $visible = $visible->sortBy('name', SORT_NATURAL | SORT_FLAG_CASE)->values();
    if ($sort === 'name-desc') $visible = $visible->sortByDesc('name', SORT_NATURAL | SORT_FLAG_CASE)->values();

    $whatsapp = \App\Models\Setting::get('whatsapp', 'https://wa.me/917351400063');
    $waBase = explode('?', (string) $whatsapp)[0];
    $cataloguePdf = "/documents/Ananya%20Company%20Profile%20(May'25)%202_compressed.pdf";

    $bottomFeatures = [
        ['M12 2 5 5v6c0 4.8 3 8.3 7 9 4-.7 7-4.2 7-9V5l-7-3ZM9 12l2 2 4-4', 'IS-Certified Quality'],
        ['M12 2 3 7l9 5 9-5-9-5ZM3 12l9 5 9-5M3 17l9 5 9-5', 'Multiple Thickness'],
        ['M6 3h12l4 6-10 12L2 9l4-6ZM2 9h20M12 21 7 9l5-6 5 6-5 12Z', 'High Durability'],
        ['M12 2c-4 4-6 7-6 10a6 6 0 0 0 12 0c0-3-2-6-6-10Z', 'Eco Friendly'],
        ['M3 7h11v10H3zM14 10h4l3 3v4h-7zM7 20a2 2 0 1 0 0-4 2 2 0 0 0 0 4ZM18 20a2 2 0 1 0 0-4 2 2 0 0 0 0 4Z', 'Bulk & Project Supply'],
    ];

    $why = [
        ['M12 2 5 5v6c0 4.8 3 8.3 7 9 4-.7 7-4.2 7-9V5l-7-3ZM9 12l2 2 4-4', 'Trusted Quality', 'IS-certified and tested for long-term performance.'],
        ['M12 2 3 7l9 5 9-5-9-5ZM3 12l9 5 9-5M3 17l9 5 9-5', 'Wide Variety', 'Multiple grades, thicknesses and finishes for every need.'],
        ['M4 13a8 8 0 0 1 16 0M4 13h3v6H5a1 1 0 0 1-1-1v-5Zm16 0h-3v6h2a1 1 0 0 0 1-1v-5Z', 'Expert Guidance', 'Get the right material for your space and budget.'],
        ['M3 7h11v10H3zM14 10h4l3 3v4h-7zM7 20a2 2 0 1 0 0-4 2 2 0 0 0 0 4ZM18 20a2 2 0 1 0 0-4 2 2 0 0 0 0 4Z', 'Bulk & Project Supply', 'Reliable supply for homes, offices and large projects.'],
    ];

    /* TRUSTED_BRANDS: featured logo brands first, then all brand names. */
    $seen = [];
    $trusted = collect();
    foreach ($featuredBrands as $brand) {
        $key = strtolower($brand['name']);
        if (! isset($seen[$key])) { $seen[$key] = true; $trusted->push($brand); }
    }
    foreach ($allBrands as $name) {
        $key = strtolower($name);
        if (! isset($seen[$key])) { $seen[$key] = true; $trusted->push(['name' => $name, 'image' => null]); }
    }
    $initialsFor = function ($name) {
        $words = preg_split('/\s+/', trim((string) $name));
        return strtoupper(substr(implode('', array_map(fn ($w) => $w[0] ?? '', $words)), 0, 2));
    };
@endphp

<div class="min-h-screen bg-[#F8F4ED] pt-[72px] text-[#3A2A1B]">

    {{-- 1. HERO --}}
    <section class="relative overflow-hidden bg-[#1C1109] text-[#F7EEDF]">
        <div class="absolute inset-0 bg-gradient-to-r from-[#1C1109] via-[#1C1109]/85 to-[#1C1109]/10"></div>
        <div class="motion-in-up relative mx-auto max-w-[1600px] px-4 pb-4 pt-4 sm:px-8">
            <p class="text-[10px] text-[#CDBB9E]">
                <a href="/" class="hover:text-[#D9B45B]">Home</a><span class="mx-1.5 text-[#8A6A46]">&rsaquo;</span>
                <a href="/products" class="hover:text-[#D9B45B]">Products</a><span class="mx-1.5 text-[#8A6A46]">&rsaquo;</span>
                {{ $heroName }}
            </p>
            <div class="mt-3 grid items-center gap-4 lg:grid-cols-[0.92fr_1.08fr] lg:gap-8">
                <div class="relative z-10">
                    <div class="flex items-center gap-3">
                        <p class="shrink-0 text-[10px] font-medium uppercase tracking-[0.28em] text-[#D9B45B]">Premium Wood Materials</p>
                        <span class="h-px w-16 bg-[#D9B45B]/50 sm:w-24"></span>
                    </div>
                    <h1 class="mt-3 font-serif text-[38px] leading-[1.02] sm:text-[46px] lg:text-[50px]">
                        {{ $nameParts[0] ?? $heroName }}
                        @if (isset($nameParts[1])) <span class="text-[#D9B45B]">&amp;</span><br>{{ $nameParts[1] }} @endif
                    </h1>
                    <p class="mt-3 max-w-md text-[12px] leading-relaxed text-[#D9CBB4]">Strong, durable and versatile engineered wood for furniture, interiors and long-lasting spaces.</p>
                    <div class="mt-5 flex flex-wrap gap-2.5">
                        <button type="button" data-scroll-to="catalogue-grid" class="inline-flex items-center gap-2 rounded-full bg-[#D9B45B] px-5 py-2.5 text-[11px] font-semibold text-[#24160D] transition-colors hover:bg-[#F0D48A]">Explore Collection <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14m-6-6 6 6-6 6"/></svg></button>
                        <a href="{{ $cataloguePdf }}" target="_blank" rel="noreferrer" class="inline-flex items-center gap-2 rounded-full border border-[#D9B45B]/60 px-5 py-2.5 text-[11px] font-medium text-[#F7EEDF] transition-colors hover:bg-[#D9B45B]/10"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M12 3v12m-5-5 5 5 5-5M4 19h16"/></svg> Download Catalogue</a>
                    </div>
                </div>
                <div class="relative h-[230px] overflow-hidden sm:h-[280px] lg:h-[310px]">
                    <div class="absolute inset-0 bg-gradient-to-r from-[#1C1109] via-transparent to-transparent"></div>
                    <img src="{{ $heroImage }}" alt="{{ $heroName }}" class="absolute inset-0 h-full w-full object-cover object-center">
                    <div class="absolute inset-0 bg-gradient-to-r from-[#1C1109]/70 via-transparent to-transparent"></div>
                    <svg class="pointer-events-none absolute inset-0 h-full w-full" viewBox="0 0 800 320" preserveAspectRatio="none" aria-hidden="true">
                        <path d="M 20 300 C 180 40, 520 -30, 790 110" fill="none" stroke="#D9B45B" stroke-width="1.2" opacity="0.75" />
                        <path d="M 165 168 C 230 150, 300 205, 370 200" fill="none" stroke="#D9B45B" stroke-width="1" opacity="0.7" />
                        <circle cx="370" cy="200" r="3.5" fill="#D9B45B" />
                    </svg>
                    <div class="absolute left-[12%] top-[38%] hidden h-[88px] w-[88px] overflow-hidden rounded-full border-[3px] border-[#D9B45B] shadow-[0_0_30px_rgba(217,180,91,0.35)] sm:block">
                        <img src="{{ $heroImage }}" alt="Material close-up" class="h-full w-full scale-150 object-cover object-left-top">
                    </div>
                </div>
            </div>
            <div class="mt-4 flex flex-wrap items-center justify-center gap-x-6 gap-y-2 border-t border-[#D9B45B]/20 pt-3 text-[10px] text-[#D9CBB4] sm:gap-x-10">
                @foreach ($bottomFeatures as $feature)
                    <span class="inline-flex items-center gap-1.5"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" class="text-[#D9B45B]"><path d="{{ $feature[0] }}"/></svg><span class="leading-tight">{{ $feature[1] }}</span></span>
                @endforeach
            </div>
        </div>
    </section>

    {{-- 2. CATEGORY CARDS --}}
    <section class="bg-[#F8F4ED] px-4 py-8 sm:px-8">
        <div class="mx-auto max-w-[1600px]">
            <div class="mb-5 flex flex-wrap items-end justify-between gap-3">
                <div data-reveal="up">
                    <p class="text-[10px] font-semibold uppercase tracking-[0.28em] text-[#B58A22]">Product range</p>
                    <h2 class="mt-1 font-serif text-xl text-[#3A2A1B] sm:text-2xl">Explore by category</h2>
                </div>
                <button type="button" data-show-all aria-expanded="false" class="inline-flex items-center gap-1.5 rounded-full border border-[#D9B45B]/60 bg-white px-4 py-2 text-[11px] font-semibold uppercase tracking-[0.12em] text-[#8A6A16] transition-colors hover:bg-[#D9B45B] hover:text-[#24160D]">
                    <span data-show-all-label>View All</span>
                    <svg data-show-all-icon width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="transition-transform"><path d="m9 18 6-6 6-6"/></svg>
                </button>
            </div>
            <div data-category-cards class="grid grid-cols-2 gap-3 overflow-hidden transition-[max-height] duration-500 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 max-h-[250px]">
                @foreach ($categories as $i => $item)
                    <a href="/categories/{{ $item['slug'] }}" data-reveal="up" data-delay="{{ ($i % 3) * 90 }}" class="group flex h-[250px] w-full flex-col overflow-hidden rounded-xl border bg-white text-left shadow-sm transition-all duration-300 hover:-translate-y-1 hover:shadow-lg {{ $item['slug'] === $categorySlug ? 'border-[#D9B45B] ring-1 ring-[#D9B45B]/50' : 'border-[#E3D8C7]' }}">
                        <div class="flex h-[188px] shrink-0 items-center justify-center overflow-hidden bg-[#EFE6D9]">
                            <div class="h-[160px] w-[112px] overflow-hidden rounded-md">
                                <img src="{{ $item['image'] }}" alt="{{ $item['name'] }}" loading="lazy" class="h-full w-full object-cover object-center transition-transform duration-500 group-hover:scale-110">
                            </div>
                        </div>
                        <div class="flex flex-1 items-center gap-2 px-3">
                            <p class="line-clamp-2 text-[11px] font-semibold leading-tight transition-colors {{ $item['slug'] === $categorySlug ? 'text-[#8A6A16]' : 'text-[#3A2A1B] group-hover:text-[#8A6A16]' }}">{{ $item['name'] }}</p>
                            @if ($item['slug'] === $categorySlug)<span class="h-2 w-2 shrink-0 rounded-full bg-[#B58A22]"></span>@endif
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    {{-- 3. CATALOGUE --}}
    <section id="catalogue-grid" class="mx-auto max-w-[1600px] scroll-mt-20 px-4 py-6 sm:px-8">
        <div class="flex gap-5">
            <aside class="hidden w-[250px] shrink-0 lg:block">
                @include('partials.category-filter-panel', [
                    'category' => $category,
                    'availableBrands' => $availableBrands,
                    'viewAll' => $viewAll,
                    'brandFilter' => $brandFilter,
                    'categorySlug' => $categorySlug,
                ])
            </aside>

            <div class="min-w-0 flex-1">
                <div class="mb-4 flex flex-wrap items-center justify-between gap-3">
                    <p class="text-[12px] text-[#6B5A45]">Showing <strong class="text-[#3A2A1B]">{{ $visible->count() }}</strong> Products</p>
                    <div class="flex items-center gap-2">
                        <button type="button" data-open-filters class="inline-flex items-center gap-1.5 rounded-lg border border-[#E3D8C7] bg-white px-3 py-2 text-[11px] text-[#5A4A38] lg:hidden"><svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 6h16M7 12h10m-7 6h4"/></svg> Filters</button>
                        <select data-category-sort aria-label="Sort products" class="rounded-lg border border-[#E3D8C7] bg-white px-3 py-2 text-[11px] text-[#5A4A38]">
                            <option value="featured" @selected($sort === 'featured')>Sort By: Featured</option>
                            <option value="name-asc" @selected($sort === 'name-asc')>Name: A &ndash; Z</option>
                            <option value="name-desc" @selected($sort === 'name-desc')>Name: Z &ndash; A</option>
                        </select>
                        <div class="flex overflow-hidden rounded-lg border border-[#E3D8C7] bg-white">
                            <button type="button" data-list-view="grid" aria-label="Grid view" class="grid h-8 w-8 place-items-center bg-[#D9B45B] text-[#24160D]"><svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><rect x="3" y="3" width="7" height="7" rx="1"/><rect x="14" y="3" width="7" height="7" rx="1"/><rect x="3" y="14" width="7" height="7" rx="1"/><rect x="14" y="14" width="7" height="7" rx="1"/></svg></button>
                            <button type="button" data-list-view="list" aria-label="List view" class="grid h-8 w-8 place-items-center text-[#8A7A66]"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M8 6h13M8 12h13M8 18h13M3 6h.01M3 12h.01M3 18h.01"/></svg></button>
                        </div>
                    </div>
                </div>

                @if ($viewAll)
                    <p class="mb-3 text-[11px] text-[#8A6A16]">Showing products from <strong>all brands</strong></p>
                @elseif ($brandFilter !== '')
                    <p class="mb-3 text-[11px] text-[#8A6A16]">Showing matching products across all categories for: <strong>{{ $brandFilter }}</strong></p>
                @endif

                @if ($visible->isNotEmpty())
                    <div data-product-grid class="grid grid-cols-2 gap-3 md:grid-cols-3 xl:grid-cols-4">
                        @foreach ($visible as $i => $product)
                            @php $enquireHref = $waBase.'?text='.rawurlencode('Hi Ananya Interior, I would like to enquire about '.$product['name'].'.'); @endphp
                            <div data-flip data-reveal="up" data-delay="{{ min(($i % 8) * 50, 350) }}" class="flip-scene group relative h-[470px] rounded-2xl shadow-card transition-[transform,box-shadow] duration-500 hover:-translate-y-1.5 hover:shadow-lift">
                                <div class="flip-inner">
                                    <div class="flip-face flip-face--front flex flex-col rounded-2xl border border-[#B68B4D]/30 bg-[#F8F5EF] text-[#30251E]">
                                        <div class="relative h-[52%] shrink-0 overflow-hidden bg-[#EDE5D9]">
                                            <img src="{{ $product['image'] }}" alt="{{ $product['name'] }}" loading="lazy" class="h-full w-full object-cover object-center">
                                            <span class="absolute left-3 top-3 max-w-[70%] rounded-full bg-[#F8F5EF]/95 px-2.5 py-1 text-[8px] font-semibold uppercase leading-tight tracking-[0.18em] text-[#8A6A16] shadow-sm">{{ $product['eyebrow'] }}</span>
                                        </div>
                                        <div class="flex flex-1 flex-col p-4">
                                            <h3 class="font-serif text-[18px] leading-tight text-[#30251E]">{{ $product['name'] }}</h3>
                                            <p class="mt-1.5 line-clamp-2 text-[11px] leading-relaxed text-[#6B5A45]">{{ $product['description'] }}</p>
                                            <div class="mt-auto pt-3">
                                                <div class="flex flex-wrap gap-1">
                                                    @foreach (array_slice($product['brands'], 0, 3) as $brand)
                                                        <span class="max-w-[110px] truncate rounded border border-[#B68B4D]/35 bg-[#EDE5D9] px-1.5 py-0.5 text-[8px] font-medium uppercase tracking-wide text-[#6B542E]">{{ $brand }}</span>
                                                    @endforeach
                                                </div>
                                                <div class="mt-3 flex items-center justify-between gap-2 border-t border-[#B68B4D]/25 pt-2.5">
                                                    <a href="/products/{{ $product['slug'] }}" class="inline-flex items-center gap-1 text-[9px] font-semibold uppercase tracking-[0.1em] text-[#8A6A16] transition-colors hover:text-[#30251E]">Explore Details <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M7 17 17 7M7 7h10v10"/></svg></a>
                                                    <button type="button" data-flip-toggle aria-label="Show details for {{ $product['name'] }}" class="grid h-8 w-8 shrink-0 place-items-center rounded-full border border-[#B68B4D]/50 text-[#8A6A16] transition-colors hover:bg-[#B68B4D] hover:text-[#F8F5EF]"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14m-6-6 6 6-6 6"/></svg></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flip-face flip-face--back flex flex-col rounded-2xl border border-[#B68B4D]/40 bg-[#30251E] p-4 text-[#F8F5EF]">
                                        <div class="flex items-start justify-between gap-2">
                                            <p class="text-[8px] font-semibold uppercase tracking-[0.24em] text-[#B68B4D]">The Details</p>
                                            <button type="button" data-flip-toggle aria-label="Show front of {{ $product['name'] }}" class="grid h-7 w-7 shrink-0 place-items-center rounded-full border border-[#B68B4D]/50 text-[#B68B4D] transition-colors hover:bg-[#B68B4D] hover:text-[#30251E]"><svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 12a9 9 0 1 0 3-6.7L3 8m0-5v5h5"/></svg></button>
                                        </div>
                                        <h3 class="mt-2 font-serif text-[18px] leading-tight text-[#F8F5EF]">{{ $product['name'] }}</h3>
                                        <p class="mt-1.5 line-clamp-3 text-[10px] leading-relaxed text-[#EDE5D9]/75">{{ $product['details'] ?: $product['description'] }}</p>
                                        <div class="mt-3 space-y-1.5">
                                            @foreach (array_slice($product['features'], 0, 4) as $fi => $feature)
                                                <div class="flex items-center gap-2">
                                                    @if ($fi % 4 === 0)<svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" class="shrink-0 text-[#B68B4D]"><path d="M12 2 5 5v6c0 4.8 3 8.3 7 9 4-.7 7-4.2 7-9V5l-7-3ZM9 12l2 2 4-4"/></svg>
                                                    @elseif ($fi % 4 === 1)<svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" class="shrink-0 text-[#B68B4D]"><path d="M12 2 3 7l9 5 9-5-9-5ZM3 12l9 5 9-5"/></svg>
                                                    @elseif ($fi % 4 === 2)<svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" class="shrink-0 text-[#B68B4D]"><path d="M6 3h12l4 6-10 12L2 9l4-6ZM2 9h20"/></svg>
                                                    @else<svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" class="shrink-0 text-[#B68B4D]"><path d="M12 2c-4 4-6 7-6 10a6 6 0 0 0 12 0c0-3-2-6-6-10Z"/></svg>@endif
                                                    <span class="text-[10px] leading-tight text-[#EDE5D9]/85">{{ $feature }}</span>
                                                </div>
                                            @endforeach
                                        </div>
                                        @if (count($product['variants']))
                                            <div class="mt-3">
                                                <p class="text-[8px] font-semibold uppercase tracking-[0.2em] text-[#B68B4D]">Available in</p>
                                                <p class="mt-0.5 line-clamp-2 text-[10px] leading-snug text-[#EDE5D9]/70">{{ implode(' · ', array_slice($product['variants'], 0, 3)) }}</p>
                                            </div>
                                        @endif
                                        <div class="mt-auto pt-3">
                                            <p class="text-[8px] font-semibold uppercase tracking-[0.2em] text-[#B68B4D]">Brands</p>
                                            <div class="mt-1 flex flex-wrap gap-1">
                                                @foreach (array_slice($product['brands'], 0, 4) as $brand)
                                                    <span class="max-w-[110px] truncate rounded border border-[#B68B4D]/35 px-1.5 py-0.5 text-[8px] font-medium uppercase tracking-wide text-[#EDE5D9]/80">{{ $brand }}</span>
                                                @endforeach
                                            </div>
                                            <div class="mt-3 flex gap-2">
                                                <a href="/products/{{ $product['slug'] }}" class="flex-1 rounded-full bg-[#B68B4D] px-2 py-2 text-center text-[9px] font-semibold uppercase tracking-wide text-[#30251E] transition-colors hover:bg-[#D9B45B]">View Details</a>
                                                <a href="{{ $enquireHref }}" target="_blank" rel="noreferrer" class="flex-1 rounded-full border border-[#B68B4D]/70 px-2 py-2 text-center text-[9px] font-semibold uppercase tracking-wide text-[#F8F5EF] transition-colors hover:bg-[#B68B4D]/15">Enquire Now</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="rounded-xl border border-[#E6DCCB] bg-white py-16 text-center">
                        <p class="font-serif text-xl text-[#3A2A1B]">No products match your filters</p>
                        <a href="/categories/{{ $categorySlug }}" class="mt-4 inline-block rounded-full bg-[#D9B45B] px-5 py-2 text-[11px] font-semibold text-[#24160D]">Clear filters</a>
                    </div>
                @endif
            </div>
        </div>
    </section>

    {{-- MOBILE FILTERS DRAWER --}}
    <div data-filters-drawer class="fixed inset-0 z-[80] hidden justify-end bg-black/50 lg:hidden">
        <div class="h-full w-[85%] max-w-sm overflow-y-auto bg-[#F8F4ED] p-4">
            <div class="mb-3 flex items-center justify-between">
                <p class="font-serif text-lg">Filters</p>
                <button type="button" data-close-filters aria-label="Close filters" class="grid h-8 w-8 place-items-center rounded-full border border-[#E3D8C7] text-[#5A4A38]"><svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 6 6 18M6 6l12 12"/></svg></button>
            </div>
            @include('partials.category-filter-panel', [
                'category' => $category,
                'availableBrands' => $availableBrands,
                'viewAll' => $viewAll,
                'brandFilter' => $brandFilter,
                'categorySlug' => $categorySlug,
            ])
        </div>
    </div>

    {{-- 4. OUR TRUSTED BRANDS --}}
    <section class="bg-[#F8F4ED] px-4 py-8 sm:px-8">
        <div class="mx-auto max-w-[1600px]">
            <div class="flex flex-wrap items-end justify-between gap-2" data-reveal="up">
                <div>
                    <h2 class="font-serif text-2xl text-[#3A2A1B]">Our Trusted Brands</h2>
                    <p class="mt-1 text-[11px] text-[#8A7E71]">{{ $trusted->count() }} brands we work with &mdash; under one roof.</p>
                </div>
                <a href="/brands" class="inline-flex items-center gap-1 text-[11px] font-medium text-[#8A6A16] hover:underline">View All Brands <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14m-6-6 6 6-6 6"/></svg></a>
            </div>
            <div class="marquee-fade relative mt-5 overflow-hidden py-1">
                <div class="animate-marquee" style="animation-duration: 110s;">
                    @foreach ([...$trusted, ...$trusted] as $i => $brand)
                        <div aria-hidden="{{ $i >= $trusted->count() ? 'true' : 'false' }}">
                            <div class="group mr-3 grid h-24 w-40 shrink-0 place-items-center rounded-xl border border-[#E6DCCB] bg-white px-4 py-3 shadow-card transition-shadow duration-300 hover:shadow-lift sm:mr-4 sm:w-44">
                                @if ($brand['image'])
                                    <div class="flex flex-col items-center gap-1.5">
                                        <img src="{{ $brand['image'] }}" alt="{{ $brand['name'] }}" loading="lazy" class="max-h-9 w-full object-contain">
                                        <span class="text-center text-[10px] font-medium leading-tight text-[#5A4A38] transition-colors group-hover:text-[#8A6A16]">{{ $brand['name'] }}</span>
                                    </div>
                                @else
                                    <div class="flex flex-col items-center gap-1.5">
                                        <span class="grid h-9 w-9 place-items-center rounded-lg bg-gradient-to-br from-[#24160D] to-[#3A2A1B] font-serif text-[13px] font-semibold tracking-wide text-[#D9B45B]">{{ $initialsFor($brand['name']) }}</span>
                                        <span class="text-center text-[10px] font-medium leading-tight text-[#5A4A38] transition-colors group-hover:text-[#8A6A16]">{{ $brand['name'] }}</span>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    {{-- 5. WHY CHOOSE US --}}
    <section class="relative overflow-hidden bg-[#24160D] py-12 text-[#F7EEDF]">
        <div class="absolute inset-0 bg-cover bg-center opacity-20" style="background-image: url('/images/company-profile/page-01-image-01.png');"></div>
        <div class="relative mx-auto max-w-[1600px] px-4 sm:px-8">
            <h2 class="text-center font-serif text-2xl text-[#F3E3C8] sm:text-3xl" data-reveal="up">Why Choose Us for {{ $heroName }}?</h2>
            <div class="mt-9 grid gap-7 sm:grid-cols-2 lg:grid-cols-4">
                @foreach ($why as $i => $item)
                    <div data-reveal="up" data-delay="{{ $i * 90 }}" class="text-center">
                        <svg width="34" height="34" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.3" class="mx-auto text-[#D9B45B]"><path d="{{ $item[0] }}"/></svg>
                        <h3 class="mt-3 font-serif text-[16px] text-[#F3E3C8]">{{ $item[1] }}</h3>
                        <p class="mt-2 text-[11px] leading-relaxed text-[#CDBB9E]">{{ $item[2] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
</div>

@push('scripts')
<script>
    (function () {
        /* In-page anchor scrolling (Explore Collection). */
        document.querySelectorAll('[data-scroll-to]').forEach(function (el) {
            el.addEventListener('click', function () {
                var target = document.getElementById(el.dataset.scrollTo);
                if (target) target.scrollIntoView({ behavior: 'smooth', block: 'start' });
            });
        });

        /* Category cards: expand from a single row to the full grid. */
        var showAll = document.querySelector('[data-show-all]');
        var cards = document.querySelector('[data-category-cards]');
        if (showAll && cards) {
            showAll.addEventListener('click', function () {
                var open = showAll.getAttribute('aria-expanded') === 'true';
                showAll.setAttribute('aria-expanded', String(!open));
                cards.classList.toggle('max-h-[250px]', open);
                cards.classList.toggle('max-h-[4000px]', !open);
                var label = showAll.querySelector('[data-show-all-label]');
                if (label) label.textContent = open ? 'View All' : 'Show Less';
                var icon = showAll.querySelector('[data-show-all-icon]');
                if (icon) icon.style.transform = open ? '' : 'rotate(-90deg)';
            });
        }

        /* Brand radio filters navigate with the selected brand in the URL. */
        document.querySelectorAll('input[data-brand-href]').forEach(function (radio) {
            radio.addEventListener('change', function () {
                if (radio.checked && radio.dataset.brandHref) window.location.href = radio.dataset.brandHref;
            });
        });

        /* Sort — keep the current brand / view-all selection. */
        var sort = document.querySelector('[data-category-sort]');
        if (sort) sort.addEventListener('change', function () {
            var params = new URLSearchParams(window.location.search);
            if (sort.value === 'featured') params.delete('sort'); else params.set('sort', sort.value);
            var query = params.toString();
            window.location.href = window.location.pathname + (query ? '?' + query : '');
        });

        /* Grid / list view toggle. */
        var viewButtons = document.querySelectorAll('[data-list-view]');
        var grid = document.querySelector('[data-product-grid]');
        viewButtons.forEach(function (button) {
            button.addEventListener('click', function () {
                viewButtons.forEach(function (b) {
                    var active = b === button;
                    b.classList.toggle('bg-[#D9B45B]', active);
                    b.classList.toggle('text-[#24160D]', active);
                    b.classList.toggle('text-[#8A7A66]', !active);
                });
                if (!grid) return;
                var list = button.dataset.listView === 'list';
                grid.classList.toggle('grid-cols-1', list);
                grid.classList.toggle('sm:grid-cols-2', list);
                grid.classList.toggle('grid-cols-2', !list);
                grid.classList.toggle('md:grid-cols-3', !list);
                grid.classList.toggle('xl:grid-cols-4', !list);
            });
        });

        /* Mobile filter drawer. */
        var drawer = document.querySelector('[data-filters-drawer]');
        var openBtn = document.querySelector('[data-open-filters]');
        var closeBtn = document.querySelector('[data-close-filters]');
        var toggleDrawer = function (open) {
            if (!drawer) return;
            drawer.classList.toggle('hidden', !open);
            drawer.classList.toggle('flex', open);
            document.body.style.overflow = open ? 'hidden' : '';
        };
        openBtn?.addEventListener('click', function () { toggleDrawer(true); });
        closeBtn?.addEventListener('click', function () { toggleDrawer(false); });
        drawer?.addEventListener('click', function (event) { if (event.target === drawer) toggleDrawer(false); });
        document.addEventListener('keydown', function (event) { if (event.key === 'Escape') toggleDrawer(false); });
    })();
</script>
@endpush
@endsection
