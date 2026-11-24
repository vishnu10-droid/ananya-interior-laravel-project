@extends('layouts.app')
@section('title', 'Brand Partners | Ananya Interior')
@section('content')
@php
    $image = \App\Models\Setting::get('image_luxury', '/images/company-profile/page-04-image-01.png');

    /* Featured logos + complete brand list come from the database. */
    $featuredBrands = \App\Support\CatalogueData::featuredBrands();
    $allBrandNames = \App\Support\CatalogueData::allBrands();

    $initialsFor = function ($name) {
        $words = preg_split('/\s+/', trim((string) $name));
        $letters = array_map(fn ($word) => mb_substr($word, 0, 1), $words);

        return mb_substr(implode('', $letters), 0, 2);
    };
@endphp

<div>
    {{-- 1. DARK PAGE HERO --}}
    <section class="relative flex min-h-[390px] items-end overflow-hidden bg-charcoal py-16 md:min-h-[470px] md:py-20" style="perspective:1200px">
        <div data-parallax="8" data-parallax-scale class="absolute -inset-[6%] h-[112%] w-[112%] overflow-hidden will-change-transform">
            <img src="{{ $image }}" alt="Trusted Brand Partnerships" class="h-full w-full object-cover object-center opacity-55">
        </div>
        <div class="absolute inset-0 bg-gradient-to-r from-charcoal/90 via-charcoal/65 to-charcoal/20"></div>
        <div class="absolute inset-0 bg-gradient-to-t from-charcoal/85 via-transparent to-charcoal/10"></div>
        <div class="relative mx-auto w-full max-w-7xl px-5 md:px-8">
            <p class="motion-in-up inline-flex items-center gap-2 rounded-full border border-gold/30 bg-charcoal/30 px-4 py-2 text-[10px] tracking-[0.3em] uppercase text-gold backdrop-blur-md" style="--d:.05s">
                <span class="h-1.5 w-1.5 rounded-full bg-gold shadow-[0_0_12px_rgba(198,168,124,0.9)]"></span>Brand Partners
            </p>
            <h1 class="motion-in-left mt-5 max-w-3xl font-serif text-4xl leading-[1.08] text-cream sm:text-5xl md:text-6xl" style="--d:.12s">Trusted Brand Partnerships</h1>
            <p class="motion-in-up mt-5 max-w-2xl text-sm leading-relaxed text-cream/75 md:text-base" style="--d:.2s">We partner with India's leading interior and exterior material brands to bring you quality, durability, and trade excellence under one roof.</p>
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
                            <img src="{{ $brand['image'] }}" alt="{{ $brand['name'] }} logo" loading="lazy" onerror="this.style.display='none';this.nextElementSibling.classList.remove('hidden')" class="max-h-12 w-full object-contain transition-all duration-500 sm:max-h-14">
                            <span class="hidden text-center font-serif text-lg text-charcoal">{{ $brand['name'] }}</span>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    {{-- 3. BRANDS WE WORK WITH --}}
    <section class="mx-auto max-w-7xl px-5 py-20 md:px-8 md:py-28">
        <div class="text-center mx-auto max-w-2xl" data-reveal="up">
            <p class="text-[11px] tracking-[0.3em] uppercase text-golddark font-medium">Our Brand Partners</p>
            <h2 class="mt-3 font-serif text-3xl leading-tight text-charcoal md:text-3xl">Brands We Work With</h2>
            <div class="mt-4 h-px w-16 bg-gold mx-auto"></div>
            <p class="mt-4 text-[15px] leading-relaxed text-coffee">Genuine brand partnerships from the company profile.</p>
        </div>
        <div class="mt-14 grid grid-cols-2 items-stretch gap-5 sm:grid-cols-3 md:grid-cols-4">
            @foreach ($featuredBrands as $i => $brand)
                <div data-tilt data-lift data-reveal="up" data-delay="{{ min($i * 35, 250) }}" class="group relative flex min-h-40 flex-col items-center justify-center overflow-hidden rounded-2xl border border-gold/25 bg-gradient-to-br from-white via-cream to-gold/10 p-5 text-center shadow-card transition-shadow duration-300 hover:shadow-lift">
                    <div class="pointer-events-none absolute -right-7 -top-8 h-24 w-24 rounded-full bg-gold/10 blur-2xl transition-transform duration-500 group-hover:scale-150"></div>
                    <div class="relative mb-3 grid h-14 w-14 place-items-center rounded-2xl border border-gold/25 bg-gradient-to-br from-charcoal to-espresso font-serif text-lg font-semibold tracking-wide text-gold shadow-inner transition-transform duration-300 group-hover:rotate-[-6deg] group-hover:scale-110">{{ $initialsFor($brand['name']) }}</div>
                    <p class="relative text-sm font-medium text-charcoal">{{ $brand['name'] }}</p>
                    <span class="mt-2 inline-flex items-center gap-1 text-[10px] uppercase tracking-[0.16em] text-golddark">
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3.85 8.62a4 4 0 0 1 4.78-4.77 4 4 0 0 1 6.74 0 4 4 0 0 1 4.78 4.78 4 4 0 0 1 0 6.74 4 4 0 0 1-4.77 4.78 4 4 0 0 1-6.75 0 4 4 0 0 1-4.78-4.77 4 4 0 0 1 0-6.76Z"/><path d="m9 12 2 2 4-4"/></svg>
                        Featured partner
                    </span>
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="#A98548" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" class="absolute right-3 top-3 text-golddark opacity-0 transition-all duration-300 group-hover:translate-x-0.5 group-hover:-translate-y-0.5 group-hover:opacity-100"><path d="M7 17 17 7M8 7h9v9"/></svg>
                </div>
            @endforeach
        </div>
    </section>

    {{-- 4. ALL ASSOCIATED BRANDS --}}
    <section class="bg-beige/40 py-20 md:py-28">
        <div class="mx-auto max-w-7xl px-5 md:px-8">
            <div class="text-center mx-auto max-w-2xl" data-reveal="up">
                <p class="text-[11px] tracking-[0.3em] uppercase text-golddark font-medium">Complete Brand List</p>
                <h2 class="mt-3 font-serif text-3xl leading-tight text-charcoal md:text-3xl">All Associated Brands</h2>
                <div class="mt-4 h-px w-16 bg-gold mx-auto"></div>
            </div>
            <div class="mt-12 grid grid-cols-2 gap-4 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5">
                @foreach ($allBrandNames as $i => $brandName)
                    <div data-tilt data-lift data-reveal="up" data-delay="{{ min($i * 35, 250) }}" class="group relative flex min-h-40 flex-col items-center justify-center overflow-hidden rounded-2xl border border-charcoal/5 bg-white p-5 text-center shadow-sm transition-shadow duration-300 hover:shadow-lift">
                        <div class="pointer-events-none absolute -right-7 -top-8 h-24 w-24 rounded-full bg-gold/10 blur-2xl transition-transform duration-500 group-hover:scale-150"></div>
                        <div class="relative mb-3 grid h-14 w-14 place-items-center rounded-2xl border border-gold/25 bg-gradient-to-br from-charcoal to-espresso font-serif text-lg font-semibold tracking-wide text-gold shadow-inner transition-transform duration-300 group-hover:rotate-[-6deg] group-hover:scale-110">{{ $initialsFor($brandName) }}</div>
                        <p class="relative text-sm font-medium text-charcoal">{{ $brandName }}</p>
                        <span class="mt-2 inline-flex items-center gap-1 text-[10px] uppercase tracking-[0.16em] text-golddark">Brand partner</span>
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="#A98548" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" class="absolute right-3 top-3 text-golddark opacity-0 transition-all duration-300 group-hover:translate-x-0.5 group-hover:-translate-y-0.5 group-hover:opacity-100"><path d="M7 17 17 7M8 7h9v9"/></svg>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
</div>
@endsection
