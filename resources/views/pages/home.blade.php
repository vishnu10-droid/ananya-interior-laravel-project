@extends('layouts.app')
@section('title', 'Ananya Interior | Agra')
@section('description', 'Premium interior and exterior solutions crafted with experience, design and precision.')

@section('content')
@php
    $hero = \App\Models\Setting::get('image_hero', '/images/company-profile/page-01-image-01.png');
    $aboutImage = \App\Models\Setting::get('image_about', '/images/company-profile/page-02-image-01.png');
    $whatsapp = \App\Models\Setting::get('whatsapp', 'https://wa.me/917351400063');
    $waBase = explode('?', $whatsapp)[0];

@endphp

{{-- ============ ACT I — THE PROMISE ============ --}}

{{-- 1. HERO --}}
<section data-hero-parallax class="relative flex min-h-screen items-end overflow-hidden bg-charcoal">
    <div data-hero-bg-wrap class="absolute inset-0 h-full w-full origin-center will-change-transform">
        <img data-hero-bg src="{{ $hero }}" alt="Luxury home interior by Ananya Interior Agra" class="h-full w-full object-cover object-center filter brightness-90">
    </div>
    <div class="absolute inset-0 z-[1] bg-gradient-to-t from-charcoal via-charcoal/60 to-charcoal/20"></div>
    <div class="absolute inset-0 z-[1] bg-gradient-to-r from-charcoal/80 via-charcoal/40 to-transparent"></div>
    <div class="pointer-events-none absolute inset-0 z-[1]" style="background: radial-gradient(circle at center, transparent 40%, rgba(0,0,0,.42) 100%);"></div>

    <div class="motion-in-right absolute right-10 top-1/2 z-10 hidden -translate-y-1/2 flex-col items-center gap-6 text-white/40 md:flex" style="--d:.6s">
        <span class="text-[10px] font-light uppercase tracking-[0.45em] text-gold/80" style="writing-mode: vertical-rl;">Ananya — 27.17° N</span>
        <div class="h-24 w-px bg-gradient-to-b from-gold/60 via-white/20 to-transparent"></div>
    </div>

    <div class="motion-in-zoom absolute right-12 top-28 z-10 hidden h-36 w-36 place-items-center rounded-full border border-gold/40 bg-charcoal/30 text-center shadow-xl backdrop-blur-md lg:grid" style="--d:.7s">
        <span class="absolute inset-2 rounded-full border border-dashed border-gold/25"></span>
        <span data-float class="relative" style="--d:1.2s">
            <span class="block text-[9px] uppercase tracking-[0.35em] text-gold/80">Est.</span>
            <span class="block font-serif text-3xl leading-tight text-cream">1995</span>
            <span class="block text-[9px] uppercase tracking-[0.28em] text-cream/60">Ananya &middot; Agra</span>
        </span>
    </div>

    <div data-hero-content class="relative z-10 mx-auto w-full max-w-7xl px-6 pb-24 pt-36 md:px-12 md:pb-32">
        <div class="motion-in-up" style="--d:.05s">
            <span class="inline-flex items-center gap-2.5 rounded-full border border-gold/30 bg-charcoal/40 px-4 py-2 text-[11px] font-medium uppercase tracking-[0.35em] text-gold shadow-lg shadow-black/20 backdrop-blur-md">
                <svg data-pulse-soft width="14" height="14" viewBox="0 0 24 24" fill="currentColor" class="text-gold"><path d="M12 2l1.9 6.1L20 10l-6.1 1.9L12 18l-1.9-6.1L4 10l6.1-1.9L12 2z"/></svg>
                Ananya - endless Decore Ideas
            </span>
        </div>
        <h1 class="motion-in-left mt-5 max-w-3xl font-serif text-2xl leading-[1.15] tracking-tight text-white drop-shadow-md sm:text-3xl md:text-4xl lg:text-5xl" style="--d:.15s">
            <span data-text-reveal style="--d:.2s"><span>A Unit of Bansal Wood</span></span><br>
            <span data-text-reveal style="--d:.42s"><em class="font-serif italic text-transparent bg-clip-text bg-gradient-to-r from-amber-200 via-gold to-amber-400">Decore Pvt.Ltd</em></span>
        </h1>
        <p class="motion-in-up mt-4 max-w-xl text-sm font-light leading-relaxed text-white/80 drop-shadow-sm md:text-base" style="--d:.46s">Premium interior trade solutions crafted around your lifestyle, personality, and architectural vision.</p>
        <div class="motion-in-up mt-8 flex flex-wrap items-center gap-3" style="--d:.6s">
            <a href="/products" data-tilt data-shine class="group inline-flex items-center gap-2.5 rounded-full bg-gradient-to-r from-gold via-amber-400 to-gold px-6 py-3 text-xs font-semibold uppercase tracking-wider text-charcoal shadow-xl transition-all duration-300 hover:shadow-gold/25">Explore Products <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="transition-transform duration-300 group-hover:translate-x-1"><path d="M5 12h14m-6-6 6 6-6 6"/></svg></a>
            <a href="/contact" data-tilt class="inline-flex items-center gap-2 rounded-full border border-white/30 bg-white/5 px-6 py-3 text-xs font-medium tracking-wide text-white shadow-lg backdrop-blur-md transition-all duration-300 hover:border-white/70 hover:bg-white hover:text-charcoal">Book a Consultation</a>
        </div>
    </div>

    <div class="absolute bottom-6 left-1/2 z-20 -translate-x-1/2">
        <a href="#categories" class="motion-in-up group flex flex-col items-center gap-2" style="--d:.8s">
            <span class="text-[10px] font-light uppercase tracking-[0.3em] text-white/60 transition-colors group-hover:text-gold">Scroll Down</span>
            <span data-bob class="flex h-8 w-8 items-center justify-center rounded-full border border-white/20 bg-white/5 backdrop-blur-md transition-colors group-hover:border-gold/50"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="m6 9 6 6 6-6"/></svg></span>
        </a>
    </div>
</section>

{{-- 2. BRAND MARQUEE --}}
<section id="brands" class="bg-beige/40 py-12 md:py-16">
    <div class="mx-auto max-w-7xl px-5 md:px-8">
        <div data-reveal="left">
            <p class="text-[11px] font-medium uppercase tracking-[0.3em] text-gold">In the showroom</p>
            <h2 class="mt-3 font-serif text-3xl leading-tight text-charcoal md:text-4xl">Our brands, in the <em class="font-serif italic text-golddark">headlines</em></h2>
            <div class="gold-line mt-4"></div>
        </div>
        <div class="marquee-fade relative mt-10 overflow-hidden">
            <div class="animate-marquee">
                @foreach ([...$featuredBrands, ...$featuredBrands] as $i => $brand)
                    <a href="/brands" class="group mr-3 grid h-24 w-48 shrink-0 place-items-center rounded-xl border border-charcoal/5 bg-white px-5 py-4 shadow-card transition-shadow duration-300 hover:shadow-lift sm:mr-4 sm:w-56" @if ($i >= count($featuredBrands)) aria-hidden="true" tabindex="-1" @endif>
                        <img src="{{ $brand['image'] }}" alt="{{ $brand['name'] }} logo" loading="lazy" class="max-h-12 w-full object-contain transition-all duration-500 sm:max-h-14">
                        <span class="hidden text-center font-serif text-lg text-charcoal">{{ $brand['name'] }}</span>
                    </a>
                @endforeach
            </div>
        </div>
    </div>
</section>

