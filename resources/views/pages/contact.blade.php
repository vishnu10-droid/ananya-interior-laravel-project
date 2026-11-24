@extends('layouts.app')
@section('title', "Let's Create Your Space | Ananya Interior")
@section('description', 'Call, WhatsApp or send the form — we respond within a few hours.')

@section('content')
@php
    $types = ['Home Interior','Modular Kitchen','Bedroom','Living Room','Office Interior','Commercial Interior','Office','School','Hospital','Factory','Hotel/Resturant','Government Contractor','OME','Builder','Gem','Other'];
    $roles = ['Homeowner','Interior Designer','Architect','Builder','Contractor','Other'];
    $requirements = ['Immediate','Within 15 Days','3 Months','6 Months'];
    $phone = \App\Models\Setting::get('phone', '+91 7351400063 / +91 90847 27055');
    $phoneLink = \App\Models\Setting::get('phone_link', 'tel:+917351400063');
    $address = \App\Models\Setting::get('address', 'Mangal Sen Bhawan, 21/18, Freeganj Rd, Belanganj, Civil Lines, Agra, Uttar Pradesh 282003');
    $officeName = \App\Models\Setting::get('office_name', 'Ananya Endless Decor');
    $officeNameHi = \App\Models\Setting::get('office_name_hi', 'अनन्या एंडलेस डेकोर');
    $heroImage = \App\Models\Setting::get('image_hero', '/images/company-profile/page-01-image-01.png');
    $textureImage = '/images/company-profile/page-25-image-01.png';
    $whatsapp = \App\Models\Setting::get('whatsapp', 'https://wa.me/917351400063?text=Hi%20Ananya%20Interior%2C%20I%20want%20a%20trade%20consultation.');
    $mapsUrl = \App\Models\Setting::get('maps_url', 'https://www.google.com/maps/dir/?api=1&destination=27.1990526%2C78.0058476');
    $mapsEmbed = \App\Models\Setting::get('maps_embed', 'https://www.google.com/maps?q=27.1990526%2C78.0058476&z=17&output=embed');
    $hours = \App\Models\Setting::get('hours', 'Open 24 Hours, all days');
    $activeType = old('type', 'Home Interior');
@endphp

{{-- 1. CINEMATIC CONTACT HERO --}}
<section class="relative isolate flex min-h-[340px] items-center overflow-hidden bg-espressodeep md:min-h-[380px]">
    <img src="{{ $heroImage }}" alt="A warm wooden chair in a sunlit interior" class="hero-zoom absolute inset-0 h-full w-full object-cover object-[68%_center] opacity-70 brightness-[0.72] saturate-[0.85]">
    <div class="absolute inset-0 bg-gradient-to-r from-[#160f0a]/95 via-[#160f0a]/65 to-[#160f0a]/20"></div>
    <div class="absolute inset-0 bg-gradient-to-t from-espressodeep/70 via-transparent to-transparent"></div>

    <div class="relative mx-auto w-full max-w-7xl px-5 py-14 md:px-8 md:py-16">
        <div class="motion-in-up" style="--d:.15s">
            <span class="inline-flex items-center gap-2 rounded-full border border-champagne/50 bg-espressodeep/30 px-4 py-2 text-[10px] font-medium uppercase tracking-[0.3em] text-champagne backdrop-blur-md">
                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="m12 2 1.8 6.2L20 10l-6.2 1.8L12 18l-1.8-6.2L4 10l6.2-1.8L12 2Z"/></svg>
                Contact
            </span>
        </div>

        <h1 class="motion-in-up mt-6 max-w-2xl font-serif text-[2.5rem] leading-[1.06] text-cream sm:text-[3.4rem] md:text-[4.1rem]" style="--d:.28s">Let&rsquo;s Create<br><em class="italic text-[#F3E3C8]">Your Space</em></h1>

        <div class="motion-in-up" style="--d:.41s">
            <p class="mt-5 max-w-xl text-sm leading-relaxed text-cream/75 md:text-[15px]">Call, WhatsApp or send the form — we respond within a few hours.</p>
            <a href="#contact" data-scroll-to="contact" data-lift data-shine class="mt-7 inline-flex items-center gap-2 rounded-full bg-champagne px-6 py-3 text-xs font-medium tracking-wide text-espressodeep shadow-[0_14px_34px_-16px_rgba(196,154,90,0.95)] transition-all duration-300 hover:scale-[1.04] hover:bg-[#d9b274]">
                Get In Touch
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14m-6-6 6 6-6 6"/></svg>
            </a>
        </div>
    </div>
