@extends('layouts.app')
@section('title', 'Our Services | Ananya Interior')
@section('content')
<section class="relative overflow-hidden bg-[#1C1109] text-[#F7EEDF]">
    <div class="absolute inset-0 bg-gradient-to-r from-[#1C1109] via-[#1C1109]/85 to-[#1C1109]/10"></div>
    <div class="relative mx-auto max-w-7xl px-5 py-16 md:px-8 md:py-20">
        <p class="text-[10px] font-medium uppercase tracking-[0.28em] text-[#D9B45B]">Premium Wood Materials</p>
        <h1 class="mt-3 font-serif text-4xl leading-[1.08] sm:text-5xl md:text-6xl">What We <span class="text-[#D9B45B]">Trade</span></h1>
        <p class="mt-5 max-w-2xl text-sm leading-relaxed text-[#D9CBB4]">Explore interior trade services and trusted materials for every space.</p>
    </div>
</section>

<section class="mx-auto max-w-7xl px-5 py-16 md:px-8">
    <div class="grid gap-5 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
        @foreach ($services as $i => $service)
            <a href="/services/{{ $service->slug }}" class="group overflow-hidden rounded-2xl border border-charcoal/5 bg-white shadow-card transition-all hover:-translate-y-1 hover:shadow-lift" data-reveal="up" data-delay="{{ ($i % 4) * 80 }}">
                <div class="aspect-[4/3] overflow-hidden bg-beige"><img src="{{ $service->image }}" alt="{{ $service->name }}" loading="lazy" class="h-full w-full object-cover transition-transform duration-700 group-hover:scale-110"></div>
                <div class="p-5"><h3 class="font-serif text-lg text-charcoal group-hover:text-golddark">{{ $service->name }}</h3><p class="mt-2 text-xs leading-relaxed text-coffee">{{ $service->short_description }}</p><span class="mt-4 inline-flex items-center gap-1.5 text-[11px] font-semibold uppercase tracking-[0.12em] text-golddark">Explore <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14m-6-6 6 6-6 6"/></svg></span></div>
            </a>
        @endforeach
    </div>
</section>

<section class="mx-auto max-w-7xl px-5 pb-20 md:px-8">
    <div class="grid gap-6 rounded-3xl bg-charcoal p-8 text-cream md:grid-cols-2 md:p-12">
        <div><p class="text-[11px] tracking-[0.3em] uppercase text-gold">Ananya</p><h2 class="mt-3 font-serif text-3xl">Need help choosing?</h2><p class="mt-3 text-sm leading-relaxed text-cream/70">Tell us about your project — we usually respond within a few hours.</p></div>
        <div class="text-sm text-cream/75"><p class="font-serif text-xl">{{ \App\Models\Setting::get('phone', '+91 7351400063 / +91 9837027055') }}</p><p class="mt-3">{{ \App\Models\Setting::get('address') }}</p><a href="/contact" class="mt-6 inline-flex rounded-full bg-gold px-6 py-3 text-xs font-medium text-charcoal">Send Enquiry</a></div>
    </div>
</section>
@endsection