{{-- 3. INTERIOR CATEGORIES — GSAP pinned horizontal rail --}}
<section id="categories" data-hscroll class="relative bg-beige/60">
    <div data-hscroll-sticky class="flex h-screen flex-col justify-center overflow-hidden">
        <div class="mx-auto w-full max-w-7xl px-5 md:px-8" data-reveal="up">
            <p class="text-[11px] font-medium uppercase tracking-[0.3em] text-golddark">All Categories</p>
            <h2 class="mt-3 font-serif text-3xl leading-tight text-charcoal md:text-3xl">Browse Every Category</h2>
            <div class="mx-auto mt-4 h-px w-16 bg-gold"></div>
            <p class="mx-auto mt-4 max-w-2xl text-[15px] leading-relaxed text-coffee">From the first sketch to the final detail — interiors shaped around the way you live and work. Open a category to see all its products.</p>
        </div>
        <div data-hscroll-viewport class="mt-6 overflow-hidden py-12" style="-webkit-mask-image: linear-gradient(90deg, transparent, #000 6%, #000 94%, transparent); mask-image: linear-gradient(90deg, transparent, #000 6%, #000 94%, transparent);">
            <div data-hscroll-track class="flex w-max gap-5 px-5 md:gap-6 md:px-8">
                @foreach ($categories as $i => $category)
                    <div class="w-[210px] shrink-0 sm:w-[240px] lg:w-[280px] {{ $i % 2 === 0 ? '-translate-y-6' : 'translate-y-6' }}">
                        <a href="/products/{{ $category->slug }}" data-reveal="up" data-delay="{{ ($i % 3) * 100 }}" data-tilt class="group flex h-full flex-col overflow-hidden rounded-2xl border border-charcoal/5 bg-white shadow-card transition-all duration-300 hover:-translate-y-1 hover:border-gold/40 hover:shadow-lift">
                            <div class="relative h-44 overflow-hidden bg-beige sm:h-48">
                                <img src="{{ $category->image }}" alt="{{ $category->name }}" loading="lazy" class="h-full w-full object-cover object-center transition-transform duration-700 ease-out group-hover:scale-110">
                                <span class="absolute bottom-2.5 left-2.5 max-w-[85%] truncate rounded-full border border-white/20 bg-charcoal/85 px-3 py-1 text-[10px] font-medium tracking-wide text-white backdrop-blur">{{ is_array($category->brands) && count($category->brands) ? $category->brands[0] : 'Premium' }}</span>
                            </div>
                            <div class="flex flex-grow flex-col p-4">
                                <h3 class="font-serif text-lg leading-snug text-charcoal transition-colors group-hover:text-golddark">{{ $category->name }}</h3>
                                <p class="mt-2 line-clamp-4 text-[13px] leading-relaxed text-coffee">{{ $category->description }}</p>
                                <div class="mt-auto flex min-h-7 items-center justify-between gap-2 border-t border-charcoal/5 pt-3">
                                    <div class="flex min-w-0 flex-wrap gap-1">
                                        @foreach (array_slice(is_array($category->brands) ? $category->brands : [], 0, 2) as $brand)
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
    </div>
</section>

{{-- 4. HIGHLIGHTS — Why Choose Ananya? --}}
<section id="highlights" class="bg-cream py-16 md:py-20">
    <div class="mx-auto max-w-7xl px-5 md:px-8">
        <div class="mx-auto max-w-2xl text-center" data-reveal="up">
            <p class="text-[11px] font-medium uppercase tracking-[0.3em] text-golddark">The Studio Difference</p>
            <h2 class="mt-3 font-serif text-3xl leading-tight text-charcoal md:text-3xl">Why Choose Ananya?</h2>
            <div class="mx-auto mt-4 h-px w-16 bg-gold"></div>
            <p class="mt-4 text-[15px] leading-relaxed text-coffee">Three things we never compromise on — the people, the materials and the promise of time.</p>
        </div>
        <div class="mt-12 grid grid-cols-1 gap-6 md:grid-cols-3">
            @foreach ([
                ['Users', 'Expert Tradeers', 'Tradeers and site supervisors under one roof, translating your lifestyle into thoughtful, detail-led interiors.'],
                ['Gem', 'Premium Materials', 'Branded hardware and verified finishes from the material brands we have trusted since 1995.'],
                ['Timer', 'On-Time Delivery', 'Clear timelines, weekly site updates and a handover that respects your schedule.'],
            ] as $i => $highlight)
                <div data-lift class="group flex h-full items-start gap-5 rounded-2xl border border-charcoal/5 bg-white p-7 shadow-card transition-colors duration-300 hover:border-gold/40 hover:shadow-lift" data-reveal="{{ ['left', 'up', 'right'][$i] }}">
                    <span class="grid h-14 w-14 shrink-0 place-items-center rounded-2xl bg-beige text-espresso transition-colors duration-300 group-hover:bg-gold group-hover:text-charcoal">
                        @if ($highlight[0] === 'Users') <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2M9 11a4 4 0 1 0 0-8 4 4 0 0 0 0 8ZM22 21v-2a4 4 0 0 0-3-3.87M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                        @elseif ($highlight[0] === 'Gem') <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M6 3h12l4 6-10 12L2 9l4-6ZM2 9h20M12 21 7 9l5-6 5 6-5 12Z"/></svg>
                        @else <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 2"/></svg>@endif
                    </span>
                    <div>
                        <h3 class="font-serif text-xl text-charcoal">{{ $highlight[1] }}</h3>
                        <p class="mt-2 text-sm leading-relaxed text-coffee">{{ $highlight[2] }}</p>
                    </div>
                </div>
            @endforeach
        </div>
        <p class="mt-10 flex items-center justify-center gap-2 text-center text-xs text-stonewarm"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4h16v12H5.2L4 17V4ZM8 8h8M8 12h5"/></svg> Open 24 Hours — call or WhatsApp anytime for guidance.</p>
    </div>
</section>

{{-- ============ ACT II — THE CRAFT ============ --}}