</section>

{{-- 2. CONTACT SECTION --}}
<section id="contact" class="relative scroll-mt-20 overflow-hidden bg-ivory py-20 md:py-24">
    <div class="soft-leaf-shadow pointer-events-none absolute -right-32 -top-24 h-[440px] w-[440px] rotate-[20deg]"></div>
    <div class="soft-leaf-shadow pointer-events-none absolute -bottom-40 -left-40 h-[420px] w-[420px] -rotate-[35deg] opacity-60"></div>

    <div class="relative mx-auto max-w-7xl px-5 md:px-8">

        {{-- Heading --}}
        <div class="mx-auto max-w-2xl text-center">
            <div class="flex items-center justify-center gap-3" data-reveal="left">
                <span class="h-px w-8 bg-champagne/70 sm:w-14"></span>
                <span class="eyebrow-label whitespace-nowrap">Get In Touch</span>
                <span class="h-px w-8 bg-champagne/70 sm:w-14"></span>
            </div>
            <h2 class="mt-4 font-serif text-[32px] leading-[1.12] text-espressodeep sm:text-[40px] md:text-[46px]" data-reveal="up">Let&rsquo;s Create <em class="italic text-champagne">Your Space</em></h2>
            <p class="mt-4 text-[15px] leading-relaxed text-coffee" data-reveal="up" data-delay="80">Tell us about your project — we usually respond within a few hours.</p>
        </div>

        {{-- Service Quick Links --}}
        <div class="mt-10 grid grid-cols-2 overflow-hidden rounded-2xl border border-brownrich/10 bg-white/50 md:grid-cols-4 md:divide-x md:divide-brownrich/10">
            @foreach (['Home Interior','Modular Kitchen','Bedroom','Office Interior'] as $i => $label)
                <div class="border-b border-brownrich/10 last:border-b-0 md:border-b-0" data-reveal="up" data-delay="{{ $i * 90 }}">
                    <button type="button" data-service="{{ $label }}" aria-pressed="{{ $activeType === $label ? 'true' : 'false' }}" class="group flex w-full items-center justify-center gap-3 px-4 py-5 transition-colors hover:bg-champagne/10 {{ $activeType === $label ? 'bg-champagne/15' : '' }}">
                        <span class="grid h-10 w-10 shrink-0 place-items-center rounded-full border border-champagne/30 bg-champagne/10 text-champagne transition-colors group-hover:bg-champagne group-hover:text-espressodeep">
                            @if ($i === 0)<svg width="19" height="19" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><path d="M4 12V6a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v6M3 12h18v6H3zM5 18v2M19 18v2"/></svg>
                            @elseif ($i === 1)<svg width="19" height="19" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><path d="M4 8h16v10H4zM8 8V5h8v3M9 12h6"/></svg>
                            @elseif ($i === 2)<svg width="19" height="19" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><path d="M3 18v-6a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2v6M5 10V7a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v3M5 18v2M19 18v2"/></svg>
                            @else<svg width="19" height="19" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><path d="M3 21h18M5 21V8l7-5 7 5v13M10 21v-6h4v6"/></svg>@endif
                        </span>
                        <span class="font-serif text-[15px] text-brownrich">{{ $label }}</span>
                    </button>
                </div>
            @endforeach
        </div>

        {{-- Contact Card + Enquiry Form --}}
        <div class="mt-10 grid items-stretch gap-6 lg:grid-cols-5">

            {{-- Contact Information --}}
            <div class="lg:col-span-2" data-reveal="left" data-delay="50">
                <div class="relative flex h-full flex-col overflow-hidden rounded-[28px] bg-gradient-to-br from-[#2c211a] via-espressodeep to-brownrich p-8 text-cream shadow-[0_30px_70px_-32px_rgba(33,25,20,0.85)] ring-1 ring-champagne/15 md:p-9" data-tilt>
                    <div aria-hidden="true" class="wood-slats pointer-events-none absolute inset-0 opacity-70"></div>
                    <img src="{{ $textureImage }}" alt="" aria-hidden="true" loading="lazy" class="pointer-events-none absolute bottom-0 right-0 h-3/4 w-3/4 object-cover opacity-[0.22] mix-blend-luminosity [mask-image:linear-gradient(to_left,#000,transparent)]">
                    <div class="pointer-events-none absolute inset-x-0 bottom-0 h-1/2 bg-gradient-to-t from-espressodeep/90 to-transparent"></div>

                    <div class="relative z-10">
                        <div class="flex items-center gap-3">
                            <span class="h-px w-8 bg-champagne"></span>
                            <span class="text-[11px] font-medium uppercase tracking-[0.38em] text-champagne">Ananya</span>
                        </div>

                        <div class="mt-5 space-y-1">
                            @foreach (\App\Models\Setting::phones() as $phoneOption)
                                <a href="{{ $phoneOption['tel'] }}" class="block font-serif text-[21px] leading-snug text-cream transition-colors hover:text-champagne sm:text-[23px]">{{ $phoneOption['label'] }}</a>
                            @endforeach
                        </div>

                        <div class="mt-6 flex items-start gap-3">
                            <span class="mt-0.5 grid h-9 w-9 shrink-0 place-items-center rounded-full border border-champagne/30 bg-champagne/10 text-champagne"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/><circle cx="12" cy="10" r="3"/></svg></span>
                            <div>
                                @if ($officeName)
                                    <p class="text-[11px] font-medium uppercase tracking-[0.18em] text-champagne">{{ $officeName }} <span class="normal-case tracking-normal text-cream/60">&middot; Corporate Office</span></p>
                                    @if ($officeNameHi)<p class="mt-0.5 text-[12px] text-cream/60">{{ $officeNameHi }}</p>@endif
                                @endif
                                <a href="{{ $mapsUrl }}" target="_blank" rel="noreferrer" class="mt-1 block text-sm leading-relaxed text-cream/75 transition-colors hover:text-champagne hover:underline">{{ $address }}</a>
                            </div>
                        </div>

                        <div class="mt-4 flex items-center gap-3">
                            <span class="grid h-9 w-9 shrink-0 place-items-center rounded-full border border-champagne/30 bg-champagne/10 text-champagne"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/></svg></span>
                            <p class="text-sm text-cream/75">{{ $hours }}</p>
                        </div>
                    </div>

                    {{-- Contact Actions --}}
                    <div class="relative z-10 mt-auto grid grid-cols-3 gap-2.5 pt-9">
                        <a href="{{ $phoneLink }}" data-lift class="flex flex-col items-center gap-1.5 rounded-xl bg-champagne py-4 text-xs font-medium text-espressodeep shadow-[0_12px_28px_-14px_rgba(196,154,90,0.9)] transition-colors hover:bg-[#d9b274]"><svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 0 1-2.18 2a19.79 19.79 0 0 1-8.63-3.07a19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.13.96.36 1.9.7 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.91.34 1.85.57 2.81.7A2 2 0 0 1 22 16.92z"/></svg>Call Now</a>
                        <a href="{{ $whatsapp }}" target="_blank" rel="noreferrer" data-lift class="flex flex-col items-center gap-1.5 rounded-xl border border-white/15 bg-white/10 py-4 text-xs text-cream transition-colors hover:border-champagne/50 hover:bg-white/15"><svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"/></svg>WhatsApp</a>
                        <a href="{{ $mapsUrl }}" target="_blank" rel="noreferrer" data-lift class="flex flex-col items-center gap-1.5 rounded-xl border border-white/15 bg-white/10 py-4 text-xs text-cream transition-colors hover:border-champagne/50 hover:bg-white/15"><svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="m3 11 19-9-9 19-2-8-8-2z"/></svg>Directions</a>
                    </div>
                </div>
            </div>

            {{-- Enquiry Form --}}
            <div class="lg:col-span-3" data-reveal="right" data-delay="100">
                <div class="relative h-full overflow-hidden rounded-[28px] bg-white p-7 shadow-[0_24px_70px_-30px_rgba(73,48,32,0.45)] ring-1 ring-brownrich/5 md:p-9" data-lift>
                    <div class="pointer-events-none absolute -bottom-20 -right-20 h-56 w-56 rounded-full bg-gradient-to-tl from-champagne/20 via-champagne/5 to-transparent blur-xl"></div>
                    <div class="pointer-events-none absolute bottom-0 right-0 h-24 w-36 rounded-tl-[100%] border-l border-t border-champagne/25 bg-champagne/10"></div>

                    <form id="enquiry-form" action="{{ route('contact.enquiry') }}" method="POST" class="relative z-10">
                        @csrf
                        <div class="grid gap-x-4 gap-y-5 sm:grid-cols-2">

                            {{-- Name --}}
                            <div data-reveal="up">
                                <label for="enquiry-name" class="block text-[11px] font-medium uppercase tracking-[0.16em] text-coffee">Name<span class="ml-0.5 text-champagne">*</span></label>
                                <div class="relative mt-1.5">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true" class="pointer-events-none absolute left-4 top-1/2 -translate-y-1/2 text-champagne/80"><circle cx="12" cy="8" r="5"/><path d="M20 21a8 8 0 0 0-16 0"/></svg>
                                    <input id="enquiry-name" name="name" type="text" required value="{{ old('name') }}" placeholder="Your full name" class="w-full rounded-xl border border-champagne/35 bg-white py-3 pl-11 pr-4 text-sm text-charcoal placeholder:text-stonewarm transition-all duration-300 hover:border-champagne/60 focus:border-champagne focus:ring-2 focus:ring-champagne/15 @error('name') border-red-400 @enderror">
                                </div>
                                @error('name')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                            </div>

                            {{-- Phone --}}
                            <div data-reveal="up" data-delay="60">
                                <label for="enquiry-phone" class="block text-[11px] font-medium uppercase tracking-[0.16em] text-coffee">Phone<span class="ml-0.5 text-champagne">*</span></label>
                                <div class="relative mt-1.5">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true" class="pointer-events-none absolute left-4 top-1/2 -translate-y-1/2 text-champagne/80"><path d="M22 16.92v3a2 2 0 0 1-2.18 2a19.79 19.79 0 0 1-8.63-3.07a19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.13.96.36 1.9.7 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.91.34 1.85.57 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                                    <input id="enquiry-phone" name="phone" type="tel" required value="{{ old('phone') }}" placeholder="98XXX XXXXX" class="w-full rounded-xl border border-champagne/35 bg-white py-3 pl-11 pr-4 text-sm text-charcoal placeholder:text-stonewarm transition-all duration-300 hover:border-champagne/60 focus:border-champagne focus:ring-2 focus:ring-champagne/15 @error('phone') border-red-400 @enderror">
                                </div>
                                @error('phone')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                            </div>

                            {{-- Email --}}
                            <div data-reveal="up" data-delay="120">
                                <label for="enquiry-email" class="block text-[11px] font-medium uppercase tracking-[0.16em] text-coffee">Email</label>
                                <div class="relative mt-1.5">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true" class="pointer-events-none absolute left-4 top-1/2 -translate-y-1/2 text-champagne/80"><rect x="2" y="4" width="20" height="16" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/></svg>
                                    <input id="enquiry-email" name="email" type="email" value="{{ old('email') }}" placeholder="you@email.com" class="w-full rounded-xl border border-champagne/35 bg-white py-3 pl-11 pr-4 text-sm text-charcoal placeholder:text-stonewarm transition-all duration-300 hover:border-champagne/60 focus:border-champagne focus:ring-2 focus:ring-champagne/15 @error('email') border-red-400 @enderror">
                                </div>
                                @error('email')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                            </div>

                            {{-- Project Type --}}
                            <div data-reveal="up" data-delay="180">
                                <label for="enquiry-type" class="block text-[11px] font-medium uppercase tracking-[0.16em] text-coffee">Project Type</label>
                                <div class="relative mt-1.5">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true" class="pointer-events-none absolute left-4 top-1/2 -translate-y-1/2 text-champagne/80"><path d="M20 12V8a2 2 0 0 0-2-2H6a2 2 0 0 0-2 2v4"/><path d="M4 12v4a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-4"/><path d="M6 18v2M18 18v2M2 12h20"/></svg>
                                    <select id="enquiry-type" name="type" class="w-full cursor-pointer appearance-none rounded-xl border border-champagne/35 bg-white py-3 pl-11 pr-10 text-sm text-charcoal transition-all duration-300 hover:border-champagne/60 focus:border-champagne focus:ring-2 focus:ring-champagne/15">
                                        @foreach ($types as $type)<option value="{{ $type }}" {{ $activeType === $type ? 'selected' : '' }}>{{ $type }}</option>@endforeach
                                    </select>
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true" class="pointer-events-none absolute right-4 top-1/2 -translate-y-1/2 text-champagne"><path d="m6 9 6 6 6-6"/></svg>
                                </div>
                                @error('type')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                            </div>

                            {{-- You Are --}}
                            <div data-reveal="up" data-delay="240">
                                <label for="enquiry-role" class="block text-[11px] font-medium uppercase tracking-[0.16em] text-coffee">You Are<span class="ml-0.5 text-champagne">*</span></label>
                                <div class="relative mt-1.5">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true" class="pointer-events-none absolute left-4 top-1/2 -translate-y-1/2 text-champagne/80"><circle cx="12" cy="8" r="5"/><path d="M20 21a8 8 0 0 0-16 0"/></svg>
                                    <select id="enquiry-role" name="role" required class="w-full cursor-pointer appearance-none rounded-xl border border-champagne/35 bg-white py-3 pl-11 pr-10 text-sm text-charcoal transition-all duration-300 hover:border-champagne/60 focus:border-champagne focus:ring-2 focus:ring-champagne/15 @error('role') border-red-400 @enderror">
                                        <option value="" disabled {{ old('role') ? '' : 'selected' }}>Select your profession</option>
                                        @foreach ($roles as $role)<option value="{{ $role }}" {{ old('role') === $role ? 'selected' : '' }}>{{ $role }}</option>@endforeach
                                    </select>
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true" class="pointer-events-none absolute right-4 top-1/2 -translate-y-1/2 text-champagne"><path d="m6 9 6 6 6-6"/></svg>
                                </div>
                                @error('role')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                            </div>

                            {{-- Site Location --}}
                            <div class="sm:col-span-2" data-reveal="up" data-delay="300">
                                <label class="block text-[11px] font-medium uppercase tracking-[0.16em] text-coffee">Site Location<span class="ml-0.5 text-champagne">*</span></label>
                                <div class="mt-1.5 grid grid-cols-1 gap-3 sm:grid-cols-3">
                                    <div class="relative">
                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true" class="pointer-events-none absolute left-4 top-1/2 -translate-y-1/2 text-champagne/80"><path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/><circle cx="12" cy="10" r="3"/></svg>
                                        <input id="enquiry-city" name="city" type="text" required value="{{ old('city') }}" placeholder="Enter City" aria-label="Site city" class="w-full rounded-xl border border-champagne/35 bg-white py-3 pl-11 pr-4 text-sm text-charcoal placeholder:text-stonewarm transition-all duration-300 hover:border-champagne/60 focus:border-champagne focus:ring-2 focus:ring-champagne/15 @error('city') border-red-400 @enderror">
                                    </div>
                                    <div class="relative">
                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true" class="pointer-events-none absolute left-4 top-1/2 -translate-y-1/2 text-champagne/80"><path d="m3 11 19-9-9 19-2-8-8-2z"/></svg>
                                        <input id="enquiry-area" name="area" type="text" required value="{{ old('area') }}" placeholder="Area / Locality" aria-label="Site area or locality" class="w-full rounded-xl border border-champagne/35 bg-white py-3 pl-11 pr-4 text-sm text-charcoal placeholder:text-stonewarm transition-all duration-300 hover:border-champagne/60 focus:border-champagne focus:ring-2 focus:ring-champagne/15 @error('area') border-red-400 @enderror">
                                    </div>
                                    <div class="relative">
                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true" class="pointer-events-none absolute left-4 top-1/2 -translate-y-1/2 text-champagne/80"><path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/><circle cx="12" cy="10" r="3"/></svg>
                                        <input id="enquiry-pincode" name="pincode" type="text" inputmode="numeric" autocomplete="postal-code" maxlength="6" required value="{{ old('pincode') }}" placeholder="6-digit Pincode" aria-label="Site pincode" class="w-full rounded-xl border border-champagne/35 bg-white py-3 pl-11 pr-4 text-sm text-charcoal placeholder:text-stonewarm transition-all duration-300 hover:border-champagne/60 focus:border-champagne focus:ring-2 focus:ring-champagne/15 @error('pincode') border-red-400 @enderror">
                                    </div>
                                </div>
                                @foreach (['city','area','pincode'] as $siteField)
                                    @error($siteField)<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                                @endforeach
                            </div>

                            {{-- Project Requirements --}}
                            <div data-reveal="up" data-delay="360">
                                <label for="enquiry-requirements" class="block text-[11px] font-medium uppercase tracking-[0.16em] text-coffee">Project Requirements<span class="ml-0.5 text-champagne">*</span></label>
                                <div class="relative mt-1.5">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true" class="pointer-events-none absolute left-4 top-1/2 -translate-y-1/2 text-champagne/80"><rect x="8" y="2" width="8" height="4" rx="1"/><path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"/><path d="M12 11h4M12 16h4M8 11h.01M8 16h.01"/></svg>
                                    <select id="enquiry-requirements" name="requirements" required class="w-full cursor-pointer appearance-none rounded-xl border border-champagne/35 bg-white py-3 pl-11 pr-10 text-sm text-charcoal transition-all duration-300 hover:border-champagne/60 focus:border-champagne focus:ring-2 focus:ring-champagne/15 @error('requirements') border-red-400 @enderror">
                                        <option value="" disabled {{ old('requirements') ? '' : 'selected' }}>Select project timeline</option>
                                        @foreach ($requirements as $req)<option value="{{ $req }}" {{ old('requirements') === $req ? 'selected' : '' }}>{{ $req }}</option>@endforeach
                                    </select>
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true" class="pointer-events-none absolute right-4 top-1/2 -translate-y-1/2 text-champagne"><path d="m6 9 6 6 6-6"/></svg>
                                </div>
                                @error('requirements')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                            </div>

                            {{-- Message --}}
                            <div class="sm:col-span-2" data-reveal="up" data-delay="420">
                                <label for="enquiry-message" class="block text-[11px] font-medium uppercase tracking-[0.16em] text-coffee">Message<span class="ml-0.5 text-champagne">*</span></label>
                                <div class="relative mt-1.5">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true" class="pointer-events-none absolute left-4 top-4 text-champagne/80"><path d="M12 20h9"/><path d="M16.5 3.5a2.12 2.12 0 0 1 3 3L7 19l-4 1 1-4Z"/></svg>
                                    <textarea id="enquiry-message" name="message" rows="4" required placeholder="Tell us about your space, size and what you dream of…" class="w-full min-h-[112px] resize-none rounded-xl border border-champagne/35 bg-white py-3 pl-11 pr-4 pt-3.5 text-sm text-charcoal placeholder:text-stonewarm transition-all duration-300 hover:border-champagne/60 focus:border-champagne focus:ring-2 focus:ring-champagne/15 @error('message') border-red-400 @enderror">{{ old('message') }}</textarea>
                                </div>
                                @error('message')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                            </div>

                        </div>

                        {{-- Laravel validation summary (React-style error box) --}}
                        @if ($errors->any())
                            <div role="alert" class="mt-5 rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700">
                                <ul class="list-disc pl-5">
                                    @foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach
                                </ul>
                            </div>
                        @endif

                        <button type="submit" data-shine class="mt-6 inline-flex items-center gap-2 rounded-full bg-espressodeep px-8 py-3.5 text-sm tracking-wide text-cream shadow-[0_14px_32px_-16px_rgba(33,25,20,0.9)] transition-all duration-300 hover:scale-[1.02] hover:bg-brownrich active:scale-[0.98]">
                            Send Enquiry
                            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="m22 2-7 20-4-9-9-4 20-7z"/></svg>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Success Popup (AnimatePresence-style via data-modal) --}}
    @if (session('enquiry_sent'))
        <button type="button" hidden data-modal-open="enquiry-success" aria-hidden="true" tabindex="-1"></button>
        <div data-modal id="enquiry-success" hidden>
            <div class="modal-backdrop" data-modal-close></div>
            <div class="modal-panel max-w-md rounded-3xl bg-cream p-8 text-center shadow-lift" role="dialog" aria-modal="true">
                <button type="button" data-modal-close aria-label="Close" class="absolute right-4 top-4 grid h-9 w-9 place-items-center rounded-full border border-brownrich/10 bg-white text-coffee transition-colors hover:text-champagne"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 6 6 18M6 6l12 12"/></svg></button>

                <span class="mx-auto grid h-16 w-16 place-items-center rounded-full bg-green-100 text-green-700" data-float>
                    <svg width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><path d="m9 11 3 3L22 4"/></svg>
                </span>

                <h3 class="mt-5 font-serif text-[26px] text-espressodeep">Thank you, <span data-modal-name>{{ session('enquiry_name') }}</span>!</h3>
                <p class="mt-2 text-sm leading-relaxed text-coffee">Your enquiry has been noted. Our Agra studio will call you shortly on <strong data-modal-phone>{{ session('enquiry_phone', '') }}</strong>.</p>

                <div class="mt-5 rounded-xl bg-white/70 p-4 text-left text-sm text-coffee">
                    <p><strong>Project Type:</strong> <span data-modal-field="type"></span></p>
                    <p class="mt-2"><strong>Profession:</strong> <span data-modal-field="role"></span></p>
                    <p class="mt-2"><strong>City:</strong> <span data-modal-field="city"></span></p>
                    <p class="mt-2"><strong>Area:</strong> <span data-modal-field="area"></span></p>
                    <p class="mt-2"><strong>Pincode:</strong> <span data-modal-field="pincode"></span></p>
                    <p class="mt-2"><strong>Project Timeline:</strong> <span data-modal-field="requirements"></span></p>
                    <p class="mt-2"><strong>Message:</strong> <span data-modal-field="message"></span></p>
                </div>

                <div class="mt-6 flex flex-wrap justify-center gap-2.5">
                    <a href="{{ $whatsapp }}" target="_blank" rel="noreferrer" data-lift class="rounded-full bg-espressodeep px-6 py-3 text-sm text-cream transition-colors hover:bg-brownrich">Chat on WhatsApp</a>
                    <button type="button" data-modal-close class="rounded-full border border-brownrich/20 px-6 py-3 text-sm text-coffee transition-colors hover:border-champagne hover:text-espressodeep">Done</button>
                </div>
            </div>
        </div>
    @endif
