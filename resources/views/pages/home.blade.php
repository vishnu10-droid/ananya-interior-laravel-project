@extends('layouts.app')
@section('title', 'Ananya Interior | Agra')
@section('description', 'Premium interior and exterior solutions crafted with experience, design and precision.')

@section('content')
@php
    $hero = \App\Models\Setting::get('image_hero', '/images/company-profile/page-01-image-01.png');
@endphp

{{-- HERO --}}
<section class="relative min-h-screen flex items-end overflow-hidden bg-charcoal">
    <img src="{{ $hero }}" alt="Luxury home interior by Ananya Interior Agra" class="absolute inset-0 h-full w-full object-cover object-center filter brightness-90 hero-zoom">
    <div class="absolute inset-0 bg-gradient-to-t from-charcoal via-charcoal/60 to-charcoal/20 z-[1]"></div>
    <div class="absolute inset-0 bg-gradient-to-r from-charcoal/80 via-charcoal/40 to-transparent z-[1]"></div>
    <div class="hidden lg:grid absolute right-12 top-28 z-10 h-36 w-36 place-items-center rounded-full border border-gold/40 bg-charcoal/30 text-center shadow-xl backdrop-blur-md">
        <span class="absolute inset-2 rounded-full border border-dashed border-gold/25"></span>
        <span><span class="block text-[9px] tracking-[0.35em] uppercase text-gold/80">Est.</span><span class="block font-serif text-3xl text-cream leading-tight">1995</span><span class="block text-[9px] tracking-[0.28em] uppercase text-cream/60">Ananya · Agra</span></span>
    </div>
    <div class="relative z-10 mx-auto max-w-7xl w-full px-6 md:px-12 pb-24 md:pb-32 pt-36">
        <span class="inline-flex items-center gap-2.5 text-[11px] font-medium tracking-[0.35em] uppercase text-gold border border-gold/30 bg-charcoal/40 backdrop-blur-md px-4 py-2 rounded-full shadow-lg shadow-black/20">✦ Ananya - endless Decore Ideas</span>
        <h1 class="font-serif text-white text-2xl sm:text-3xl md:text-4xl lg:text-5xl leading-[1.15] max-w-3xl mt-5 tracking-tight drop-shadow-md">A Unit of Bansal Wood <br><em class="text-transparent bg-clip-text bg-gradient-to-r from-amber-200 via-gold to-amber-400 font-serif italic">Decore Pvt.Ltd</em></h1>
        <p class="text-white/80 max-w-xl mt-4 text-sm md:text-base leading-relaxed font-light drop-shadow-sm">Premium interior trade solutions crafted around your lifestyle, personality, and architectural vision.</p>
        <div class="flex flex-wrap items-center gap-3 mt-8">
            <a href="/products" class="group inline-flex items-center gap-2.5 bg-gradient-to-r from-gold via-amber-400 to-gold text-charcoal px-6 py-3 rounded-full text-xs font-semibold tracking-wider uppercase shadow-xl hover:shadow-gold/25 transition-all duration-300">Explore Products <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="transition-transform duration-300 group-hover:translate-x-1"><path d="M5 12h14m-6-6 6 6-6 6"/></svg></a>
            <a href="/contact" class="inline-flex items-center gap-2 border border-white/30 hover:border-white/70 text-white bg-white/5 hover:bg-white hover:text-charcoal px-6 py-3 rounded-full text-xs font-medium tracking-wide backdrop-blur-md transition-all duration-300 shadow-lg">Book a Consultation</a>
        </div>
    </div>
    <a href="#categories" class="absolute bottom-6 left-1/2 -translate-x-1/2 z-20 flex flex-col items-center gap-2 group">
        <span class="text-[10px] tracking-[0.3em] uppercase text-white/60 group-hover:text-gold transition-colors font-light">Scroll Down</span>
        <span class="w-8 h-8 rounded-full border border-white/20 bg-white/5 backdrop-blur-md flex items-center justify-center group-hover:border-gold/50 transition-colors"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="m6 9 6 6 6-6"/></svg></span>
    </a>
