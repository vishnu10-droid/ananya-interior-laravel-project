@extends('layouts.app')
@section('title', 'Products | Ananya Interior')
@section('content')
<div class="pt-0">
    <section class="border-b border-charcoal/5 bg-white px-4 md:px-8">
        <div class="mx-auto max-w-[1600px] py-3 text-[10px] font-medium uppercase tracking-[0.3em] text-golddark">Product range</div>
        <div class="no-scrollbar mx-auto flex max-w-[1600px] gap-3 overflow-x-auto pb-3">
            @foreach ($categories as $category)
                <a href="/products?category={{ $category->slug }}" class="group relative w-[130px] shrink-0 snap-start rounded-xl border bg-white p-2 pb-3 text-center transition-all sm:w-[140px] {{ request('category') === $category->slug ? 'border-gold shadow-card ring-1 ring-gold/40' : 'border-charcoal/5 shadow-sm hover:border-gold/60' }}">
                    <div class="aspect-square overflow-hidden rounded-md bg-beige"><img src="{{ $category->image }}" alt="{{ $category->name }}" loading="lazy" class="h-full w-full object-cover"></div>
                    <span class="mt-2 block text-[13px] leading-tight text-charcoal group-hover:text-golddark">{{ $category->name }}</span>
                </a>
            @endforeach
        </div>
    </section>

    <section class="relative bg-charcoal">
        <img src="{{ \App\Models\Setting::get('image_luxury', '/images/company-profile/page-04-image-01.png') }}" alt="Premium interiors" class="absolute inset-0 h-full w-full object-cover opacity-35">
        <div class="absolute inset-0 bg-gradient-to-r from-charcoal via-charcoal/70 to-transparent"></div>
        <div class="relative mx-auto max-w-7xl px-5 py-24 text-cream md:px-8">
            <p class="text-[10px] uppercase tracking-[0.3em] text-gold">The Collection</p>
            <h1 class="mt-3 font-serif text-4xl md:text-6xl">Everyday favourites <em class="italic text-gold">for your space</em></h1>
        </div>
    </section>

    <section id="catalogue" class="scroll-mt-24 bg-white py-10 md:py-14">
        <div class="mx-auto max-w-[1600px] px-4 md:px-8">
            <p class="text-[10px] uppercase tracking-[0.28em] text-golddark">The catalogue</p>
            <div class="mt-2 flex flex-wrap items-end justify-between gap-3"><h2 class="font-serif text-2xl text-charcoal md:text-3xl">Explore <em class="italic text-golddark">materials</em></h2><p class="text-[11px] text-stonewarm">{{ $products->total() }} results</p></div>
            <form method="GET" action="/products" class="mt-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                <input type="search" name="q" value="{{ request('q') }}" placeholder="Search a material or brand" class="w-full max-w-sm rounded-full border border-charcoal/10 bg-cream py-2.5 pl-10 pr-4 text-[13px]">
                <select name="sort" class="rounded-full border border-charcoal/10 bg-white px-4 py-2 text-[12px]"><option value="featured">Featured</option><option value="name-asc">Name: A – Z</option><option value="name-desc">Name: Z – A</option></select>
            </form>
            <div class="mt-8 grid grid-cols-2 gap-3 sm:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5">
                @foreach ($products as $i => $product)
                    <a href="/products/{{ $product->slug }}" class="group overflow-hidden rounded-xl border border-charcoal/8 bg-white shadow-sm transition-all hover:-translate-y-1 hover:border-gold/40 hover:shadow-card" data-reveal="up" data-delay="{{ ($i % 6) * 60 }}">
                        <div class="aspect-square overflow-hidden bg-beige"><img src="{{ $product->image }}" alt="{{ $product->name }}" loading="lazy" class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-110"></div>
                        <div class="p-3"><p class="line-clamp-2 text-[13px] font-medium text-charcoal group-hover:text-golddark">{{ $product->name }}</p><p class="mt-1 text-[10px] text-stonewarm">{{ $product->category->name ?? '' }}</p></div>
                    </a>
                @endforeach
            </div>
            <div class="mt-8">{{ $products->links() }}</div>
        </div>
    </section>

    <section class="bg-beige/50 px-4 py-12 md:px-8">
        <div class="mx-auto max-w-[1600px]">
            <p class="text-[10px] uppercase tracking-[0.28em] text-golddark">Handpicked for you</p>
            <h2 class="mt-2 font-serif text-2xl text-charcoal md:text-3xl">Curated <em class="italic text-golddark">collections</em></h2>
            <div class="mt-6 grid grid-cols-2 gap-3 md:grid-cols-3 lg:grid-cols-5">
                @foreach ($categories->take(10) as $category)
                    <a href="/categories/{{ $category->slug }}" class="group overflow-hidden rounded-xl border border-charcoal/8 bg-cream text-left" data-reveal="up"><div class="aspect-[4/3] overflow-hidden bg-beige"><img src="{{ $category->image }}" alt="{{ $category->name }}" loading="lazy" class="h-full w-full object-cover group-hover:scale-105 transition-transform"></div><div class="p-3"><p class="text-[12px] font-semibold text-charcoal">{{ $category->name }}</p></div></a>
                @endforeach
            </div>
        </div>
    </section>

    <section class="mx-auto max-w-[1600px] px-4 py-6 md:px-8">
        <div class="rounded-xl bg-charcoal p-8 text-center text-cream md:p-12"><h2 class="font-serif text-3xl">Your personality, made into a space.</h2><p class="mx-auto mt-3 max-w-lg text-sm text-cream/70">From the first material sample to the final handover — every finish chosen with you.</p><a href="/contact" class="mt-6 inline-flex items-center gap-2 border border-gold px-6 py-3 text-[11px] font-semibold uppercase tracking-[0.14em] text-gold">Plan my space</a></div>
    </section>

    <section class="bg-ivory px-5 py-16 md:px-8">
        <div class="mx-auto max-w-7xl text-center">
            <h2 class="font-serif text-3xl text-charcoal">Client Stories</h2>
            <div class="mt-8 grid gap-6 md:grid-cols-3">
                @foreach ($testimonials->take(3) as $t)
                    <div class="rounded-2xl border border-gold/20 bg-white p-6 text-left shadow-card"><p class="text-gold">★★★★★</p><p class="mt-3 text-sm leading-relaxed text-coffee">{{ $t->review }}</p><p class="mt-4 font-serif text-charcoal">{{ $t->name }}</p></div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="relative overflow-hidden bg-charcoal py-20 text-center md:py-28">
        <h2 class="font-serif text-3xl text-cream md:text-5xl">Looking for a Specific Material?</h2>
        <p class="mx-auto mt-4 max-w-2xl text-sm text-cream/60">Our team can help you select the right products for your project. Visit our Agra display centre or send an enquiry.</p>
        <a href="/contact" class="mt-8 inline-flex items-center gap-2 rounded-full bg-gold px-10 py-4 text-sm font-medium text-charcoal">Contact Us</a>
    </section>
</div>
@endsection