{{-- 5. FEATURED MATERIALS --}}
<section class="relative overflow-hidden bg-[#1C1109] py-20 text-[#F7EEDF] md:py-24">
    <div class="pointer-events-none absolute -right-40 -top-24 h-[420px] w-[420px] rounded-full bg-[#D9B45B]/[0.07] blur-3xl"></div>
    <div class="pointer-events-none absolute -bottom-40 -left-32 h-[380px] w-[380px] rounded-full bg-[#D9B45B]/[0.05] blur-3xl"></div>
    <div class="absolute inset-x-0 top-0 h-px bg-gradient-to-r from-transparent via-[#D9B45B]/35 to-transparent"></div>
    <div class="relative mx-auto max-w-[1400px] px-5 md:px-8">
        <div class="grid gap-6 md:grid-cols-[1fr_auto] md:items-end">
            <div data-reveal="left">
                <div class="flex items-center gap-3"><span class="h-px w-10 bg-[#D9B45B]"></span><p class="text-[11px] font-medium uppercase tracking-[0.3em] text-[#D9B45B]">The Edit &middot; Most Requested</p></div>
                <h2 class="mt-4 font-serif text-4xl leading-[1.08] text-[#FBF3E7] md:text-5xl">Materials that <em class="italic text-[#D9B45B]">lead the way</em></h2>
            </div>
            <div data-reveal="right" data-delay="100">
                <p class="max-w-md text-[14px] leading-relaxed text-[#D9CBB4]">The finishes our clients ask for again and again — chosen for the way they look, feel and hold up in everyday life.</p>
                <a href="/products" class="group mt-4 inline-flex items-center gap-2 text-[12px] font-medium text-[#D9B45B] transition-colors hover:text-[#F0D48A]">View the full collection <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="transition-transform duration-300 group-hover:translate-x-1"><path d="M5 12h14m-6-6 6 6-6 6"/></svg></a>
            </div>
        </div>
        <div class="mt-10 grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4 xl:grid-cols-5">
            @foreach ($featured as $i => $item)
                <div class="h-full" data-reveal="{{ ['left', 'up', 'right', 'up', 'left'][$i % 5] }}" data-delay="{{ $i * 80 }}">
                    <div data-flip class="flip-scene group relative h-[420px] rounded-2xl shadow-card transition-[transform,box-shadow] duration-500 hover:-translate-y-1.5 hover:shadow-lift">
                        <div class="flip-inner">
                            <div class="flip-face flip-face--front flex flex-col rounded-2xl border border-[#B68B4D]/30 bg-[#F8F5EF] text-[#30251E]">
                                <div class="relative h-[52%] shrink-0 overflow-hidden bg-[#EDE5D9]">
                                    <img src="{{ $item['image'] }}" alt="{{ $item['name'] }}" loading="lazy" class="h-full w-full object-cover object-center">
                                    <div class="absolute inset-x-0 top-0 flex items-start justify-between gap-2 p-3"><span class="max-w-[70%] rounded-full bg-[#F8F5EF]/95 px-2.5 py-1 text-[8px] font-semibold uppercase leading-tight tracking-[0.18em] text-[#8A6A16] shadow-sm">{{ $item['tag'] }}</span></div>
                                </div>
                                <div class="flex flex-1 flex-col p-4">
                                    <h3 class="font-serif text-[18px] leading-tight text-[#30251E]">{{ $item['name'] }}</h3>
                                    <p class="mt-1.5 line-clamp-2 text-[11px] leading-relaxed text-[#6B5A45]">{{ $item['note'] }}</p>
                                    <div class="mt-auto pt-3">
                                        <div class="flex flex-wrap gap-1">
                                            @foreach (array_slice($item['brands'], 0, 3) as $brand)
                                                <span class="max-w-[110px] truncate rounded border border-[#B68B4D]/35 bg-[#EDE5D9] px-1.5 py-0.5 text-[8px] font-medium uppercase tracking-wide text-[#6B542E]">{{ $brand }}</span>
                                            @endforeach
                                        </div>
                                        <div class="mt-3 flex items-center justify-between gap-2 border-t border-[#B68B4D]/25 pt-2.5">
                                            <a href="/products/{{ $item['slug'] }}" class="inline-flex items-center gap-1 text-[9px] font-semibold uppercase tracking-[0.1em] text-[#8A6A16] transition-colors hover:text-[#30251E]">Explore Details <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M7 17 17 7M7 7h10v10"/></svg></a>
                                            <button type="button" data-flip-toggle aria-label="Show details for {{ $item['name'] }}" class="grid h-8 w-8 shrink-0 place-items-center rounded-full border border-[#B68B4D]/50 text-[#8A6A16] transition-colors hover:bg-[#B68B4D] hover:text-[#F8F5EF]"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14m-6-6 6 6-6 6"/></svg></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="flip-face flip-face--back flex flex-col rounded-2xl border border-[#B68B4D]/40 bg-[#30251E] p-4 text-[#F8F5EF]">
                                <div class="flex items-start justify-between gap-2">
                                    <p class="text-[8px] font-semibold uppercase tracking-[0.24em] text-[#B68B4D]">The Details</p>
                                    <button type="button" data-flip-toggle aria-label="Show front of {{ $item['name'] }}" class="grid h-7 w-7 shrink-0 place-items-center rounded-full border border-[#B68B4D]/50 text-[#B68B4D] transition-colors hover:bg-[#B68B4D] hover:text-[#30251E]"><svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 12a9 9 0 1 0 3-6.7L3 8m0-5v5h5"/></svg></button>
                                </div>
                                <h3 class="mt-2 font-serif text-[18px] leading-tight">{{ $item['name'] }}</h3>
                                <p class="mt-1.5 line-clamp-3 text-[10px] leading-relaxed text-[#EDE5D9]/75">{{ $item['details'] }}</p>
                                <div class="mt-3 space-y-1.5">
                                    @foreach (array_slice($item['features'], 0, 4) as $feature)
                                        <div class="flex items-center gap-2"><svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" class="shrink-0 text-[#B68B4D]"><path d="M20 6 9 17l-5-5"/></svg><span class="text-[10px] leading-tight text-[#EDE5D9]/85">{{ $feature }}</span></div>
                                    @endforeach
                                </div>
                                <div class="mt-3">
                                    <p class="text-[8px] font-semibold uppercase tracking-[0.2em] text-[#B68B4D]">Available in</p>
                                    <p class="mt-0.5 line-clamp-2 text-[10px] leading-snug text-[#EDE5D9]/70">{{ implode(' · ', array_slice($item['variants'], 0, 5)) }}</p>
                                </div>
                                <div class="mt-auto pt-3">
                                    <p class="text-[8px] font-semibold uppercase tracking-[0.2em] text-[#B68B4D]">Brands</p>
                                    <div class="mt-1 flex flex-wrap gap-1">
                                        @foreach (array_slice($item['brands'], 0, 4) as $brand)
                                            <span class="max-w-[110px] truncate rounded border border-[#B68B4D]/35 px-1.5 py-0.5 text-[8px] font-medium uppercase tracking-wide text-[#EDE5D9]/80">{{ $brand }}</span>
                                        @endforeach
                                    </div>
                                    <div class="mt-3 flex gap-2">
                                        <a href="/products/{{ $item['slug'] }}" class="flex-1 rounded-full bg-[#B68B4D] px-2 py-2 text-center text-[9px] font-semibold uppercase tracking-wide text-[#30251E] transition-colors hover:bg-[#D9B45B]">View Details</a>
                                        <a href="{{ $waBase }}?text={{ rawurlencode('Hi Ananya Interior, I would like to enquire about '.$item['name'].'.') }}" target="_blank" rel="noreferrer" class="flex-1 rounded-full border border-[#B68B4D]/70 px-2 py-2 text-center text-[9px] font-semibold uppercase tracking-wide text-[#F8F5EF] transition-colors hover:bg-[#B68B4D]/15">Enquire Now</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- 6. GALLERY --}}
<section id="gallery" class="mx-auto max-w-7xl px-5 py-20 md:px-8 md:py-28">
    <div class="mx-auto max-w-2xl text-center" data-reveal="up">
        <p class="text-[11px] font-medium uppercase tracking-[0.3em] text-golddark">Trade Showcase</p>
        <h2 class="mt-3 font-serif text-3xl leading-tight text-charcoal md:text-3xl">A Glimpse Inside Our Work</h2>
        <div class="mx-auto mt-4 h-px w-16 bg-gold"></div>
        <p class="mt-4 text-[15px] leading-relaxed text-coffee">Living rooms, bedrooms, kitchens, bathrooms and workspaces — each one considered down to the last detail.</p>
    </div>
    <div class="mt-12 grid grid-cols-2 gap-3 auto-rows-[150px] sm:auto-rows-[190px] md:grid-cols-4 md:auto-rows-[210px] md:gap-4">
        @foreach ($showcase as $i => $image)
            <button type="button" data-modal-open="gallery-modal-{{ $i }}" aria-label="View {{ $image['title'] }}" class="group relative block h-full w-full overflow-hidden rounded-2xl bg-charcoal text-left shadow-card {{ $i === 0 ? 'col-span-2 row-span-2' : '' }}" data-reveal="up" data-delay="{{ ($i % 4) * 100 }}">
                <img src="{{ $image['src'] }}" alt="{{ $image['title'] }}" loading="lazy" class="h-full w-full object-cover transition-transform duration-700 ease-out group-hover:scale-110">
                <div class="absolute inset-0 bg-gradient-to-t from-charcoal/85 via-charcoal/10 to-transparent opacity-80 transition-opacity duration-500 group-hover:opacity-95"></div>
                <div class="absolute inset-x-0 bottom-0 flex items-end justify-between gap-2 p-4 md:p-5">
                    <div><p class="font-serif text-base leading-tight text-cream md:text-lg">{{ $image['title'] }}</p><p class="mt-1 text-[10px] uppercase tracking-[0.2em] text-cream/60">{{ $image['category'] }}</p></div>
                    <span class="grid h-9 w-9 shrink-0 place-items-center rounded-full bg-cream/90 text-charcoal opacity-0 transition-all duration-300 group-hover:opacity-100"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M8 3H3v5M16 3h5v5M8 21H3v-5M16 21h5v-5"/></svg></span>
                </div>
            </button>
        @endforeach
    </div>
    @foreach ($showcase as $i => $image)
        <div data-modal id="gallery-modal-{{ $i }}" hidden>
            <div class="modal-backdrop" data-modal-close></div>
            <div class="modal-panel mx-auto max-w-4xl overflow-hidden rounded-3xl bg-cream shadow-lift">
                <button type="button" data-modal-close aria-label="Close image" class="absolute right-5 top-5 z-10 grid h-9 w-9 place-items-center rounded-full bg-charcoal/70 text-white transition-colors hover:bg-gold hover:text-charcoal"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 6 6 18M6 6l12 12"/></svg></button>
                <img src="{{ $image['src'] }}" alt="{{ $image['title'] }}" class="max-h-[65vh] w-full object-cover">
                <div class="px-6 py-5 md:px-8"><p class="font-serif text-2xl text-charcoal">{{ $image['title'] }}</p><p class="mt-1 text-[11px] tracking-[0.2em] uppercase text-golddark">{{ $image['category'] }}</p></div>
            </div>
        </div>
    @endforeach
