@extends('layouts.app')
@section('title', $service->name.' | Ananya Interior')
@section('description', $service->short_description)
@section('content')
@php
    $others = \App\Models\Service::active()
        ->where('id', '!=', $service->id)
        ->orderBy('sort_order')
        ->limit(6)
        ->get();

    $features = [
        'Free site measurement',
        '2D layout + 3D views',
        'Material & colour palette',
        'Branded hardware',
        'Skilled execution team',
        'Post-handover support',
    ];
    if (!empty($service->features) && is_array($service->features)) {
        $features = array_values($service->features);
    }

    $phoneLink = \App\Models\Setting::get('phone_link', 'tel:+917351400063');

    $glyphs = [
        'home'      => '<path d="m3 10 9-7 9 7v10a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V10Z"/><path d="M9 22v-8h6v8"/>',
        'sofa'      => '<path d="M4 12V6a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v6"/><path d="M2 12h20v6H2z"/><path d="M5 18v2M19 18v2"/>',
        'bed'       => '<path d="M3 18v-6a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2v6M5 10V7a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v3M5 18v2M19 18v2"/>',
        'pot'       => '<path d="M4 8h16v10a4 4 0 0 1-4 4H8a4 4 0 0 1-4-4V8Z"/><path d="M2 8h20M9 4h6"/>',
        'door'      => '<path d="M18 20V4a2 2 0 0 0-2-2H8a2 2 0 0 0-2 2v16"/><path d="M2 20h20"/><path d="M14 12h.01"/>',
        'briefcase' => '<path d="M4 8h16v12H4z"/><path d="M8 8V5a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v3"/><path d="M4 13h16"/>',
        'lamp'      => '<path d="M12 2v4"/><path d="M8 6h8l3 7H5l3-7Z"/><path d="M12 13v2"/><path d="M9 19a3 3 0 0 0 6 0"/>',
        'hammer'    => '<path d="m15 12-8.4 8.4a1.5 1.5 0 0 1-2.1-2.1L12.9 10"/><path d="M14 9.5 18 5.5"/><path d="m17 3.5 4 4-3 3-4-4z"/>',
    ];
    $iconFor = [
        'home-interiors' => 'home',      'living-room' => 'sofa',
        'bedroom' => 'bed',              'modular-kitchen' => 'pot',
        'wardrobe' => 'door',            'office-interiors' => 'briefcase',
        'false-ceiling' => 'lamp',       'renovation' => 'hammer',
        'plywood' => 'home',             'decorative-laminate' => 'sofa',
        'hpl' => 'pot',                  'veneers' => 'door',
        'flooring' => 'bed',             'thermo-wood' => 'lamp',
        'td-walls' => 'briefcase',       'decmore' => 'hammer',
        'vox' => 'briefcase',            'wpc-cladding' => 'home',
        'wpc-doors' => 'door',           'fcb' => 'briefcase',
    ];
    $icon = $glyphs[$iconFor[$service->slug] ?? 'home'];
@endphp

