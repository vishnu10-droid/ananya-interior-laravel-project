@extends('layouts.app')
@section('title', 'About Us | Ananya Interior')
@section('content')
@php
    $phone = \App\Models\Setting::get('phone', '+91 7351400063 / +91 90847 27055');
    $address = \App\Models\Setting::get('address', 'Mangal Sen Bhawan, 21/18, Freeganj Rd, Belanganj, Civil Lines, Agra, Uttar Pradesh 282003');
    $phoneLink = \App\Models\Setting::get('phone_link', 'tel:+917351400063');
    $officeName = \App\Models\Setting::get('office_name', 'Ananya Endless Decor');
    $mapsLink = \App\Models\Setting::get('maps_url', 'https://www.google.com/maps/dir/?api=1&destination=Mangal+Sen+Bhawan%2C+21%2F18%2C+Freeganj+Rd%2C+Belanganj%2C+Civil+Lines%2C+Agra%2C+Uttar+Pradesh+282003');
    $mapsEmbed = \App\Models\Setting::get('maps_embed', 'https://www.google.com/maps?q=Mangal+Sen+Bhawan%2C+21%2F18%2C+Freeganj+Rd%2C+Belanganj%2C+Civil+Lines%2C+Agra%2C+Uttar+Pradesh+282003&output=embed');

    $img = [
        'hero' => 'https://images.unsplash.com/photo-1723258341592-e76d798273bb?auto=format&fit=crop&w=2000&q=85',
        'story' => 'https://images.unsplash.com/photo-1777895868494-4e01af8487b6?auto=format&fit=crop&w=1200&q=85',
        'slats' => '/images/company-profile/page-16-image-01.png',
        'material' => '/images/company-profile/page-09-image-01.png',
        'furniture' => 'https://images.unsplash.com/photo-1618220179428-22790b461013?auto=format&fit=crop&w=900&q=85',
        'stone' => 'https://images.unsplash.com/photo-1785535573671-507b061d2fa8?auto=format&fit=crop&w=900&q=85',
        'showroom' => 'https://images.unsplash.com/photo-1600607687939-ce8a6c25118c?auto=format&fit=crop&w=1400&q=85',
    ];

    $storyFeatures = [
        ['M3 10.5 12 3l9 7.5M5 9.5V21h14V9.5M9 21v-7h6v7', 'Residential Interiors'],
        ['M4 21V5a2 2 0 0 1 2-2h7a2 2 0 0 1 2 2v16M15 9h3a2 2 0 0 1 2 2v10M8 7h2M8 11h2M8 15h2', 'Commercial Interiors'],
        ['M21.3 12.3 12.3 21.3a1 1 0 0 1-1.4 0l-8.2-8.2a1 1 0 0 1 0-1.4l9-9a1 1 0 0 1 1.4 0l8.2 8.2a1 1 0 0 1 0 1.4ZM7 17l2 2M3 15l6 6', 'Customized Trade Solutions'],
        ['M12 2 9.5 4 6.5 3.5 6 6.5 3.5 8 4.5 11 3 13.5 5 15.5 5 18.5 8 19 9.5 22 12 20.5 14.5 22 16 19 19 18.5 19 15.5 21.5 13.5 20.5 11 21.5 8 19.5 8 16.5 6 15.5 7.5 12.5 7 9.5ZM9 12l2 2 4-4', 'Quality-Focused Execution'],
        ['M12 2a10 10 0 1 0 0 20h1.5a2 2 0 0 0 0-4H12a2 2 0 0 1 0-4h5a5 5 0 0 0 5-5 7 7 0 0 0-10-7ZM7.5 11h.01M10 7.5h.01M14.5 7.5h.01M17 11h.01', 'Modern Aesthetics'],
        ['M12 6v6l4 2M12 2a10 10 0 1 0 0 20 10 10 0 0 0 0-20Z', 'Open 24 Hours Support'],
    ];

    $stats = json_decode((string) \App\Models\Setting::get('stats_about', '[]'), true) ?: [];

    $differentiators = [
        ['M11 14 8 11m5 3 3-3M8 11 5 8a3 3 0 0 0-4 4l5 5a4 4 0 0 0 5.7 0l2.3-2.3M16 11l3-3a3 3 0 0 1 4 4l-5 5a4 4 0 0 1-5.7 0L10 14', 'Personalized Trade', 'Every plan starts from your lifestyle, not a catalogue.'],
        ['M6 3h12l4 6-10 12L2 9l4-6ZM2 9h20M12 21 7 9l5-6 5 6-5 12Z', 'Modern Aesthetics', 'Timeless palettes with quiet luxury detailing.'],
        ['M4 4h6v6H4zM14 4h6v6h-6zM4 14h6v6H4zM14 14h6v6h-6z', 'Functional Planning', 'Storage, movement and light — resolved first.'],
        ['M12 3l1.9 5.8L20 10l-5 3.9L16.3 20 12 17l-4.3 3L9 13.9 4 10l6.1-1.2L12 3Z', 'Attention to Detail', 'Joints, edges and paint lines we obsess over.'],
    ];

    $approachPoints = [
        ['M12 2c-4 4-6 7-6 10a6 6 0 0 0 12 0c0-3-2-6-6-10Z', 'Curated Materials'],
        ['M12 2l9 5v10l-9 5-9-5V7l9-5ZM3 7l9 5 9-5M12 12v10', 'Refined Finishes'],
        ['M12 2l8 4v6c0 5-3.4 8.4-8 10-4.6-1.6-8-5-8-10V6l8-4Z', 'Enduring Quality'],
    ];

    $nav = [['/', 'Home'], ['/about', 'About'], ['/products', 'Products'], ['/brands', 'Brands'], ['/services', 'Services'], ['/contact', 'Contact']];
    $svc = [['/services/home-interiors', 'Home Interior'], ['/services/modular-kitchen', 'Modular Kitchen'], ['/services/bedroom', 'Bedroom'], ['/services/living-room', 'Living Room'], ['/services/office-interiors', 'Office Interior']];
    $socials = [
        ['Instagram', 'https://www.instagram.com/', 'M2 2h20v20H2z M12 8a4 4 0 1 0 0 8 4 4 0 0 0 0-8Z M17.5 6.5h.01'],
        ['Facebook', 'https://www.facebook.com/', 'M14 8h3V4h-3a4 4 0 0 0-4 4v3H7v4h3v5h4v-5h3l1-4h-4V8a1 1 0 0 1 1-1Z'],
        ['YouTube', 'https://www.youtube.com/', 'M2 5h20v14H2z M10 9l5 3-5 3V9Z'],
        ['LinkedIn', 'https://www.linkedin.com/', 'M7 10v7M7 7v.01M11 17v-7M11 13a2.5 2.5 0 0 1 5 0v4 M2 2h20v20H2z'],
    ];