</section>

{{-- 7. PROJECTS --}}
<section id="projects" class="mx-auto max-w-7xl px-3 py-17 md:px-5 md:py-25">
    <div class="mx-auto max-w-2xl text-center" data-reveal="up">
        <p class="text-[11px] font-medium uppercase tracking-[0.3em] text-golddark">Featured Projects</p>
        <h2 class="mt-3 font-serif text-3xl leading-tight text-charcoal md:text-3xl">Spaces We're Proud Of</h2>
        <div class="mx-auto mt-4 h-px w-16 bg-gold"></div>
        <p class="mt-4 text-[15px] leading-relaxed text-coffee">A selection of homes, kitchens and workplaces crafted across Agra. Select a project to explore the story behind it.</p>
    </div>
    <div class="mt-12 grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-4 md:gap-6">
        @foreach ($featuredProjects as $i => $project)
            <article class="group relative h-full overflow-hidden rounded-2xl bg-charcoal shadow-card transition-shadow duration-500 hover:shadow-lift" data-reveal="{{ ['left', 'up', 'right', 'up'][$i] }}">
                <img src="{{ $project['image'] }}" alt="{{ $project['name'] }}" loading="lazy" class="h-72 w-full object-cover transition-transform duration-700 ease-out group-hover:scale-110">
                <div class="absolute inset-0 bg-gradient-to-t from-charcoal via-charcoal/30 to-transparent"></div>
                <span class="absolute left-4 top-4 rounded-full bg-cream/90 px-3 py-1 text-[10px] uppercase tracking-[0.2em] font-medium text-espresso backdrop-blur">{{ $project['category'] }}</span>
                <div class="absolute inset-x-0 bottom-0 p-5">
                    <h3 class="font-serif text-xl leading-tight text-cream">{{ $project['name'] }}</h3>
                    <p class="mt-1.5 flex items-center gap-1.5 text-xs text-cream/70"><svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/><circle cx="12" cy="10" r="3"/></svg>{{ $project['location'] }}</p>
                    <button type="button" data-modal-open="project-modal-{{ $i }}" class="group/link mt-4 inline-flex items-center gap-1.5 text-[13px] font-medium text-gold transition-colors hover:text-cream">View Project <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="transition-transform duration-300 group-hover/link:translate-x-0.5 group-hover/link:-translate-y-0.5"><path d="M7 17 17 7M7 7h10v10"/></svg></button>
                </div>
            </article>
            <div data-modal id="project-modal-{{ $i }}" hidden>
                <div class="modal-backdrop" data-modal-close></div>
                <div class="modal-panel mx-auto max-w-4xl overflow-hidden rounded-3xl bg-cream shadow-lift">
                    <button type="button" data-modal-close aria-label="Close project" class="absolute right-4 top-4 z-10 grid h-9 w-9 place-items-center rounded-full bg-charcoal/70 text-white transition-colors hover:bg-gold hover:text-charcoal"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 6 6 18M6 6l12 12"/></svg></button>
                    <img src="{{ $project['image'] }}" alt="{{ $project['name'] }}" class="max-h-[46vh] w-full object-cover">
                    <div class="px-6 pb-8 pt-6 md:px-9">
                        <p class="text-[11px] uppercase tracking-[0.28em] text-golddark">{{ $project['category'] }} · {{ $project['location'] }}</p>
                        <h3 class="mt-2 font-serif text-2xl text-charcoal md:text-3xl">{{ $project['name'] }}</h3>
                        <p class="mt-4 text-[15px] leading-relaxed text-coffee">{{ $project['description'] }}</p>
                        <div class="mt-6 grid gap-x-6 gap-y-2.5 sm:grid-cols-2">
                            @foreach ($project['highlights'] as $highlight)
                                <p class="flex items-center gap-2 text-sm text-charcoal/85"><svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="shrink-0 text-golddark"><path d="M20 6 9 17l-5-5"/></svg>{{ $highlight }}</p>
                            @endforeach
                        </div>
                        <div class="mt-7 grid grid-cols-3 gap-3">
                            @foreach ($project['gallery'] as $src)
                                <img src="{{ $src }}" alt="{{ $project['name'] }} view" loading="lazy" class="h-24 w-full rounded-xl object-cover md:h-32">
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</section>