</section>

{{-- BRAND MARQUEE --}}
<section id="brands" class="bg-beige/40 py-12 md:py-16">
    <div class="max-w-7xl mx-auto px-5 md:px-8">
        <p class="text-[11px] font-medium uppercase tracking-[0.3em] text-gold">In the showroom</p>
        <h2 class="mt-3 font-serif text-3xl md:text-4xl leading-tight text-charcoal">Our brands, in the <em class="font-serif italic text-golddark">headlines</em></h2>
        <div class="gold-line mt-4"></div>
        <div class="marquee-fade relative mt-10 overflow-hidden">
            <div class="animate-marquee">
                @foreach ([...$brands, ...$brands] as $i => $brand)
                    <a href="/brands" class="group mr-3 grid h-24 w-40 shrink-0 place-items-center rounded-xl border border-charcoal/5 bg-white px-5 py-4 shadow-card transition-shadow duration-300 hover:shadow-lift sm:mr-4 sm:w-44" @if ($i >= $brands->count()) aria-hidden="true" tabindex="-1" @endif>
                        <img src="{{ $brand->logo }}" alt="{{ $brand->name }} logo" loading="lazy" class="max-h-12 w-full object-contain transition-all duration-500 sm:max-h-14">
                    </a>
                @endforeach
            </div>
        </div>
    </div>
</section>

{{-- CATEGORIES --}}
<section id="categories" class="relative overflow-hidden bg-beige/60 py-14">
    <div class="mx-auto w-full max-w-7xl px-5">
        <p class="text-[11px] font-medium uppercase tracking-[0.3em] text-gold">All Categories</p>
        <h2 class="mt-3 font-serif text-3xl md:text-4xl text-charcoal leading-tight">Browse Every Category</h2>
        <p class="mt-3 max-w-2xl text-sm leading-relaxed text-coffee">From the first sketch to the final detail — interiors shaped around the way you live and work. Open a category to see all its products.</p>
        <div class="mt-8 grid grid-cols-2 gap-3 md:grid-cols-4 lg:grid-cols-5">
            @foreach ($categories as $i => $category)
                <a href="/categories/{{ $category->slug }}" class="group flex h-full flex-col overflow-hidden rounded-xl border border-gold/40 bg-white shadow-card transition-shadow hover:shadow-lift" data-reveal="up" data-delay="{{ $i * 60 }}">
                    <div class="aspect-[4/3] overflow-hidden bg-beige"><img src="{{ $category->image }}" alt="{{ $category->name }}" loading="lazy" class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-105"></div>
                    <div class="flex flex-1 flex-col gap-1.5 p-3"><h3 class="line-clamp-1 font-serif text-[13px] font-semibold leading-tight text-charcoal group-hover:text-golddark">{{ $category->name }}</h3><p class="line-clamp-1 text-[10px] text-coffee">{{ $category->brands ? implode(' · ', array_slice($category->brands, 0, 3)) : 'Premium materials' }}</p><div class="mt-auto flex justify-between border-t border-gold/20 pt-2 text-[9px] font-semibold uppercase tracking-[0.14em] text-golddark">Explore <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14m-6-6 6 6-6 6"/></svg></div></div>
                </a>
            @endforeach
        </div>
    </div>
</section>

{{-- HIGHLIGHTS --}}
<section class="bg-beige/60 pb-16">
    <div class="mx-auto grid max-w-7xl grid-cols-2 gap-5 px-5 md:grid-cols-4 md:px-8">
        @foreach ([['24+','Projects Delivered'],['8','Trade Services'],['1995','Established'],['100%','Client Satisfaction']] as $stat)
            <div class="rounded-2xl border border-gold/25 bg-white p-6 text-center shadow-card" data-reveal="up"><p class="font-serif text-3xl text-golddark">{{ $stat[0] }}</p><p class="mt-2 text-[11px] uppercase tracking-[0.16em] text-coffee">{{ $stat[1] }}</p></div>
        @endforeach
    </div>