@endphp

<div class="overflow-x-clip bg-ivory">

    {{-- 1. HERO --}}
    <section class="relative flex min-h-[470px] items-center overflow-hidden bg-walnut lg:min-h-[510px]">
        <img src="{{ $img['hero'] }}" alt="Warm luxury living room by Ananya Interior" class="hero-zoom absolute inset-0 h-full w-full object-cover object-center">
        <div class="absolute inset-0 bg-gradient-to-r from-walnut/95 via-walnut/72 to-walnut/55"></div>
        <div class="absolute inset-0 bg-gradient-to-t from-walnut/80 via-transparent to-walnut/35"></div>

        <div class="relative mx-auto w-full max-w-[1180px] px-5 py-24 md:px-7 lg:py-28">
            <div class="motion-in-up flex items-center gap-3">
                <span class="h-px w-7 shrink-0 bg-champagne"></span>
                <span class="eyebrow-label whitespace-nowrap">About Ananya</span>
                <span class="h-px w-12 shrink-0 bg-champagne/60"></span>
            </div>
            <h1 class="motion-in-left mt-7 max-w-[640px] font-serif text-[40px] leading-[1.14] text-ivory sm:text-5xl lg:text-[58px]" style="--d:.12s">
                Your Space. <em class="font-normal italic">Reimagined</em>
                <br class="hidden sm:block"> for Tomorrow.
            </h1>
            <p class="motion-in-up mt-6 max-w-[440px] text-[14px] leading-[1.85] text-ivory/75 md:text-[15px]" style="--d:.28s">Premium interior and exterior solutions crafted with experience, design and precision.</p>
            <div class="motion-in-up mt-8" style="--d:.4s">
                <a href="/services" data-shine class="group inline-flex items-center gap-2.5 rounded-full bg-champagne px-7 py-3 text-[12px] font-medium tracking-wide text-walnut shadow-[0_10px_30px_-12px_rgba(196,154,90,0.8)] transition-all duration-300 hover:-translate-y-0.5 hover:bg-[#d3ac6f] hover:shadow-[0_16px_34px_-12px_rgba(196,154,90,0.9)]">Get to Know Us <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="transition-transform duration-300 group-hover:translate-x-1"><path d="M5 12h14m-6-6 6 6-6 6"/></svg></a>
            </div>
        </div>

        {{-- Circular brand seal --}}
        <div class="seal-in pointer-events-none absolute right-[6%] top-1/2 hidden -translate-y-1/2 place-items-center lg:grid">
            <div class="relative grid h-[142px] w-[142px] place-items-center rounded-full bg-walnut/85 shadow-[0_20px_60px_-20px_rgba(0,0,0,0.9)] ring-1 ring-champagne/50 backdrop-blur-sm">
                <svg viewBox="0 0 140 140" class="absolute inset-0 h-full w-full" aria-hidden="true">
                    <defs><path id="aboutSealPath" d="M70,70 m-53,0 a53,53 0 1,1 106,0 a53,53 0 1,1 -106,0"/></defs>
                    <text fill="#C49A5A" font-size="9" letter-spacing="3.1" font-family="Jost, sans-serif"><textPath href="#aboutSealPath" startOffset="2%">INTERIOR &amp; EXTERIOR SOLUTIONS • ANANYA</textPath></text>
                </svg>
                <div class="relative text-center">
                    <span class="block font-serif text-[34px] italic leading-none text-[#EBD8B4]">AB</span>
                    <span class="mt-1.5 block text-[7px] tracking-[0.32em] text-champagne">ANANYA</span>
                </div>
            </div>
        </div>

        {{-- Slide dots --}}
        <div class="absolute bottom-6 left-1/2 flex -translate-x-1/2 items-center gap-2">
            @for ($dot = 0; $dot < 4; $dot++)
                <button type="button" data-about-dot="{{ $dot }}" aria-label="Go to slide {{ $dot + 1 }}" class="h-[5px] rounded-full transition-all duration-300 {{ $dot === 0 ? 'w-6 bg-champagne' : 'w-[5px] bg-ivory/50 hover:bg-ivory/80' }}"></button>
            @endfor
        </div>
    </section>

    {{-- 2. OUR STORY --}}
    <section class="relative overflow-hidden bg-ivory py-20 md:py-24">
        <div class="soft-leaf-shadow pointer-events-none absolute -left-28 top-10 h-80 w-80 rounded-full"></div>
        <div class="soft-leaf-shadow pointer-events-none absolute -right-24 bottom-0 h-96 w-96 rounded-full"></div>
        <div class="relative mx-auto grid max-w-[1180px] items-center gap-12 px-5 md:px-7 lg:grid-cols-[1.02fr_0.98fr] lg:gap-16">
            <div data-reveal="left" class="relative mx-auto w-full max-w-[520px] pb-10 pr-6 pt-4 sm:pb-14 sm:pr-10">
                <div class="absolute bottom-0 left-0 h-[78%] w-[84%] rounded-[28px] bg-parchment"></div>
                <div class="absolute right-0 top-0 h-[52%] w-[54%] rounded-[24px] border border-champagne/60"></div>
                <div class="relative ml-[7%] h-[340px] overflow-hidden rounded-[22px] shadow-[0_30px_60px_-28px_rgba(43,32,26,0.6)] sm:h-[410px]">
                    <img src="{{ $img['story'] }}" alt="Ananya Interior — warm dining and living space" loading="lazy" class="h-full w-full object-cover transition-transform duration-[1.4s] ease-out hover:scale-105">
                </div>
                <div class="absolute bottom-[68px] left-0 flex items-center gap-3 rounded-xl border border-champagne/40 bg-walnut/95 px-5 py-3 shadow-xl backdrop-blur sm:bottom-[86px]">
                    <span class="grid h-9 w-9 place-items-center rounded-full border border-champagne/50 text-champagne"><svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><path d="M12 2l2 5 5 2-5 2-2 5-2-5-5-2 5-2 2-5Z"/></svg></span>
                    <span class="leading-tight"><span class="block text-[9px] uppercase tracking-[0.24em] text-ivory/60">Since</span><span class="block font-serif text-[22px] text-champagne">1995</span></span>
                </div>
            </div>
            <div>
                <div data-reveal="right"><div class="flex items-center gap-3"><span class="h-px w-7 shrink-0 bg-champagne"></span><span class="eyebrow-label whitespace-nowrap">Our Story</span><span class="h-px w-12 shrink-0 bg-champagne/60"></span></div></div>
                <h2 class="mt-6 font-serif text-[36px] leading-[1.16] text-ink sm:text-[42px] lg:text-[46px]" data-reveal="right" data-delay="80">Spaces Traded Around You.</h2>
                <p class="mt-5 text-[13.5px] leading-[1.9] text-muted md:text-[14px]" data-reveal="right" data-delay="140">
                    Ananya, a front-runner one-stop interior and exterior products mall, has its origin in the year 1995. A humble start-up by Mr. Vikas Bansal — M/s Bansal Wood Decor (P) Ltd. — focused on a single point: plywood, laminates, doors, veneers and other interior &amp; exterior products. Over the decades we have grown with a commitment to quality, design and customer trust.
                </p>
                <div class="mt-7 grid gap-2.5 sm:grid-cols-2">
                    @foreach ($storyFeatures as $i => $feature)
                        <div class="flex h-full items-center gap-3 rounded-lg border border-[#E7DCCD] bg-white px-4 py-3 shadow-[0_8px_24px_-18px_rgba(43,32,26,0.4)] transition-all duration-300 hover:-translate-y-0.5 hover:border-champagne/70 hover:shadow-[0_14px_30px_-18px_rgba(43,32,26,0.45)]" data-reveal="up" data-delay="{{ $i * 60 }}">
                            <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" class="shrink-0 text-champagne"><path d="{{ $feature[0] }}"/></svg>
                            <span class="text-[12px] leading-snug text-ink sm:text-[12.5px]">{{ $feature[1] }}</span>
                        </div>
                    @endforeach
                </div>
                <div data-reveal="right" data-delay="200">
                    <a href="/services" data-lift class="group mt-8 inline-flex items-center gap-2.5 rounded-full bg-walnut px-7 py-3 text-[12px] font-medium tracking-wide text-ivory shadow-[0_12px_30px_-16px_rgba(43,32,26,0.9)] transition-all duration-300 hover:-translate-y-0.5 hover:bg-brown hover:shadow-[0_18px_36px_-16px_rgba(43,32,26,0.95)]">Discover Our Story <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="transition-transform duration-300 group-hover:translate-x-1"><path d="M5 12h14m-6-6 6 6-6 6"/></svg></a>
                </div>
            </div>
        </div>
    </section>

    {{-- 3. STATISTICS --}}
    <section class="relative overflow-hidden bg-walnut">
        <img src="{{ $img['slats'] }}" alt="" aria-hidden="true" class="absolute inset-y-0 left-0 h-full w-[38%] object-cover opacity-25">
        <div class="wood-slats absolute inset-0 opacity-60"></div>
        <div class="absolute inset-0 bg-gradient-to-r from-walnut/40 via-walnut/90 to-walnut"></div>
        <div class="relative mx-auto grid max-w-[1060px] grid-cols-3 gap-2 px-3 py-12 sm:gap-6 sm:px-6 md:py-[70px]">
            @foreach ($stats as $i => $s)
                <div class="flex flex-col items-center text-center {{ $i > 0 ? 'sm:border-l sm:border-champagne/25' : '' }}" data-reveal="up" data-delay="{{ $i * 140 }}">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.35" class="text-champagne sm:h-[26px] sm:w-[26px]"><path d="{{ $s['icon'] }}"/></svg>
                    <p class="mt-3 font-serif text-[30px] leading-none text-[#EDDCBB] sm:mt-4 sm:text-[46px] md:text-[54px]"><span data-count="{{ $s['value'] }}" data-suffix="{{ $s['suffix'] }}">0</span></p>
                    <p class="mt-3 text-[8px] font-medium uppercase tracking-[0.18em] text-champagne sm:mt-4 sm:text-[10px] sm:tracking-[0.32em]">{{ $s['label'] }}</p>
                </div>
            @endforeach
        </div>
    </section>

    {{-- 4. WHY CHOOSE ANANYA --}}
    <section class="bg-ivory py-20 md:py-[88px]">
        <div class="mx-auto max-w-[1180px] px-5 md:px-7">
            <div data-reveal="up">
                <div class="flex items-center justify-center gap-3"><span class="h-px w-7 shrink-0 bg-champagne"></span><span class="eyebrow-label whitespace-nowrap">The Studio Difference</span><span class="h-px w-12 shrink-0 bg-champagne/60"></span></div>
                <h2 class="mt-5 text-center font-serif text-[36px] leading-tight text-ink md:text-[42px]">Why Choose <em class="font-normal italic text-champagne">Ananya?</em></h2>
            </div>
            <div class="mt-12 grid gap-5 sm:grid-cols-2 lg:grid-cols-4">
                @foreach ($differentiators as $i => $w)
                    <div data-lift data-reveal="up" data-delay="{{ $i * 100 }}" class="group flex h-full flex-col items-center rounded-xl border bg-[#FCFAF6] px-6 py-8 text-center shadow-[0_16px_38px_-28px_rgba(43,32,26,0.5)] transition-colors duration-300 hover:border-champagne hover:shadow-[0_22px_44px_-24px_rgba(43,32,26,0.45)] {{ $i === 0 ? 'border-champagne' : 'border-[#E7DCCD]' }}">
                        <span class="grid h-12 w-12 place-items-center rounded-full border border-champagne/35 bg-champagne/10 text-champagne transition-colors duration-300 group-hover:bg-champagne group-hover:text-white">
                            <svg width="21" height="21" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" class="shrink-0"><path d="{{ $w[0] }}"/></svg>
                        </span>
                        <h3 class="mt-5 font-serif text-[20px] text-ink">{{ $w[1] }}</h3>
                        <p class="mt-3 text-[12.5px] leading-[1.75] text-muted">{{ $w[2] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- 5. DESIGN PHILOSOPHY --}}
    <section class="bg-white py-16 md:py-20">
        <div class="mx-auto grid max-w-[1180px] items-center gap-12 px-5 md:px-7 lg:grid-cols-[1.03fr_0.97fr] lg:gap-16">
            <div class="relative mx-auto h-[360px] w-full max-w-[560px] sm:h-[430px]" data-reveal="left">
                <div class="absolute left-0 top-0 h-[68%] w-[62%] overflow-hidden rounded-lg shadow-[0_18px_44px_-24px_rgba(43,32,26,0.6)]">
                    <img src="{{ $img['material'] }}" alt="Premium wood and stone material selection" loading="lazy" class="h-full w-full object-cover">
                </div>
                <div class="absolute right-0 top-[5%] h-[82%] w-[37%] overflow-hidden rounded-lg shadow-[0_18px_44px_-24px_rgba(43,32,26,0.6)]">
                    <img src="{{ $img['furniture'] }}" alt="Luxury interior furniture and finishes" loading="lazy" class="h-full w-full object-cover">
                </div>
                <div class="absolute bottom-0 left-[26%] h-[30%] w-[44%] overflow-hidden rounded-lg border-[5px] border-white shadow-[0_22px_46px_-20px_rgba(43,32,26,0.65)]">
                    <img src="{{ $img['stone'] }}" alt="Natural stone material finish" loading="lazy" class="h-full w-full object-cover">
                </div>
            </div>
            <div>
                <div data-reveal="right"><div class="flex items-center gap-3"><span class="h-px w-7 shrink-0 bg-champagne"></span><span class="eyebrow-label whitespace-nowrap">Our Approach</span><span class="h-px w-12 shrink-0 bg-champagne/60"></span></div></div>
                <h2 class="mt-6 font-serif text-[36px] leading-[1.18] text-ink sm:text-[42px]" data-reveal="right" data-delay="80">A Thoughtful Design Philosophy</h2>
                <p class="mt-5 text-[13.5px] leading-[1.9] text-muted md:text-[14px]" data-reveal="right" data-delay="140">Great spaces come from the right balance of materials, function and style. Our collections bring together trusted brands, refined textures and enduring quality to create spaces that feel truly yours — considered in every detail and made to last.</p>
                <div class="mt-9 grid grid-cols-3 gap-1">
                    @foreach ($approachPoints as $i => $p)
                        <div class="flex flex-col items-center px-2 text-center {{ $i > 0 ? 'border-l border-[#E7DCCD]' : '' }}" data-reveal="up" data-delay="{{ 180 + $i * 100 }}">
                            <svg width="23" height="23" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.4" class="text-champagne"><path d="{{ $p[0] }}"/></svg>
                            <p class="mt-3 font-serif text-[13px] leading-snug text-ink sm:text-[14px]">{{ $p[1] }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    {{-- 6. VISIT OUR AGRA STUDIO --}}
    <section class="bg-ivory py-16 md:py-20">
        <div class="mx-auto grid max-w-[1180px] gap-7 px-5 md:px-7 lg:grid-cols-[0.92fr_1.08fr_1.08fr]">
            <div class="flex flex-col justify-center">
                <div data-reveal="left">
                    <div class="flex items-center gap-3"><span class="h-px w-7 shrink-0 bg-champagne"></span><span class="eyebrow-label whitespace-nowrap">Visit Us</span><span class="h-px w-12 shrink-0 bg-champagne/60"></span></div>
                    <h2 class="mt-6 font-serif text-[34px] leading-tight text-ink md:text-[38px]">Our Agra Studio</h2>
                    <p class="mt-4 text-[13px] leading-[1.85] text-muted">Experience our wide range of interior and exterior products, materials and finishes in person.</p>
                </div>
                <div data-reveal="left" data-delay="100">
                    <ul class="mt-7 space-y-4">
                        <li class="flex items-start gap-3"><svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" class="mt-0.5 shrink-0 text-champagne"><path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/><circle cx="12" cy="10" r="3"/></svg><span class="text-[12.5px] leading-[1.7] text-muted">{{ $address }}</span></li>
                        <li class="flex items-start gap-3"><svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" class="mt-0.5 shrink-0 text-champagne"><circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/></svg><span class="text-[12.5px] leading-[1.7] text-muted">Open 24 Hours</span></li>
                        <li class="flex items-start gap-3"><svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" class="mt-0.5 shrink-0 text-champagne"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.8 19.8 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.8 19.8 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.13.96.36 1.9.7 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.91.34 1.85.57 2.81.7A2 2 0 0 1 22 16.92Z"/></svg><span class="text-[12.5px] leading-[1.7] text-muted">{{ $phone }}</span></li>
                    </ul>
                </div>
                <div data-reveal="left" data-delay="160">
                    <a href="{{ $mapsLink }}" target="_blank" rel="noreferrer" data-lift class="group mt-8 inline-flex items-center gap-2.5 self-start rounded-full bg-walnut px-7 py-3 text-[12px] font-medium tracking-wide text-ivory shadow-[0_12px_30px_-16px_rgba(43,32,26,0.9)] transition-all duration-300 hover:-translate-y-0.5 hover:bg-brown hover:shadow-[0_18px_36px_-16px_rgba(43,32,26,0.95)]">Get Directions <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="transition-transform duration-300 group-hover:translate-x-1"><path d="M5 12h14m-6-6 6 6-6 6"/></svg></a>
                </div>
            </div>
            <div class="h-[280px] overflow-hidden rounded-xl shadow-[0_18px_44px_-24px_rgba(43,32,26,0.6)] lg:h-auto lg:min-h-[320px]" data-reveal="up">
                <img src="{{ $img['showroom'] }}" alt="Ananya Interior showroom and studio in Agra" loading="lazy" class="h-full w-full object-cover">
            </div>
            <div class="h-[300px] lg:h-auto" data-reveal="right">
                <div class="relative h-full overflow-hidden rounded-xl border border-parchment bg-parchment shadow-[0_14px_40px_-24px_rgba(43,32,26,0.5)] lg:min-h-[320px]">
                    <div data-map-fallback class="absolute inset-0 flex flex-col items-center justify-center gap-3 bg-[radial-gradient(circle_at_50%_35%,#F8F4EE,#E9DFD0)] px-6 text-center">
                        <span class="grid h-12 w-12 place-items-center rounded-full border border-champagne/50 bg-white text-champagne shadow-sm"><svg width="21" height="21" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/><circle cx="12" cy="10" r="3"/></svg></span>
                        <p class="font-serif text-lg text-walnut">Ananya Interior</p>
                        <p class="max-w-[240px] text-[11px] leading-relaxed text-muted">{{ $address }}</p>
                        <a href="{{ $mapsLink }}" target="_blank" rel="noreferrer" class="mt-1 inline-flex items-center gap-2 rounded-full bg-walnut px-5 py-2.5 text-[11px] tracking-wide text-ivory transition-colors hover:bg-brown">Get Directions <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14m-6-6 6 6-6 6"/></svg></a>
                    </div>
                    <iframe title="{{ $officeName }} — corporate office map" src="{{ $mapsEmbed }}" loading="lazy" referrerpolicy="no-referrer-when-downgrade" data-about-map class="absolute inset-0 h-full w-full border-0 opacity-0 transition-opacity duration-700"></iframe>
                </div>
            </div>
        </div>
    </section>

    {{-- 7. ABOUT FOOTER --}}
    <footer class="bg-walnut text-ivory">
        <div class="mx-auto grid max-w-[1180px] gap-10 px-5 py-14 sm:grid-cols-2 md:px-7 lg:grid-cols-4">
            <div data-reveal="left">
                <img src="/assets/logo.png" alt="Ananya Interior Logo" class="h-14 w-16 object-contain">
                <p class="mt-4 max-w-[260px] text-[12.5px] leading-[1.85] text-ivory/60">Premium residential and commercial interior trade studio in Agra — modern, elegant and functional spaces.</p>
                <div class="mt-5 flex items-center gap-2.5">
                    @foreach ($socials as $social)
                        <a href="{{ $social[1] }}" target="_blank" rel="noreferrer" aria-label="{{ $social[0] }}" title="{{ $social[0] }}" class="grid h-8 w-8 place-items-center rounded-full border border-ivory/20 text-ivory/70 transition-colors hover:border-champagne hover:bg-champagne/10 hover:text-champagne">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" class="h-[14px] w-[14px]"><path d="{{ $social[2] }}"/></svg>
                        </a>
                    @endforeach
                </div>
            </div>
            <div data-reveal="up" data-delay="100">
                <p class="eyebrow-label">Navigation</p>
                <ul class="mt-5 space-y-2.5 text-[12.5px]">
                    @foreach ($nav as $item)<li><a href="{{ $item[0] }}" class="text-ivory/65 transition-colors hover:text-champagne">{{ $item[1] }}</a></li>@endforeach
                </ul>
            </div>
            <div data-reveal="up" data-delay="200">
                <p class="eyebrow-label">Services</p>
                <ul class="mt-5 space-y-2.5 text-[12.5px]">
                    @foreach ($svc as $item)<li><a href="{{ $item[0] }}" class="text-ivory/65 transition-colors hover:text-champagne">{{ $item[1] }}</a></li>@endforeach
                </ul>
            </div>
            <div data-reveal="right" data-delay="300">
                <p class="eyebrow-label">Contact</p>
                <ul class="mt-5 space-y-3.5 text-[12.5px] text-ivory/65">
                    <li><a href="{{ $phoneLink }}" class="flex items-center gap-2.5 hover:text-champagne"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" class="shrink-0 text-champagne"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.8 19.8 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.8 19.8 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.13.96.36 1.9.7 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.91.34 1.85.57 2.81.7A2 2 0 0 1 22 16.92Z"/></svg>{{ $phone }}</a></li>
                    <li class="flex items-start gap-2.5"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" class="mt-0.5 shrink-0 text-champagne"><path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/><circle cx="12" cy="10" r="3"/></svg><span class="leading-relaxed">{{ $address }}</span></li>
                    <li class="flex items-center gap-2.5"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" class="shrink-0 text-champagne"><circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/></svg>Open 24 Hours</li>
                </ul>
            </div>
        </div>
        <div class="border-t border-champagne/25">
            <div class="mx-auto flex max-w-[1180px] flex-col items-center justify-between gap-3 px-5 py-5 text-[11px] text-ivory/50 md:flex-row md:px-7" data-reveal="up">
                <p>© 2026 Ananya Interior. All Rights Reserved.</p>
                <button type="button" data-scroll-top class="inline-flex items-center gap-2 rounded-full border border-champagne/35 px-4 py-2 text-ivory/75 transition-colors hover:border-champagne hover:bg-champagne/10 hover:text-champagne">Back to top <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="m18 15-6-6-6 6"/></svg></button>
            </div>
        </div>
    </footer>
</div>

@push('scripts')
<script>
    /* Hero slide dots (visual state only, like the reference hero). */
    document.querySelectorAll('[data-about-dot]').forEach(function (dot) {
        dot.addEventListener('click', function () {
            document.querySelectorAll('[data-about-dot]').forEach(function (other) {
                var active = other === dot;
                other.className = 'h-[5px] rounded-full transition-all duration-300 ' +
                    (active ? 'w-6 bg-champagne' : 'w-[5px] bg-ivory/50 hover:bg-ivory/80');
            });
        });
    });

    /* Map iframe fades in over the fallback once it has loaded. */
    (function () {
        var map = document.querySelector('[data-about-map]');
        if (!map) return;
        var reveal = function () {
            map.classList.remove('opacity-0');
            map.classList.add('opacity-100');
            var fallback = document.querySelector('[data-map-fallback]');
            if (fallback) fallback.style.display = 'none';
        };
        map.addEventListener('load', reveal);
        window.setTimeout(function () {
            if (map.classList.contains('opacity-0')) reveal();
        }, 8000);
    })();
</script>
@endpush
@endsection