{{-- 8. TESTIMONIALS — 3D cover flow --}}
<section id="testimonials" class="relative overflow-hidden bg-[#faf5ef] py-16 md:py-20">
    <div class="pointer-events-none absolute -left-20 -top-24 h-64 w-64 rounded-full border border-[#d6a45c]/30"></div>
    <div class="pointer-events-none absolute -left-16 -top-20 h-72 w-72 rounded-full border border-[#d6a45c]/20"></div>
    <div class="pointer-events-none absolute -right-20 -bottom-24 h-72 w-72 rounded-full border border-[#d6a45c]/30"></div>
    <div class="relative mx-auto max-w-7xl px-5 md:px-8">
        <div class="mx-auto max-w-3xl text-center" data-reveal="up">
            <div class="mb-5 flex items-center justify-center gap-5"><span class="h-px w-16 bg-[#c89542]"></span><span class="text-[11px] font-semibold uppercase tracking-[0.4em] text-charcoal">Testimonials</span><span class="h-px w-16 bg-[#c89542]"></span></div>
            <h2 class="font-serif text-2xl leading-tight text-[#171411] md:text-4xl">What Our Clients Say</h2>
            <p class="mx-auto mt-4 max-w-2xl text-sm leading-7 text-[#68615b] md:text-base">Real experiences from homeowners, architects and traders who trust us for quality, service and long-term value.</p>
        </div>
        <div class="relative mt-8 md:mt-12" data-reveal="zoom">
            <div data-coverflow class="relative mx-auto h-[370px] overflow-hidden md:h-[410px]">
                @foreach ($stories as $i => $review)
                    <div data-coverflow-card class="absolute left-1/2 top-1/2 w-[min(75vw,360px)]">
                        <div class="relative flex min-h-[320px] cursor-pointer flex-col items-center rounded-[25px] border border-[#e8d8c5] bg-gradient-to-br from-white via-[#fffaf4] to-[#f5e9dc] px-5 py-5 text-center shadow-[0_20px_55px_rgba(91,65,40,0.13)] md:min-h-[350px] md:px-7 md:py-6">
                            <svg width="34" height="34" viewBox="0 0 24 24" fill="#e8c99e" class="absolute left-5 top-5 text-[#e8c99e]"><path d="M7.5 11h3v2.5H6V11a5 5 0 0 1 5-5v2.4a2.6 2.6 0 0 0-2.5 2.6zm10 0h3v2.5H16V11a5 5 0 0 1 5-5v2.4a2.6 2.6 0 0 0-2.5 2.6z"/></svg>
                            <div class="mt-1 h-[82px] w-[82px] overflow-hidden rounded-full border-[3px] border-[#c89542] bg-white p-1 shadow-md md:h-[90px] md:w-[90px]"><img src="{{ $review['avatar'] }}" alt="{{ $review['name'] }}" loading="lazy" class="h-full w-full rounded-full object-cover"></div>
                            <h3 class="mt-3 font-serif text-lg font-semibold text-[#211b16] md:text-xl">{{ $review['name'] }}</h3>
                            <p class="mt-1 text-[11px] font-medium text-[#74675b] md:text-xs">{{ $review['location'] }}</p>
                            <div class="mt-3 flex items-center justify-center gap-1 text-[#d4a24c]">@for ($s = 0; $s < $review['rating']; $s++)<span aria-hidden="true">&#9733;</span>@endfor</div>
                            <blockquote class="mt-4 line-clamp-4 flex-grow font-sans text-[13px] leading-6 text-[#302b26] md:text-sm">&ldquo;{{ $review['text'] }}&rdquo;</blockquote>
                            <div class="mt-4 h-px w-10 bg-[#c89542]"></div>
                            <p class="mt-2 text-[9px] uppercase tracking-[0.2em] text-[#998777]">{{ $review['date'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="mt-3 flex items-center justify-center gap-6">
                <button type="button" data-coverflow-prev aria-label="Previous testimonial" class="flex h-10 w-10 items-center justify-center rounded-full border border-[#d6a45c]/50 text-[#a47a3e] transition-all duration-300 hover:bg-[#c89542] hover:text-white"><svg width="19" height="19" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="m15 18-6-6 6-6"/></svg></button>
                <div data-coverflow-dots class="flex items-center gap-2"></div>
                <button type="button" data-coverflow-next aria-label="Next testimonial" class="flex h-10 w-10 items-center justify-center rounded-full border border-[#d6a45c]/50 text-[#a47a3e] transition-all duration-300 hover:bg-[#c89542] hover:text-white"><svg width="19" height="19" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="m9 18 6-6 6-6"/></svg></button>
            </div>
        </div>
    </div>
</section>

{{-- ============ ACT III — THE STORY ============ --}}

{{-- 9. FEATURE BANNER --}}
<section class="relative flex min-h-[460px] w-full items-center overflow-hidden bg-charcoal md:min-h-[560px]">
    <div data-parallax="10" data-parallax-scale class="absolute -inset-[6%] h-[112%] w-[112%] overflow-hidden will-change-transform">
        <img src="https://images.unsplash.com/photo-1600489000022-c2086d79f9d4?q=80&w=2000&auto=format&fit=crop" alt="Premium modular kitchen by Ananya Interior" loading="lazy" class="h-full w-full object-cover object-center">
    </div>
    <div class="absolute inset-0 bg-gradient-to-r from-charcoal/90 via-charcoal/65 to-charcoal/20"></div>
    <div class="absolute inset-0 bg-gradient-to-t from-charcoal/60 via-transparent to-transparent"></div>
    <div class="relative z-10 mx-auto w-full max-w-7xl px-5 py-20 md:px-8 md:py-24">
        <div class="max-w-xl" data-reveal="left">
            <p class="inline-flex items-center gap-2 text-[11px] uppercase tracking-[0.3em] text-gold"><svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2l1.9 6.1L20 10l-6.1 1.9L12 18l-1.9-6.1L4 10l6.1-1.9L12 2z"/></svg> Featured Space</p>
            <h2 class="mt-5 font-serif text-3xl leading-[1.15] text-cream md:text-5xl">Kitchens That Inspire <em class="italic text-gold">Everyday Living.</em></h2>
            <div class="mt-5 h-px w-20 bg-gold"></div>
            <p class="mt-5 max-w-lg text-[15px] leading-relaxed text-cream/75">Tall storage, quartz islands and easy-clean finishes — chef-grade workflow shaped around the way your family gathers.</p>
            <a href="/services/modular-kitchen" class="group mt-8 inline-flex items-center gap-3 rounded-full bg-gold px-8 py-3.5 text-sm font-medium tracking-wide text-charcoal transition-colors hover:bg-cream">Explore More <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="transition-transform duration-300 group-hover:translate-x-1"><path d="M5 12h14m-6-6 6 6-6 6"/></svg></a>
        </div>
    </div>
</section>

{{-- 10. ABOUT SECTION --}}
<section id="about" class="mx-auto max-w-7xl px-5 py-20 md:px-8 md:py-28">
    <div class="grid items-start gap-12 lg:grid-cols-2 lg:gap-20">
        <div data-reveal="left">
            <span class="mb-3 inline-block text-[11px] font-semibold uppercase tracking-[0.35em] text-golddark">About Ananya</span>
            <h2 class="font-serif text-3xl font-semibold leading-[1.15] tracking-tight text-charcoal md:text-4xl lg:text-5xl">Spaces Tradeed <br class="hidden md:block">Around You.</h2>
            <div class="mt-5 h-px w-20 bg-gold"></div>
            <p class="mt-6 text-base font-light leading-relaxed text-coffee md:text-lg">Ananya, a front-runner one-stop interior and exterior products mall has its origin in the year 1995. A humble start-up by Mr. Vikas Bansal by the name of &ldquo;M/s Bansal Wood Decor (P) Ltd.&rdquo;, focusing on a single point — plywood, laminates, doors, veneers and other interior &amp; exterior products.</p>
            <div class="mt-8 grid max-w-md grid-cols-3 gap-4">
                <div class="border-l-2 border-gold/60 pl-4"><p class="font-serif text-2xl text-espresso md:text-3xl">1995</p><p class="mt-1 text-[11px] uppercase tracking-[0.18em] text-stonewarm">Founded</p></div>
                <div class="border-l-2 border-gold/60 pl-4"><p class="font-serif text-2xl text-espresso md:text-3xl">24+</p><p class="mt-1 text-[11px] uppercase tracking-[0.18em] text-stonewarm">Years of craft</p></div>
                <div class="border-l-2 border-gold/60 pl-4"><p class="font-serif text-2xl text-espresso md:text-3xl">Agra</p><p class="mt-1 text-[11px] uppercase tracking-[0.18em] text-stonewarm">Our home</p></div>
            </div>
            <a href="/about" class="group mt-9 inline-flex items-center gap-3 rounded-full bg-charcoal px-8 py-4 text-sm font-medium tracking-wide text-cream shadow-xl transition-colors hover:bg-espresso">Discover Our Story <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="transition-transform duration-300 group-hover:translate-x-1.5"><path d="M5 12h14m-6-6 6 6-6 6"/></svg></a>
            <div class="mt-8 grid gap-4 sm:grid-cols-3">
                @foreach ([
                    ['Lightbulb', 'Our Vision', 'Thoughtful, beautiful interiors made for real life.'],
                    ['Compass', 'Trade Philosophy', 'Plan light, storage and flow before finishes.'],
                    ['Award', 'Our Experience', 'Since 1995 — trusted across Agra.'],
                ] as $i => $principle)
                    <div class="h-full rounded-2xl border border-charcoal/5 bg-beige/50 p-5 transition-all duration-300 hover:border-gold/40 hover:shadow-card" data-reveal="{{ ['left', 'up', 'right'][$i] }}" data-delay="{{ 180 + $i * 60 }}">
                        <span class="grid h-10 w-10 shrink-0 place-items-center rounded-xl bg-charcoal text-gold">
                            @if ($principle[0] === 'Lightbulb') <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M9 18h6M10 22h4M8.5 14.5A7 7 0 1 1 15.5 14.5c-.9.7-1.5 1.6-1.5 2.5h-4c0-.9-.6-1.8-1.5-2.5Z"/></svg>
                            @elseif ($principle[0] === 'Compass') <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><circle cx="12" cy="12" r="9"/><path d="m15.5 8.5-2 5-5 2 2-5 5-2Z"/></svg>
                            @else <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M12 3 5 7v5c0 4.5 3 8.3 7 9 4-.7 7-4.5 7-9V7l-7-4ZM9 12l2 2 4-4"/></svg>@endif
                        </span>
                        <h4 class="mt-4 font-serif text-lg text-charcoal">{{ $principle[1] }}</h4>
                        <p class="mt-2 text-[13px] leading-relaxed text-coffee">{{ $principle[2] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="space-y-5">
            <div data-reveal="right" data-delay="80">
                <div class="rounded-3xl border border-charcoal/5 bg-white p-7 shadow-card md:p-9">
                    <p class="text-[11px] font-medium uppercase tracking-[0.3em] text-golddark">Our Story</p>
                    <h3 class="mt-3 font-serif text-2xl text-charcoal md:text-3xl">Two decades of crafting under one roof.</h3>
                    <p class="mt-4 text-[15px] leading-relaxed text-coffee">It's been almost two and a half decades in the journey of providing the best products in the best class under one roof. What began with plywood and laminates has grown into a complete interior and exterior destination — backed by a trade studio that plans, executes and handovers with care.</p>
                    <p class="mt-5 flex items-center gap-2 text-sm text-stonewarm"><svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="text-gold"><path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/><circle cx="12" cy="10" r="3"/></svg>Agra, Uttar Pradesh &middot; Open 24 Hours</p>
                </div>
            </div>
            <div data-reveal="right" data-delay="120">
                <div class="rounded-3xl bg-charcoal p-7 text-cream md:p-9">
                    <p class="text-[11px] uppercase tracking-[0.3em] text-gold">How We Work</p>
                    <h4 class="mt-2 font-serif text-2xl">From Vision to Reality</h4>
                    <div class="mt-6 grid gap-4 sm:grid-cols-2">
                        @foreach ([
                            ['01', 'Consultation', 'We listen to your needs, lifestyle and budget.'],
                            ['02', 'Understanding Your Space', 'Site visit, measurements and light study.'],
                            ['03', 'Concept & Trade', 'Moodboards, layouts and 3D views.'],
                            ['04', 'Material Selection', 'Curated finishes, fabrics and fixtures.'],
                            ['05', 'Execution', 'Skilled site team with quality checks.'],
                            ['06', 'Final Reveal', 'Deep-cleaned, styled and ready to move in.'],
                        ] as $step)
                            <div class="flex items-start gap-3 border-t border-white/10 pt-3"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="mt-0.5 shrink-0 text-gold"><path d="M5 12h14m-6-6 6 6-6 6"/></svg><div><p class="text-sm text-cream/90">{{ $step[1] }}</p><p class="mt-0.5 text-xs text-cream/50">{{ $step[2] }}</p></div></div>
                        @endforeach
                    </div>
                    <p class="mt-6 flex items-center gap-2 text-xs text-cream/50"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="text-gold"><circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/></svg>Open 24 Hours — call or WhatsApp anytime for guidance.</p>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- 11. JOURNAL (full BlogExperience) --}}
<div class="bg-[#F8F4EE] pt-[72px] text-[#29231F]">
    {{-- Journal hero --}}
    <section class="relative h-[230px] overflow-hidden bg-[#201A16] sm:h-[245px] lg:h-[260px]">
        <img src="{{ $blogPosts[0]['image'] }}" alt="Warm luxury living room" class="journal-zoom absolute inset-0 h-full w-full object-cover object-center">
        <div class="absolute inset-0 bg-gradient-to-r from-[#201A16]/95 via-[#201A16]/70 to-[#201A16]/5"></div>
        <div class="absolute inset-0 bg-gradient-to-t from-[#201A16]/50 via-transparent to-transparent"></div>
        <div class="relative mx-auto flex h-full max-w-[1240px] flex-col justify-center px-6 sm:px-10 lg:px-9">
            <span class="motion-in-up inline-flex w-fit items-center gap-2 rounded-full border border-[#BD9254]/70 px-3.5 py-1.5 text-[9px] font-medium uppercase tracking-[0.3em] text-[#D9B87F]" style="--d:.1s"><span class="h-1.5 w-1.5 rounded-full bg-[#BD9254]"></span>Journal</span>
            <h1 class="motion-in-up mt-4 max-w-2xl font-serif text-[34px] leading-[1.05] text-[#F8F4EE] sm:text-[44px] lg:text-[50px]" style="--d:.22s">Ideas &amp; Inspiration</h1>
            <p class="motion-in-up mt-3 max-w-md text-[12px] leading-relaxed text-[#E8DCCB]/85 sm:text-[13px]" style="--d:.34s">Practical thinking on materials, layouts and the details that make a space feel like yours.</p>
            <a href="#journal-intro" class="motion-in-up mt-5 inline-flex w-fit items-center gap-2.5 rounded-full bg-[#BD9254] px-5 py-2.5 text-[11px] font-semibold text-[#29231F] transition-colors hover:bg-[#D0A867]" style="--d:.46s">Explore Articles <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14m-6-6 6 6-6 6"/></svg></a>
        </div>
    </section>
    {{-- Category strip --}}
    <nav class="border-b border-[#E4D6C4] bg-[#F2E9DE]">
        <div class="no-scrollbar mx-auto flex max-w-[1240px] items-stretch overflow-x-auto px-3 sm:px-6 lg:px-9">
            @foreach ([['Design Ideas','design'],['Material Guides','materials'],['Space Planning','space'],['Trends & Inspiration','trends']] as $i => $tab)
                <button type="button" data-filter="{{ $tab[1] }}" data-filter-target="latest-articles" class="flex min-w-[170px] flex-1 items-center justify-center whitespace-nowrap px-3 py-3.5 text-[11px] font-medium tracking-[0.06em] transition-colors sm:min-w-0 {{ $i > 0 ? 'border-l border-[#D5B98F]/70' : '' }} {{ $i === 0 ? 'is-active bg-charcoal text-cream' : 'text-[#5C4C3C] hover:text-[#A98548]' }}">{{ $tab[0] }}</button>
            @endforeach
        </div>
    </nav>
    {{-- Journal intro --}}
    <section id="journal-intro" class="relative overflow-hidden bg-[#F8F4EE] px-5 pb-2 pt-7 text-center sm:pt-8">
        <div class="pointer-events-none absolute -right-6 -top-10 hidden h-60 w-60 opacity-70 sm:block soft-leaf-shadow"></div>
        <div class="mx-auto max-w-3xl" data-reveal="up">
            <p class="flex items-center justify-center gap-3 text-[10px] font-semibold uppercase tracking-[0.32em] text-[#A98548]"><span class="h-px w-10 bg-[#D9B87F]"></span>Our Journal<span class="h-px w-10 bg-[#D9B87F]"></span></p>
            <h2 class="mt-2 font-serif text-[29px] leading-tight text-[#29231F] sm:text-[36px]">Ideas &amp; Inspiration</h2>
            <div class="mx-auto mt-2 h-px w-16 bg-[#BD9254]"></div>
            <p class="mx-auto mt-3 max-w-xl text-[11px] leading-relaxed text-[#827467] sm:text-[12px]">Notes from our studio — practical thinking on materials, layouts and the details that make a space feel like yours.</p>
        </div>
    </section>
    {{-- Featured article --}}
    <section class="bg-[#F8F4EE] px-5 py-4 sm:px-8 sm:py-5">
        <div class="mx-auto grid max-w-[1240px] items-center gap-7 lg:grid-cols-[minmax(0,1.5fr)_minmax(0,1fr)_minmax(0,0.8fr)] lg:gap-8">
            <div data-reveal="left">
                <div class="group relative overflow-hidden rounded-xl shadow-card">
                    <img src="https://images.unsplash.com/photo-1616486338812-3dadae4b4ace?q=80&w=1200&auto=format&fit=crop" alt="{{ $blogPosts[0]['title'] }}" loading="lazy" class="aspect-[2.15/1] w-full object-cover object-center transition-transform duration-700 ease-out group-hover:scale-105">
                    <span class="absolute left-4 top-4 rounded-full bg-[#F8F4EE]/95 px-3 py-1.5 text-[9px] font-semibold uppercase tracking-[0.18em] text-[#8A6A16] shadow-sm">Featured</span>
                    <button type="button" data-modal-open="article-modal-0" aria-label="Read {{ $blogPosts[0]['title'] }}" class="absolute bottom-4 right-4 grid h-10 w-10 place-items-center rounded-full bg-[#F8F4EE]/95 text-[#29231F] shadow-md transition-colors hover:bg-[#BD9254] hover:text-white"><svg width="15" height="15" viewBox="0 0 24 24" fill="currentColor"><path d="M8 5v14l11-7z"/></svg></button>
                </div>
            </div>
            <div data-reveal="up">
                <p class="flex items-center gap-2 text-[10px] tracking-[0.1em] text-[#827467]"><svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="text-[#A98548]"><rect x="3" y="5" width="18" height="16" rx="2"/><path d="M16 3v4M8 3v4M3 11h18"/></svg>{{ $blogPosts[0]['date'] }}</p>
                <h3 class="mt-2 font-serif text-[22px] leading-[1.18] text-[#29231F] sm:text-[25px]">{{ $blogPosts[0]['title'] }}</h3>
                <p class="mt-2 max-w-sm text-[12px] leading-relaxed text-[#7A6C5E]">{{ $blogPosts[0]['excerpt'] }}</p>
                <button type="button" data-modal-open="article-modal-0" class="group/link mt-4 inline-flex items-center gap-2.5 rounded-full bg-[#BD9254] px-5 py-2.5 text-[11px] font-semibold text-[#29231F] transition-colors hover:bg-[#D0A867]">Read Full Article <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="transition-transform duration-300 group-hover/link:translate-x-1"><path d="M5 12h14m-6-6 6 6-6 6"/></svg></button>
            </div>
            <div data-reveal="right">
                <div class="lg:border-l lg:border-[#D9B87F]/50 lg:pl-7">
                    <h3 class="font-serif text-[20px] text-[#29231F]">Categories</h3>
                    <div class="mt-3 space-y-1.5">
                        @foreach ([['Living Room','12','design'],['Kitchen','08','materials'],['Bedroom','10','trends'],['Materials','15','materials'],['Design Tips','09','space']] as $cat)
                            <button type="button" data-filter="{{ $cat[2] }}" data-filter-target="latest-articles" class="flex w-full items-center gap-2.5 rounded-full border border-[#E8DCCD] bg-white px-3.5 py-1.5 text-left shadow-sm transition-all hover:-translate-y-0.5 hover:border-[#BD9254] hover:shadow-card"><span class="flex-1 text-[11px] font-medium text-[#5C4C3C]">{{ $cat[0] }}</span><span class="text-[10px] tabular-nums text-[#A98548]">{{ $cat[1] }}</span></button>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{-- Latest articles --}}
    <section id="latest-articles" class="scroll-mt-24 bg-[#F8F4EE] px-5 pb-6 pt-0 sm:px-8">
        <div class="mx-auto max-w-[1240px]">
            <div class="mb-5 flex flex-wrap items-end justify-between gap-3">
                <h2 class="font-serif text-[27px] leading-tight text-[#29231F] sm:text-[31px]">Latest Articles</h2>
                <a href="#latest-articles" class="inline-flex items-center gap-2 text-[11px] font-medium text-[#A98548]">View All Articles <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14m-6-6 6 6-6 6"/></svg></a>
            </div>
            <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-4" id="latest-articles-grid">
                @foreach ($blogPosts as $i => $article)
                    <article data-filter-item data-category="{{ $article['filter'] }}" class="group flex h-full flex-col overflow-hidden rounded-xl border border-[#EDE3D6] bg-white shadow-card transition-all duration-300 hover:-translate-y-1 hover:shadow-lift" data-reveal="up" data-delay="{{ ($i % 4) * 80 }}">
                        <div class="relative overflow-hidden bg-[#EFE6DA]">
                            <img src="{{ $article['image'] }}" alt="{{ $article['title'] }}" loading="lazy" class="aspect-[2/1] w-full object-cover object-center transition-transform duration-700 ease-out group-hover:scale-110">
                            <span class="absolute left-3 top-3 rounded-full bg-[#F8F4EE]/95 px-2.5 py-1 text-[8px] font-semibold uppercase tracking-[0.16em] text-[#8A6A16] shadow-sm">{{ $article['category'] }}</span>
                        </div>
                        <div class="flex flex-1 flex-col p-3">
                            <p class="flex items-center gap-1.5 text-[10px] text-[#827467]">{{ $article['date'] }}</p>
                            <h3 class="mt-1.5 font-serif text-[14px] leading-snug text-[#29231F] transition-colors group-hover:text-[#A98548]">{{ $article['title'] }}</h3>
                            <p class="mt-1.5 line-clamp-2 text-[10px] leading-relaxed text-[#7A6C5E]">{{ $article['excerpt'] }}</p>
                            <button type="button" data-modal-open="article-modal-{{ $i }}" class="group/link mt-auto inline-flex items-center gap-1.5 pt-3 text-[10.5px] font-semibold text-[#A98548]">Read More <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="transition-transform duration-300 group-hover/link:translate-x-1"><path d="M5 12h14m-6-6 6 6-6 6"/></svg></button>
                        </div>
                    </article>
                @endforeach
            </div>
        </div>
    </section>
    {{-- Newsletter --}}
    <section class="relative overflow-hidden bg-[#30231C]">
        <div class="absolute inset-y-0 left-0 hidden w-[22%] sm:block"><img src="https://images.unsplash.com/photo-1600210492486-724fe5c67fb0?q=80&w=900&auto=format&fit=crop" alt="Warm interior details" loading="lazy" class="h-full w-full object-cover object-center"><div class="absolute inset-0 bg-gradient-to-r from-transparent via-[#30231C]/40 to-[#30231C]"></div></div>
        <div class="relative mx-auto grid max-w-[1240px] items-center gap-6 px-5 py-7 sm:px-8 sm:py-9 lg:grid-cols-[minmax(0,1fr)_auto] lg:pl-[26%]">
            <div>
                <p class="text-[9px] font-semibold uppercase tracking-[0.32em] text-[#C9A76C]">Stay Inspired</p>
                <h2 class="mt-2 font-serif text-[22px] leading-tight text-[#F8F4EE] sm:text-[27px]">Get Design Ideas in Your Inbox</h2>
                <p class="mt-2 text-[11px] text-[#D8C8B6]">Join our newsletter for fresh articles, trend updates and material insights.</p>
            </div>
            <form action="mailto:contact@ananyadesigns.com" method="get" enctype="text/plain" class="flex w-full flex-col gap-2.5 sm:flex-row lg:w-auto">
                <input type="email" name="email" required placeholder="Enter your email" aria-label="Email address" class="w-full rounded-full border border-white/20 bg-white px-5 py-3 text-[12px] text-[#29231F] placeholder:text-[#9A8B7E] sm:w-[260px]">
                <button type="submit" data-shine class="inline-flex items-center justify-center gap-2.5 rounded-full bg-[#BD9254] px-5 py-3 text-[11px] font-semibold text-[#29231F] transition-colors hover:bg-[#D0A867]">Subscribe <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14m-6-6 6 6-6 6"/></svg></button>
            </form>
        </div>
    </section>
    @foreach ($blogPosts as $i => $article)
        <div data-modal id="article-modal-{{ $i }}" hidden>
            <div class="modal-backdrop" data-modal-close></div>
            <div class="modal-panel mx-auto max-w-3xl overflow-hidden rounded-3xl bg-cream shadow-lift">
                <button type="button" data-modal-close aria-label="Close article" class="absolute right-4 top-4 z-10 grid h-9 w-9 place-items-center rounded-full bg-charcoal/70 text-white transition-colors hover:bg-gold hover:text-charcoal"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 6 6 18M6 6l12 12"/></svg></button>
                <img src="{{ $article['image'] }}" alt="{{ $article['title'] }}" class="max-h-[40vh] w-full object-cover">
                <div class="px-6 py-6 md:px-8">
                    <p class="text-[11px] uppercase tracking-[0.24em] text-golddark">{{ $article['category'] }} &middot; {{ $article['date'] }}</p>
                    <h3 class="mt-2 font-serif text-2xl text-charcoal md:text-3xl">{{ $article['title'] }}</h3>
                    <p class="mt-4 text-[15px] leading-relaxed text-coffee">{{ $article['body'] }}</p>
                    <div class="mt-6 grid gap-2 sm:grid-cols-2">
                        @foreach ($article['highlights'] as $highlight)
                            <p class="flex items-center gap-2 text-sm text-charcoal/85"><svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="shrink-0 text-golddark"><path d="M20 6 9 17l-5-5"/></svg>{{ $highlight }}</p>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>

{{-- 12. TRENDING VIDEOS --}}
<section id="trending" class="w-full bg-[#F5F1EE] px-[4.4%] pb-8 pt-[55px]">
    <div class="mb-4 flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between" data-reveal="up">
        <div>
            <p class="text-[11px] font-medium uppercase tracking-[3px] text-[#B08A6E]">Now Showing</p>
            <h2 class="mt-3 font-serif text-[30px] leading-[1.2] text-charcoal md:whitespace-nowrap md:text-[36px]"><span>Trending</span> <em class="italic text-[#A9795E]">trade and decor</em> <span>tips</span></h2>
        </div>
        <a href="/blog" class="w-fit pb-[3px] text-[13px] text-charcoal underline decoration-charcoal/60 underline-offset-4 transition-all hover:text-[#A9795E]">View all</a>
    </div>
    <div data-drag-scope class="relative">
        <button type="button" data-drag-prev aria-label="Previous videos" class="absolute left-[-2%] top-1/2 z-20 grid h-10 w-10 -translate-y-1/2 place-items-center rounded-full bg-white text-charcoal shadow-[0_4px_18px_rgba(0,0,0,0.16)] transition-all hover:scale-105 md:left-[-3.2%] md:h-11 md:w-11"><svg width="19" height="19" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="m15 18-6-6 6-6"/></svg></button>
        <div data-drag-rail class="no-scrollbar flex snap-x gap-[18px] overflow-x-auto md:gap-[29px]">
            @foreach ($reels as $i => $reel)
                <article class="group relative aspect-[275/500] w-[72vw] max-w-[275px] shrink-0 snap-start overflow-hidden rounded-[5px] bg-[#E7E1DA] sm:w-[275px]" aria-label="{{ $reel['title'] }}" data-reveal="up" data-delay="{{ $i * 60 }}">
                    <video data-reel class="h-full w-full object-cover object-center transition-transform duration-700 ease-out group-hover:scale-[1.04]" autoplay muted loop playsinline preload="metadata">
                        <source src="{{ $reel['src'] }}" type="video/mp4">
                    </video>
                    @if ($reel['caption'])
                        <span class="pointer-events-none absolute inset-x-4 bottom-[7%] z-10 text-center font-serif text-[12px] text-white/95 drop-shadow-[0_1px_4px_rgba(0,0,0,0.7)]">{{ $reel['caption'] }}</span>
                    @endif
                    @if ($reel['overlay'])
                        <span class="pointer-events-none absolute inset-x-4 z-10 text-center text-[13px] font-semibold leading-snug text-white drop-shadow-[0_2px_5px_rgba(0,0,0,0.8)] md:text-[14px] {{ $reel['overlay']['position'] === 'top' ? 'top-[18%]' : ($reel['overlay']['position'] === 'center' ? 'top-[56%] -translate-y-1/2' : 'bottom-[20%]') }}">{{ $reel['overlay']['text'] }}</span>
                    @endif
                    @if ($reel['tip'])
                        <div class="pointer-events-none absolute bottom-[17%] left-[11%] right-[9%] z-10 -rotate-2 rounded-[3px] bg-[#FDFBF8] px-3 py-3 text-center shadow-[0_10px_28px_rgba(0,0,0,0.22)]">
                            <span class="absolute -top-3.5 right-4 grid h-8 w-8 place-items-center rounded-full border-[3px] border-[#FDFBF8] bg-[#6E4638] text-[12px] font-medium text-white shadow-sm">{{ $reel['tip']['number'] }}</span>
                            <p class="text-[11px] font-semibold leading-tight text-[#8B3B2E] md:text-[12px]">{{ $reel['tip']['title'] }}</p>
                            <p class="mt-1 text-[8.5px] leading-[1.5] text-[#4C3B33] md:text-[9px]">{{ $reel['tip']['body'] }}</p>
                        </div>
                    @endif
                    <button type="button" data-modal-open="video-modal-{{ $i }}" aria-label="Play {{ $reel['title'] }} with sound" class="absolute inset-0 z-20 grid cursor-pointer place-items-center">
                        <span class="grid h-11 w-11 place-items-center rounded-full bg-white/20 text-white opacity-0 backdrop-blur-sm transition-opacity duration-300 group-hover:opacity-100"><svg width="19" height="19" viewBox="0 0 24 24" fill="currentColor"><path d="M8 5v14l11-7z"/></svg></span>
                    </button>
                </article>
            @endforeach
        </div>
        <button type="button" data-drag-next aria-label="Next videos" class="absolute right-[-2%] top-1/2 z-20 grid h-10 w-10 -translate-y-1/2 place-items-center rounded-full bg-white text-charcoal shadow-[0_4px_18px_rgba(0,0,0,0.16)] transition-all hover:scale-105 md:right-[-3.2%] md:h-11 md:w-11"><svg width="19" height="19" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="m9 18 6-6 6-6"/></svg></button>
    </div>
    @foreach ($reels as $i => $reel)
        <div data-modal id="video-modal-{{ $i }}" hidden>
            <div class="modal-backdrop" data-modal-close></div>
            <div class="modal-panel relative mx-auto aspect-[9/16] h-[86vh] max-h-[900px] max-w-[92vw] overflow-hidden rounded-xl bg-black shadow-lift">
                <video data-lightbox-video controls autoplay playsinline preload="auto" class="h-full w-full object-contain" src="{{ $reel['src'] }}"></video>
                <button type="button" data-modal-close aria-label="Close video" class="absolute right-4 top-4 z-10 grid h-10 w-10 place-items-center rounded-full bg-white/15 text-white backdrop-blur transition-colors hover:bg-white/30"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 6 6 18M6 6l12 12"/></svg></button>
            </div>
        </div>
    @endforeach
</section>

{{-- ============ ACT IV — THE INVITATION ============ --}}

{{-- 13. CONSULTATION BANNER --}}
<section class="relative grid min-h-[480px] w-full place-items-center overflow-hidden bg-charcoal md:min-h-[560px]">
    <div data-parallax="8" class="absolute -inset-[6%] h-[112%] w-[112%] overflow-hidden will-change-transform">
        <img src="https://images.unsplash.com/photo-1600210492486-724fe5c67fb0?q=80&w=2000&auto=format&fit=crop" alt="Luxury interior by Ananya Interior" loading="lazy" class="h-full w-full object-cover object-center">
    </div>
    <div class="absolute inset-0 bg-charcoal/75"></div>
    <div class="pointer-events-none absolute inset-0" style="background: radial-gradient(circle at center, transparent 40%, rgba(0,0,0,.4) 100%);"></div>
    <div class="relative z-10 mx-auto w-full max-w-3xl px-5 py-20 text-center" data-reveal="up">
        <p class="text-[11px] uppercase tracking-[0.3em] text-gold">Free First Consultation</p>
        <h2 class="mt-4 font-serif text-3xl leading-tight text-cream md:text-5xl">Let's Create Your <em class="italic text-gold">Dream Space.</em></h2>
        <p class="mx-auto mt-5 max-w-xl text-[15px] leading-relaxed text-cream/75">Share your floor plan or photos on WhatsApp — we will suggest a trade direction within 24 hours.</p>
        <a href="/contact" class="group mt-8 inline-flex items-center gap-3 rounded-full bg-gold px-9 py-4 text-sm font-medium tracking-wide text-charcoal shadow-lift transition-colors hover:bg-cream">Book a Consultation <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="transition-transform duration-300 group-hover:translate-x-1"><path d="M5 12h14m-6-6 6 6-6 6"/></svg></a>
    </div>
</section>

@push('scripts')
<script>
    /* Unmute the lightbox reel from inside the opening click gesture so playback starts with sound. */
    document.addEventListener('click', function (event) {
        var trigger = event.target.closest('[data-modal-open^="video-modal-"]');
        if (!trigger) return;
        var modal = document.getElementById(trigger.getAttribute('data-modal-open'));
        if (!modal) return;
        var video = modal.querySelector('video[data-lightbox-video]');
        if (!video) return;
        video.muted = false;
        video.volume = 1;
        video.currentTime = 0;
        var playback = video.play();
        if (playback && typeof playback.catch === 'function') playback.catch(function () {});
    }, true);
</script>
@endpush
@endsection
