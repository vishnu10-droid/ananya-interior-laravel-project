@extends('layouts.app')
@section('title', 'What We Trade | Ananya Interior')
@section('description', 'Explore interior trade services and trusted materials for every space.')
@section('content')
@php
    $phone         = \App\Models\Setting::get('phone', '+91 7351400063 / +91 90847 27055');
    $phoneLink     = \App\Models\Setting::get('phone_link', 'tel:+917351400063');
    $whatsapp      = \App\Models\Setting::get('whatsapp', 'https://wa.me/917351400063?text=Hi%20Ananya%20Interior%2C%20I%20want%20a%20trade%20consultation.');
    $mapsUrl       = \App\Models\Setting::get('maps_url', 'https://www.google.com/maps/dir/?api=1&destination=Mangal+Sen+Bhawan%2C+21%2F18%2C+Freeganj+Rd%2C+Belanganj%2C+Civil+Lines%2C+Agra%2C+Uttar+Pradesh+282003');
    $address       = \App\Models\Setting::get('address', 'Mangal Sen Bhawan, 21/18, Freeganj Rd, Belanganj, Civil Lines, Agra, Uttar Pradesh 282003');
    $displayCentre = \App\Models\Setting::get('display_centre', 'G-8 Kailash Tower, Near ICICI Bank, Sanjay Place, Agra - 282002');
    $godown        = \App\Models\Setting::get('godown', 'Opp. Maya Devi Cold Storage, Village Ujrai, Hathras Road, Agra - 282006');
    $mobile        = \App\Models\Setting::get('mobile', '+91 9568011400');
    $hours         = \App\Models\Setting::get('hours', 'Open 24 Hours, all days');
    $heroImage     = \App\Models\Setting::get('image_luxury', $services[1]->image ?? '/images/company-profile/page-02-image-01.png');

    // Lucide-style glyphs mapped by service slug (mirrors src/data/services.js icons).
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
        'home-interiors'      => 'home',      'living-room'         => 'sofa',
        'bedroom'             => 'bed',       'modular-kitchen'     => 'pot',
        'wardrobe'            => 'door',      'office-interiors'    => 'briefcase',
        'false-ceiling'       => 'lamp',      'renovation'          => 'hammer',
        'plywood'             => 'home',      'decorative-laminate' => 'sofa',
        'hpl'                 => 'pot',       'veneers'             => 'door',
        'flooring'            => 'bed',       'thermo-wood'         => 'lamp',
        'td-walls'            => 'briefcase', 'decmore'             => 'hammer',
        'vox'                 => 'briefcase', 'wpc-cladding'        => 'home',
        'wpc-doors'           => 'door',      'fcb'                 => 'briefcase',
    ];
@endphp