<div class="overflow-x-clip">
    {{-- 1. HERO — full-height image with back link --}}
    <section class="relative h-[60vh] min-h-[440px] overflow-hidden bg-charcoal">
        <img src="{{ $service->image }}" alt="{{ $service->name }}" class="absolute inset-0 h-full w-full object-cover">
        <div class="absolute inset-0 bg-gradient-to-t from-charcoal via-charcoal/40 to-charcoal/20"></div>
        <div class="relative mx-auto flex h-full max-w-7xl flex-col justify-end px-5 pb-12 pt-40 text-cream md:px-8">
            <a href="{{ route('services') }}" class="motion-in-up inline-flex w-fit items-center gap-2 text-sm text-cream/70 transition-colors hover:text-cream">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 12H5m6 6-6-6 6-6"/></svg>
                All services
            </a>
            <span class="motion-in-zoom mt-5 grid h-14 w-14 place-items-center rounded-2xl bg-gold text-charcoal shadow-[0_14px_34px_-16px_rgba(198,168,124,0.9)]" style="--d:.08s">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">{!! $icon !!}</svg>
            </span>
            <h1 class="motion-in-up mt-4 font-serif text-4xl leading-tight text-white md:text-6xl" style="--d:.12s">
                <span data-text-reveal style="--d:.16s"><span>{{ $service->name }}</span></span>
            </h1>
            <p class="motion-in-up mt-3 max-w-xl text-sm leading-relaxed text-white/75 md:text-base" style="--d:.24s">{{ $service->short_description }}</p>
        </div>
    </section>

    {{-- 2. BODY GRID — included / approach / other services --}}
    <section class="mx-auto grid max-w-7xl gap-6 px-5 py-16 md:grid-cols-3 md:px-8">
        <div class="rounded-3xl border border-charcoal/5 bg-white p-8 shadow-card md:col-span-2" data-reveal="up">
            <h2 class="font-serif text-2xl text-charcoal">What is included</h2>
            <ul class="mt-5 grid gap-3 sm:grid-cols-2">
                @foreach ($features as $feature)
                    <li class="flex items-center gap-2.5 text-sm text-charcoal/85" data-reveal="up" data-delay="{{ $loop->index * 50 }}">
                        <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="shrink-0 text-golddark"><circle cx="12" cy="12" r="10"/><path d="m9 12 2 2 4-4"/></svg>
                        {{ $feature }}
                    </li>
                @endforeach
            </ul>

            <h2 class="mt-8 font-serif text-2xl text-charcoal" data-reveal="up">Our approach</h2>
            <p class="mt-3 text-[15px] leading-relaxed text-coffee" data-reveal="up" data-delay="60">
                Every {{ strtolower($service->name) }} project begins with understanding how you live or work. We then plan storage, light and movement before selecting finishes — so the space looks premium and works effortlessly every day.
            </p>
            <div data-reveal="up" data-delay="120">
                <a href="{{ route('contact') }}" data-lift data-shine class="group mt-7 inline-flex items-center gap-2 rounded-full bg-charcoal px-7 py-3.5 text-sm text-cream transition-colors hover:bg-espresso">
                    Book a Consultation
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="transition-transform group-hover:translate-x-1"><path d="M5 12h14m-6-6 6 6-6 6"/></svg>
                </a>
            </div>
        </div>

        <aside class="h-fit rounded-3xl bg-charcoal p-8 text-cream" data-reveal="right" data-delay="100">
            <p class="text-[11px] uppercase tracking-[0.3em] text-gold">Other services</p>
            <ul class="mt-4 space-y-1">
                @foreach ($others as $other)
                    <li data-reveal="up" data-delay="{{ $loop->index * 60 }}">
                        <a href="{{ route('service.detail', $other->slug) }}" class="flex items-center justify-between border-b border-white/10 py-2.5 text-sm text-cream/80 transition-colors hover:text-gold">
                            {{ $other->name }}
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="shrink-0"><path d="M5 12h14m-6-6 6 6-6 6"/></svg>
                        </a>
                    </li>
                @endforeach
            </ul>
        </aside>
    </section>

    {{-- 3. BOTTOM CTA STRIP --}}
    <section class="bg-walnut px-5 py-14 md:px-8">
        <div class="mx-auto flex max-w-7xl flex-col items-center justify-between gap-6 rounded-3xl border border-champagne/20 bg-brown/40 p-8 text-center md:flex-row md:text-left" data-reveal="up">
            <div>
                <p class="eyebrow-label">Let's begin</p>
                <h2 class="mt-2 font-serif text-3xl text-[#F3E3C8]">Ready to trade your space?</h2>
                <p class="mt-2 text-sm leading-relaxed text-cream/70">Call us or send an enquiry — our Agra studio is here to help.</p>
            </div>
            <div class="flex flex-wrap items-center justify-center gap-3">
                <a href="{{ $phoneLink }}" data-lift class="group inline-flex items-center gap-2 rounded-full border border-champagne/40 px-6 py-3 text-xs font-medium tracking-wide text-[#F3E3C8] transition-colors hover:border-champagne hover:bg-champagne/10">Call Now <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="transition-transform group-hover:translate-x-1"><path d="M5 12h14m-6-6 6 6-6 6"/></svg></a>
                <a href="{{ route('contact') }}" data-lift data-shine class="group inline-flex items-center gap-2 rounded-full bg-champagne px-6 py-3 text-xs font-medium tracking-wide text-walnut shadow-[0_10px_30px_-12px_rgba(196,154,90,0.8)] transition-colors hover:bg-[#d3ac6f]">Send Enquiry <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="transition-transform group-hover:translate-x-1"><path d="M5 12h14m-6-6 6 6-6 6"/></svg></a>
            </div>
        </div>
    </section>
</div>
@endsection
