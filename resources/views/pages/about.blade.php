@extends('layouts.app')
@section('title', 'About Us | Ananya Interior')
@section('content')
@php
    $phone = \App\Models\Setting::get('phone', '+91 7351400063 / +91 9837027055');
    $address = \App\Models\Setting::get('address', '21/18, Mangal Sen Bhawan, Freeganj, Agra (U.P) 282004');
@endphp
<div class="overflow-x-clip bg-ivory">
    <section class="relative flex min-h-[600px] items-end overflow-hidden bg-walnut lg:min-h-[680px]">
        <div class="absolute inset-0 bg-cover bg-center opacity-45" style="background-image:url('{{ \App\Models\Setting::get('image_about', '/images/company-profile/page-02-image-01.png') }}')"></div>
        <div class="absolute inset-0 bg-gradient-to-r from-walnut via-walnut/80 to-transparent"></div>
        <div class="relative mx-auto w-full max-w-7xl px-5 pb-24 pt-36 md:px-8">
            <p class="eyebrow-label">About Ananya</p>
            <h1 class="mt-7 max-w-[640px] font-serif text-[40px] leading-[1.14] text-ivory sm:text-5xl lg:text-[58px]">A legacy of <em class="italic text-champagne">considered</em> interiors</h1>
            <p class="mt-6 max-w-[440px] text-[14px] leading-[1.85] text-ivory/75 md:text-[15px]">Premium interior and exterior solutions crafted with experience, design and precision.</p>
            <a href="/services" class="mt-8 inline-flex items-center gap-2.5 rounded-full bg-champagne px-7 py-3 text-[12px] font-medium tracking-wide text-walnut shadow-[0_10px_30px_-12px_rgba(196,154,90,0.8)] transition-all hover:-translate-y-0.5">Get to Know Us <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14m-6-6 6 6-6 6"/></svg></a>
        </div>
    </section>

    <section class="mx-auto max-w-7xl px-5 py-20 md:px-8">
        <div class="grid items-center gap-12 lg:grid-cols-2">
            <div data-reveal="left"><p class="eyebrow-label">Our Story</p><h2 class="mt-4 font-serif text-3xl leading-tight text-ink md:text-4xl">Since 1995 — trusted across Agra.</h2><p class="mt-6 text-sm leading-[1.9] text-muted">Ananya, a front-runner one-stop interior and exterior products mall, has its origin in the year 1995. A humble start-up by Mr. Vikas Bansal — M/s Bansal Wood Decor (P) Ltd. — focused on a single point: plywood, laminates, doors, veneers and other interior &amp; exterior products. Over the decades we have grown with a commitment to quality, design and customer trust.</p></div>
            <img src="/images/company-profile/page-26-image-01.png" alt="Ananya craftsmanship" loading="lazy" class="h-[440px] w-full rounded-2xl object-cover shadow-lift" data-reveal="right">
        </div>
    </section>

    <section class="bg-walnut px-5 py-16 md:px-8">
        <div class="mx-auto grid max-w-7xl grid-cols-2 gap-6 md:grid-cols-4">
            @foreach ([['24','Projects Delivered','+'],['8','Trade Services',''],['1995','Established',''],['254','Happy Clients','+']] as $s)
                <div class="text-center" data-reveal="up"><p class="font-serif text-4xl text-[#EDDCBB] md:text-5xl">{{ $s[0] }}{{ $s[2] }}</p><p class="mt-2 text-[11px] uppercase tracking-[0.16em] text-champagne/70">{{ $s[1] }}</p></div>
            @endforeach
        </div>
    </section>

    <section class="mx-auto max-w-7xl px-5 py-20 md:px-8">
        <p class="eyebrow-label text-center">Why Choose Us</p>
        <h2 class="mt-3 text-center font-serif text-3xl text-ink md:text-4xl">Built on four simple promises</h2>
        <div class="mt-10 grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
            @foreach ([['Trusted Quality','IS-certified and tested for long-term performance.'],['Wide Variety','Multiple grades, thicknesses and finishes for every need.'],['Expert Guidance','Get the right material for your space and budget.'],['Bulk & Project Supply','Reliable supply for homes, offices and large projects.']] as $i => $why)
                <div class="rounded-2xl border border-champagne/25 bg-white p-7 text-center shadow-card" data-reveal="up" data-delay="{{ $i * 80 }}"><h3 class="font-serif text-lg text-ink">{{ $why[0] }}</h3><p class="mt-2 text-xs leading-relaxed text-muted">{{ $why[1] }}</p></div>
            @endforeach
        </div>
    </section>

    <section class="bg-parchment px-5 py-16 md:px-8">
        <div class="mx-auto max-w-7xl rounded-3xl bg-walnut p-8 text-cream md:p-12" data-reveal="up">
            <p class="text-[11px] uppercase tracking-[0.34em] text-champagne">Visit Studio</p>
            <h2 class="mt-3 font-serif text-3xl text-[#F3E3C8] md:text-4xl">Come see the materials for yourself</h2>
            <p class="mt-4 max-w-xl text-sm leading-relaxed text-cream/70">{{ $address }}</p>
            <p class="mt-2 text-sm text-cream/70">{{ $phone }}</p>
            <a href="/contact" class="mt-6 inline-flex items-center gap-2 rounded-full bg-champagne px-7 py-3 text-xs font-medium text-walnut">Plan a Visit <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14m-6-6 6 6-6 6"/></svg></a>
        </div>
    </section>
</div>
@endsection