</section>

{{-- FEATURED MATERIALS --}}
<section class="relative overflow-hidden bg-[#1C1109] py-20 text-[#F7EEDF] md:py-24">
    <div class="relative mx-auto max-w-7xl px-5 md:px-8">
        <p class="text-[11px] font-medium uppercase tracking-[0.3em] text-[#D9B45B]">The Edit · Most Requested</p>
        <h2 class="mt-4 font-serif text-4xl leading-[1.08] text-[#FBF3E7] md:text-5xl">Materials that <em class="italic text-[#D9B45B]">lead the way</em></h2>
        <p class="mt-4 max-w-md text-sm leading-relaxed text-[#D9CBB4]">The finishes our clients ask for again and again — chosen for the way they look, feel and hold up in everyday life.</p>
        <div class="mt-10 grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4 xl:grid-cols-5">
            @foreach ($products->take(5) as $i => $product)
                <a href="/products/{{ $product->slug }}" class="group flex h-full flex-col overflow-hidden rounded-2xl border border-[#B68B4D]/30 bg-[#F8F5EF] text-[#30251E] shadow-card transition-all hover:-translate-y-1 hover:shadow-lift" data-reveal="up" data-delay="{{ $i * 80 }}">
                    <div class="relative aspect-[4/3] overflow-hidden bg-[#EDE5D9]"><img src="{{ $product->image }}" alt="{{ $product->name }}" loading="lazy" class="h-full w-full object-cover transition-transform duration-700 group-hover:scale-110"><span class="absolute left-3 top-3 rounded-full bg-[#F8F5EF]/95 px-3 py-1 text-[10px] font-semibold uppercase tracking-[0.18em] text-[#8A6A16]">{{ $product->category->name ?? 'Materials' }}</span></div>
                    <div class="flex flex-1 flex-col p-4"><h3 class="font-serif text-[18px] leading-tight">{{ $product->name }}</h3><p class="mt-1.5 line-clamp-2 text-[11px] leading-relaxed text-[#6B5A45]">{{ $product->short_description }}</p></div>
                </a>
            @endforeach
        </div>
    </div>
</section>

{{-- GALLERY --}}
<section class="bg-[#F8F4EE] px-5 py-20 md:px-8">
    <div class="mx-auto max-w-7xl">
        <p class="text-[11px] font-medium uppercase tracking-[0.3em] text-gold">Trade Showcase</p>
        <h2 class="mt-3 font-serif text-3xl text-charcoal md:text-4xl">A Glimpse Inside Our Work</h2>
        <p class="mt-3 max-w-2xl text-sm text-coffee">Living rooms, bedrooms, kitchens, bathrooms and workspaces — each one considered down to the last detail.</p>
        <div class="mt-12 grid grid-cols-2 gap-3 md:grid-cols-4 auto-rows-[150px] sm:auto-rows-[190px] md:auto-rows-[210px]">
            @php $gallery = json_decode(file_get_contents(database_path('seeders/data/media.json')), true)['gallery'] ?? []; @endphp
            @foreach (array_slice($gallery, 0, 8) as $i => $image)
                <div class="group relative overflow-hidden rounded-2xl bg-charcoal shadow-card {{ $i === 0 ? 'col-span-2 row-span-2' : '' }}" data-reveal="zoom">
                    <img src="{{ $image }}" alt="Interior work" loading="lazy" class="h-full w-full object-cover transition-transform duration-700 group-hover:scale-110">
                    <div class="absolute inset-0 bg-gradient-to-t from-charcoal/85 via-charcoal/10 to-transparent opacity-80"></div>
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- PROJECTS --}}
<section id="projects" class="bg-beige/50 px-5 py-20 md:px-8">
    <div class="mx-auto max-w-7xl">
        <p class="text-[11px] font-medium uppercase tracking-[0.3em] text-gold">Selected Work</p>
        <h2 class="mt-3 font-serif text-3xl text-charcoal md:text-4xl">Spaces We&rsquo;ve Shaped</h2>
        <div class="mt-10 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
            @foreach ($projects as $i => $project)
                <article class="group relative overflow-hidden rounded-2xl shadow-card" data-reveal="up" data-delay="{{ $i * 80 }}">
                    <img src="{{ $project->image }}" alt="{{ $project->title }}" loading="lazy" class="h-72 w-full object-cover transition-transform duration-700 group-hover:scale-110">
                    <div class="absolute inset-0 bg-gradient-to-t from-charcoal via-charcoal/30 to-transparent"></div>
                    <div class="absolute inset-x-0 bottom-0 p-5"><span class="rounded-full bg-cream/90 px-3 py-1 text-[10px] tracking-[0.2em] uppercase text-espresso">{{ $project->category }}</span><h3 class="mt-3 font-serif text-xl text-cream">{{ $project->title }}</h3><p class="mt-1.5 text-xs text-cream/70">{{ $project->location }}</p></div>
                </article>
            @endforeach
        </div>
    </div>