</section>

{{-- 3. TRUST STATISTICS --}}
@php
    $stats = json_decode((string) \App\Models\Setting::get('stats_contact', '[]'), true) ?: [];
@endphp
<section class="mx-auto max-w-7xl px-5 pb-14 md:px-8">
    <div class="grid grid-cols-2 overflow-hidden rounded-[26px] border border-champagne/40 bg-white/70 shadow-[0_22px_60px_-38px_rgba(73,48,32,0.6)] backdrop-blur-sm md:grid-cols-4" data-reveal="up">
        @foreach ($stats as $i => $stat)
            <div class="flex items-center gap-3 px-4 py-6 md:gap-4 md:px-7 {{ $loop->index % 2 === 1 ? 'border-l border-champagne/25' : '' }} {{ $loop->index >= 2 ? 'border-t border-champagne/25 md:border-t-0' : '' }} {{ $loop->index > 0 ? 'md:border-l md:border-champagne/25' : '' }}">
                <span class="grid h-10 w-10 shrink-0 place-items-center rounded-full border border-champagne/35 bg-champagne/10 text-champagne md:h-11 md:w-11">
                    @if ($i === 0)
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><path d="m16 16 2 2 4-4"/><path d="M21 10V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l2-1.14"/><path d="M7.5 4.27 12 6.77l4.5-2.5"/><path d="M3.3 7 12 12l8.7-5"/><path d="M12 22v-9"/></svg>
                    @elseif ($i === 1)
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><circle cx="12" cy="8" r="6"/><path d="M15.477 12.89 17 22l-5-3-5 3 1.523-9.11"/></svg>
                    @elseif ($i === 2)
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><rect x="3" y="4" width="18" height="18" rx="2"/><path d="M8 2v4M16 2v4M3 10h18"/><path d="M8 14h.01M12 14h.01M16 14h.01M8 18h.01M12 18h.01M16 18h.01"/></svg>
                    @else
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><path d="M20 13c0 5-3.5 7.5-7.66 8.95a1 1 0 0 1-.67-.01C7.5 20.5 4 18 4 13V6a1 1 0 0 1 1-1c2 0 4.5-1.2 6.24-2.72a1.17 1.17 0 0 1 1.52 0C14.51 3.81 17 5 19 5a1 1 0 0 1 1 1z"/><path d="m9 12 2 2 4-4"/></svg>
                    @endif
                </span>
                <div>
                    <p class="font-serif text-[24px] leading-none text-espressodeep md:text-[30px]"><span data-count="{{ $stat[0] }}" data-suffix="{{ $stat[1] }}">0</span></p>
                    <p class="mt-1.5 text-[10px] uppercase tracking-[0.12em] text-coffee">{{ $stat[2] }}</p>
                </div>
            </div>
        @endforeach
    </div>