<div class="overflow-x-clip">
    {{-- 1. PAGE HERO — dark, tilted + breathing image (PageHero parity) --}}
    <section class="relative flex min-h-[390px] items-end overflow-hidden bg-charcoal py-16 md:min-h-[470px] md:py-20" style="perspective:1200px">
        <div data-parallax="8" data-parallax-scale data-tilt class="absolute -inset-[6%] h-[112%] w-[112%]">
            <div data-float style="--d:.4s" class="h-full w-full">
                <img src="{{ $heroImage }}" alt="What We Trade" class="h-full w-full object-cover object-center opacity-55">
            </div>
        </div>
        <div class="absolute inset-0 bg-gradient-to-r from-charcoal/90 via-charcoal/65 to-charcoal/20"></div>
        <div class="absolute inset-0 bg-gradient-to-t from-charcoal/85 via-transparent to-charcoal/10"></div>

        <div class="relative mx-auto w-full max-w-7xl px-5 md:px-8">
            <div class="motion-in-left">
                <p class="inline-flex items-center gap-2 rounded-full border border-gold/30 bg-charcoal/30 px-4 py-2 text-[10px] uppercase tracking-[0.3em] text-gold backdrop-blur-md">
                    <span class="h-1.5 w-1.5 rounded-full bg-gold shadow-[0_0_12px_rgba(198,168,124,0.9)]"></span>
                    Our Services
                </p>
                <h1 class="mt-5 max-w-3xl font-serif text-4xl leading-[1.08] text-cream sm:text-5xl md:text-6xl">
                    <span data-text-reveal style="--d:.18s"><span>What We Trade</span></span>
                </h1>
                <p class="motion-in-up mt-5 max-w-2xl text-sm leading-relaxed text-cream/75 md:text-base" style="--d:.24s">
                    Explore interior trade services and trusted materials for every space.
                </p>
            </div>
        </div>
    </section>

    {{-- 2. SERVICES GRID — 3D tilt cards --}}
    <section class="mx-auto grid max-w-7xl gap-5 px-5 py-16 sm:grid-cols-2 md:px-8 lg:grid-cols-3 xl:grid-cols-4">
        @foreach ($services as $i => $service)
            @php $icon = $glyphs[$iconFor[$service->slug] ?? 'home']; @endphp
            <div data-reveal="{{ ['left', 'up', 'right', 'up'][$i % 4] }}" data-delay="{{ ($i % 4) * 80 }}" class="h-full">
                <div data-tilt class="h-full">
                    <a href="{{ route('service.detail', $service->slug) }}" data-shine data-lift class="group relative flex h-full flex-col overflow-hidden rounded-2xl border border-black/5 bg-white shadow-card transition-shadow duration-500 hover:shadow-2xl">
                        <div class="relative h-56 overflow-hidden bg-charcoal" style="transform: translateZ(30px)">
                            <img src="{{ $service->image }}" alt="{{ $service->name }}" loading="lazy" class="h-full w-full object-cover transition-transform duration-700 ease-out group-hover:scale-110">
                            <div class="absolute inset-0 bg-gradient-to-t from-charcoal/75 via-charcoal/20 to-transparent opacity-80 transition-opacity duration-500 group-hover:opacity-60"></div>
                            <span class="absolute left-4 top-4 grid h-11 w-11 place-items-center rounded-xl bg-cream/95 text-espresso shadow-lg backdrop-blur-md">
                                <svg width="19" height="19" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round">{!! $icon !!}</svg>
                            </span>
                        </div>
                        <div class="flex flex-grow flex-col justify-between bg-white p-6" style="transform: translateZ(20px)">
                            <div>
                                <h3 class="font-serif text-xl text-charcoal transition-colors duration-300 group-hover:text-golddark">{{ $service->name }}</h3>
                                <p class="mt-2.5 text-sm font-light leading-relaxed text-coffee line-clamp-2">{{ $service->short_description }}</p>
                            </div>
                            <div class="mt-6 flex items-center border-t border-black/5 pt-4">
                                <span class="inline-flex items-center gap-1.5 text-[13px] font-medium tracking-wide text-golddark">
                                    Explore Service
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="transition-transform duration-300 group-hover:translate-x-1 group-hover:-translate-y-1"><path d="M7 17 17 7M8 7h9v9"/></svg>
                                </span>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        @endforeach
    </section>

    {{-- 3. CONTACT SECTION — office locations + enquiry form (ContactSection parity) --}}
    <section id="contact" class="mx-auto max-w-7xl px-5 py-20 md:px-8 md:py-28">
        <div class="grid gap-10 lg:grid-cols-3" data-reveal="up">
            {{-- Left: phone / address / quick actions --}}
            <div class="lg:col-span-1">
                <div class="flex h-full flex-col gap-6 rounded-3xl bg-charcoal p-8 text-cream">
                    <div>
                        <p class="text-[11px] uppercase tracking-[0.3em] text-gold">Ananya</p>
                        <a href="{{ $phoneLink }}" class="mt-2 block font-serif text-xl text-cream transition-colors hover:text-gold">{{ $phone }}</a>
                        <p class="mt-4 flex items-start gap-2 text-sm leading-relaxed text-cream/70">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="mt-0.5 shrink-0 text-gold"><path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/><circle cx="12" cy="10" r="3"/></svg>
                            {{ $address }}
                        </p>
                        <p class="mt-3 flex items-center gap-2 text-sm text-cream/70">
                            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="text-gold"><circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/></svg>
                            {{ $hours }}
                        </p>
                    </div>
                    <div class="mt-auto grid grid-cols-3 gap-2.5">
                        <a href="{{ $phoneLink }}" data-lift class="flex flex-col items-center gap-1.5 rounded-xl bg-gold py-4 text-xs font-medium text-charcoal transition-colors hover:bg-cream">
                            <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6A19.79 19.79 0 0 1 2.12 4.18 2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.13.96.36 1.9.7 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.91.34 1.85.57 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                            Call Now
                        </a>
                        <a href="{{ $whatsapp }}" target="_blank" rel="noreferrer" data-lift class="flex flex-col items-center gap-1.5 rounded-xl border border-white/15 bg-white/10 py-4 text-xs text-cream transition-colors hover:bg-white/20">
                            <span class="text-xl">💬</span> WhatsApp
                        </a>
                        <a href="{{ $mapsUrl }}" target="_blank" rel="noreferrer" data-lift class="flex flex-col items-center gap-1.5 rounded-xl border border-white/15 bg-white/10 py-4 text-xs text-cream transition-colors hover:bg-white/20">
                            <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/><circle cx="12" cy="10" r="3"/></svg>
                            Directions
                        </a>
                    </div>
                </div>
            </div>

            <div class="space-y-6 lg:col-span-2">
                {{-- Office locations --}}
                <div class="h-full rounded-3xl bg-charcoal p-8 text-cream">
                    <h3 class="mb-6 font-serif text-2xl">Office Locations</h3>
                    <div class="space-y-5">
                        <div class="flex items-start gap-4">
                            <div class="grid h-10 w-10 shrink-0 place-items-center rounded-full bg-gold/10 text-gold"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/><circle cx="12" cy="10" r="3"/></svg></div>
                            <div>
                                <h4 class="mb-1 font-serif text-lg text-cream">Head Office</h4>
                                <p class="text-sm leading-relaxed text-cream/70">{{ $address }}</p>
                                <p class="mt-1 text-sm text-cream/70">{{ $phone }}</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-4">
                            <div class="grid h-10 w-10 shrink-0 place-items-center rounded-full bg-gold/10 text-gold"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/><circle cx="12" cy="10" r="3"/></svg></div>
                            <div>
                                <h4 class="mb-1 font-serif text-lg text-cream">Display Centre - Ananya</h4>
                                <p class="text-sm leading-relaxed text-cream/70">{{ $displayCentre }}</p>
                                <p class="mt-1 text-sm text-cream/70">+91 562 4031200, +91 7351400069 / 79</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-4">
                            <div class="grid h-10 w-10 shrink-0 place-items-center rounded-full bg-gold/10 text-gold"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/><circle cx="12" cy="10" r="3"/></svg></div>
                            <div>
                                <h4 class="mb-1 font-serif text-lg text-cream">Godown</h4>
                                <p class="text-sm leading-relaxed text-cream/70">{{ $godown }}</p>
                                <p class="mt-1 text-sm text-cream/70">Mobile: {{ $mobile }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Send enquiry --}}
                <div class="rounded-3xl border border-charcoal/5 bg-white p-8 shadow-card">
                    <h3 class="mb-6 font-serif text-2xl text-charcoal">Send Enquiry</h3>

                    @if ($errors->any())
                        <div class="mb-5 rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700">
                            <ul class="list-disc pl-5">@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
                        </div>
                    @endif

                    <form action="{{ route('contact.enquiry') }}" method="POST" class="space-y-4">
                        @csrf
                        <input type="hidden" name="role" value="Homeowner">
                        <div class="grid gap-4 sm:grid-cols-2">
                            <div>
                                <label for="svc-name" class="mb-1.5 block text-xs uppercase tracking-wider text-coffee">Name *</label>
                                <input id="svc-name" name="name" type="text" required value="{{ old('name') }}" placeholder="Your full name" class="w-full rounded-xl border border-charcoal/10 bg-charcoal/5 px-4 py-3 text-sm transition-colors focus:border-gold">
                            </div>
                            <div>
                                <label for="svc-phone" class="mb-1.5 block text-xs uppercase tracking-wider text-coffee">Phone *</label>
                                <input id="svc-phone" name="phone" type="tel" required value="{{ old('phone') }}" placeholder="+91 XXXXX XXXX" class="w-full rounded-xl border border-charcoal/10 bg-charcoal/5 px-4 py-3 text-sm transition-colors focus:border-gold">
                            </div>
                        </div>
                        <div class="sm:col-span-2">
                            <label for="svc-email" class="mb-1.5 block text-xs uppercase tracking-wider text-coffee">Email</label>
                            <input id="svc-email" name="email" type="email" value="{{ old('email') }}" placeholder="you@email.com" class="w-full rounded-xl border border-charcoal/10 bg-charcoal/5 px-4 py-3 text-sm transition-colors focus:border-gold">
                        </div>
                        <div class="sm:col-span-2">
                            <label for="svc-message" class="mb-1.5 block text-xs uppercase tracking-wider text-coffee">Message *</label>
                            <textarea id="svc-message" name="message" rows="4" required placeholder="Tell us about your project…" class="w-full resize-none rounded-xl border border-charcoal/10 bg-charcoal/5 px-4 py-3 text-sm transition-colors focus:border-gold">{{ old('message') }}</textarea>
                        </div>
                        <button type="submit" data-shine data-lift class="w-full rounded-full bg-charcoal px-8 py-3.5 text-sm font-medium tracking-wide text-cream transition-colors hover:bg-espresso">Send Enquiry</button>
                        @if (session('enquiry_sent'))
                            <p class="flex items-center gap-2 rounded-xl border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-700">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><path d="m9 11 3 3L22 4"/></svg>
                                Thank you, {{ session('enquiry_name') }} — your enquiry has been saved. Our Agra studio will call you shortly.
                            </p>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