</section>

{{-- TESTIMONIALS --}}
<section class="bg-ivory px-5 py-20 md:px-8">
    <div class="mx-auto max-w-7xl text-center">
        <p class="text-[11px] font-medium uppercase tracking-[0.3em] text-gold">Client Stories</p>
        <h2 class="mt-3 font-serif text-3xl text-charcoal md:text-4xl">Words That Warm Our Work</h2>
        <div class="mt-10 grid gap-6 md:grid-cols-3">
            @foreach ($testimonials->take(3) as $i => $testimonial)
                <div class="rounded-2xl border border-gold/20 bg-white p-7 text-left shadow-card" data-reveal="up" data-delay="{{ $i * 90 }}">
                    <p class="text-lg text-gold">★★★★★</p>
                    <p class="mt-4 text-sm leading-relaxed text-coffee">{{ $testimonial->review }}</p>
                    <p class="mt-5 font-serif text-lg text-charcoal">{{ $testimonial->name }}</p>
                    <p class="text-[11px] uppercase tracking-[0.16em] text-golddark">{{ $testimonial->designation }}</p>
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ABOUT STRIP --}}
<section class="relative overflow-hidden bg-beige/60 px-5 py-16 md:px-8">
    <div class="mx-auto grid max-w-7xl items-center gap-10 md:grid-cols-2">
        <div data-reveal="left"><p class="text-[11px] font-medium uppercase tracking-[0.3em] text-gold">Our Story</p><h2 class="mt-3 font-serif text-3xl text-charcoal md:text-4xl">Two decades of trust, one roof of possibilities</h2><p class="mt-4 text-sm leading-relaxed text-coffee">Ananya, a front-runner one-stop interior and exterior products mall, has its origin in the year 1995. Over the decades we have grown with a commitment to quality, design and customer trust.</p><a href="/about" class="mt-6 inline-flex items-center gap-2 rounded-full bg-charcoal px-7 py-3 text-xs uppercase tracking-[0.16em] text-cream">Get to Know Us <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14m-6-6 6 6-6 6"/></svg></a></div>
        <img src="{{ \App\Models\Setting::get('image_about', '/images/company-profile/page-02-image-01.png') }}" alt="Ananya studio" loading="lazy" class="h-[420px] w-full rounded-2xl object-cover shadow-lift" data-reveal="right">
    </div>
</section>