</section>

{{-- 4. MAP --}}
<section class="mx-auto max-w-7xl px-5 pb-14 md:px-8">
    <div class="rounded-[28px] border border-champagne/50 bg-white p-1.5 shadow-[0_30px_70px_-36px_rgba(33,25,20,0.6)]" data-reveal="up">
        <div class="overflow-hidden rounded-[20px]">
            <iframe title="{{ $officeName }} — corporate office map" src="{{ $mapsEmbed }}" class="block h-[320px] w-full border-0 md:h-[420px]" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    </div>

    <div class="mt-6 flex flex-col items-center justify-center gap-3 sm:flex-row">
        <a href="{{ $mapsUrl }}" target="_blank" rel="noreferrer" data-lift class="inline-flex items-center gap-2 rounded-full bg-espressodeep px-7 py-3 text-xs uppercase tracking-[0.16em] text-cream transition-colors hover:bg-brownrich">
            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="m3 11 19-9-9 19-2-8-8-2z"/></svg>
            Get Directions
            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14m-6-6 6 6-6 6"/></svg>
        </a>
        <a href="{{ $phoneLink }}" data-lift class="inline-flex items-center gap-2 rounded-full border border-champagne/50 px-7 py-3 text-xs uppercase tracking-[0.16em] text-brownrich transition-colors hover:bg-champagne/10">Call the studio</a>
    </div>

    <div class="mt-10 text-center"><a href="/" data-lift class="inline-flex items-center gap-2 rounded-full border border-champagne/40 bg-creamwarm px-6 py-2.5 text-sm text-coffee transition-colors hover:border-champagne hover:text-espressodeep">Back to home <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14m-6-6 6 6-6 6"/></svg></a></div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('[data-scroll-to]').forEach(function (el) {
        el.addEventListener('click', function (event) {
            var target = document.getElementById(el.dataset.scrollTo);
            if (!target) return;
            event.preventDefault();
            target.scrollIntoView({ behavior: 'smooth', block: 'start' });
        });
    });

    // Remember submitted values so the success popup can mirror React's enquiry summary.
    var enquiryForm = document.getElementById('enquiry-form');
    if (enquiryForm) {
        enquiryForm.addEventListener('submit', function () {
            try {
                var data = new FormData(enquiryForm);
                var values = {};
                ['name','phone','email','type','role','city','area','pincode','requirements','message'].forEach(function (key) {
                    values[key] = String(data.get(key) || '');
                });
                sessionStorage.setItem('ananya_enquiry', JSON.stringify(values));
            } catch (e) {}
        });
    }

    document.querySelectorAll('[data-service]').forEach(function (chip) {
        chip.addEventListener('click', function () {
            var select = document.getElementById('enquiry-type');
            if (!select) return;
            select.value = chip.dataset.service;
            document.querySelectorAll('[data-service]').forEach(function (c) {
                var active = c === chip;
                c.setAttribute('aria-pressed', active ? 'true' : 'false');
                c.classList.toggle('bg-champagne/15', active);
            });
            select.scrollIntoView({ behavior: 'smooth', block: 'center' });
            select.focus({ preventScroll: true });
        });
    });

    var pincode = document.getElementById('enquiry-pincode');
    if (pincode) {
        pincode.addEventListener('input', function () {
            pincode.value = pincode.value.replace(/\D/g, '').slice(0, 6);
        });
    }

    @if (session('enquiry_sent'))
        (function () {
            var modal = document.getElementById('enquiry-success');
            if (!modal) return;
            try {
                var values = JSON.parse(sessionStorage.getItem('ananya_enquiry') || '{}');
                var first = String(values.name || '').trim().split(/\s+/)[0];
                var nameEl = modal.querySelector('[data-modal-name]');
                if (nameEl) nameEl.textContent = first || @json(session('enquiry_name'));
                var phoneEl = modal.querySelector('[data-modal-phone]');
                if (phoneEl) phoneEl.textContent = values.phone || '';
                Object.keys(values).forEach(function (key) {
                    var field = modal.querySelector('[data-modal-field="' + key + '"]');
                    if (field) field.textContent = values[key];
                });
            } catch (e) {}
            window.setTimeout(function () {
                var opener = document.querySelector('[data-modal-open="enquiry-success"]');
                if (opener) opener.click();
            }, 400);
        })();
    @endif
});
</script>
@endsection