{{-- JOURNAL --}}
<section class="bg-ivory px-5 py-20 md:px-8">
    <div class="mx-auto max-w-7xl">
        <p class="text-[11px] font-medium uppercase tracking-[0.3em] text-gold">Our Journal</p>
        <h2 class="mt-3 font-serif text-3xl text-charcoal md:text-4xl">Ideas &amp; Inspiration</h2>
        <div class="mt-10 grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
            @foreach ($blogs->take(4) as $i => $blog)
                <article class="group overflow-hidden rounded-xl bg-white shadow-card transition-shadow hover:shadow-lift" data-reveal="up" data-delay="{{ $i * 70 }}">
                    <img src="{{ $blog->thumbnail }}" alt="{{ $blog->title }}" loading="lazy" class="aspect-[2/1] w-full object-cover transition-transform duration-700 group-hover:scale-105">
                    <div class="p-4"><p class="text-[10px] uppercase tracking-[0.1em] text-coffee">{{ $blog->category }} · {{ $blog->published_at?->format('d M Y') }}</p><h3 class="mt-2 font-serif text-[15px] leading-snug text-charcoal">{{ $blog->title }}</h3><a href="/blog" class="mt-3 inline-flex items-center gap-1.5 text-[11px] font-semibold text-golddark">Read More <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14m-6-6 6 6-6 6"/></svg></a></div>
                </article>
            @endforeach
        </div>
    </div>
</section>

{{-- TRENDING VIDEOS --}}
<section id="trending" class="w-full bg-[#F5F1EE] px-[4.4%] pb-8 pt-[55px]">
    <div class="mb-4 flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
        <div><p class="text-[11px] font-medium uppercase tracking-[3px] text-[#B08A6E]">Now Showing</p><h2 class="mt-3 font-serif text-[30px] text-charcoal md:text-[36px]"><span>Trending</span> <em class="italic text-[#A9795E]">trade and decor</em> <span>tips</span></h2></div>
        <a href="/blog" class="w-fit pb-[3px] text-[13px] text-charcoal underline decoration-charcoal/60 underline-offset-4">View all</a>
    </div>
    <div class="no-scrollbar flex snap-x gap-[18px] overflow-x-auto md:gap-[29px]">
        @php $videos = json_decode(file_get_contents(database_path('seeders/data/media.json')), true)['videos'] ?? []; @endphp
        @foreach ($videos as $video)
            <div class="w-[260px] shrink-0 snap-start overflow-hidden rounded-xl bg-charcoal shadow-card md:w-[300px]">
                <video src="{{ $video }}" muted loop playsinline preload="metadata" class="h-[420px] w-full object-cover"></video>
            </div>
        @endforeach
    </div>
</section>

{{-- CONSULTATION CTA --}}
<section class="relative overflow-hidden bg-charcoal py-20 md:py-28">
    <div class="absolute inset-0 bg-gradient-to-r from-charcoal via-espresso to-charcoal"></div>
    <div class="relative mx-auto max-w-7xl px-5 text-center md:px-8">
        <p class="mb-4 text-[11px] font-medium uppercase tracking-[0.3em] text-gold">Ready to transform your space?</p>
        <h2 class="mb-6 font-serif text-3xl leading-tight text-cream md:text-5xl">Looking for a Specific Material?</h2>
        <p class="mx-auto mb-10 max-w-2xl text-base leading-relaxed text-cream/60">Our team can help you select the right products for your project. Visit our Agra display centre or send an enquiry.</p>
        <div class="flex flex-col items-center justify-center gap-4 sm:flex-row">
            <a href="/contact" class="inline-flex items-center gap-2.5 rounded-full bg-gold px-10 py-4 text-sm font-medium tracking-wide text-charcoal shadow-lg shadow-gold/25">Contact Us <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14m-6-6 6 6-6 6"/></svg></a>
            <a href="tel:+917351400063" class="inline-flex items-center gap-2.5 rounded-full border border-white/30 px-8 py-4 text-sm text-white transition-all hover:border-white/70 hover:bg-white hover:text-charcoal">Call Now</a>
        </div>
    </div>
</section>
@endsection
