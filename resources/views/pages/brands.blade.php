@extends('layouts.app')
@section('title', 'Brand Partners | Ananya Interior')
@section('content')
<section class="relative overflow-hidden bg-[#1C1109] text-[#F7EEDF]">
    <div class="absolute inset-0 bg-gradient-to-r from-[#1C1109] via-[#1C1109]/85 to-[#1C1109]/10"></div>
    <div class="absolute inset-0 bg-cover bg-center opacity-25" style="background-image:url('{{ \App\Models\Setting::get('image_luxury', '/images/company-profile/page-04-image-01.png') }}')"></div>
    <div class="relative mx-auto max-w-7xl px-5 py-20 md:px-8">
        <p class="text-[10px] font-medium uppercase tracking-[0.28em] text-[#D9B45B]">Brand Partners</p>
        <h1 class="mt-3 font-serif text-4xl leading-[1.08] md:text-5xl">Trusted Brand <span class="text-[#D9B45B]">Partnerships</span></h1>
        <p class="mt-5 max-w-2xl text-sm leading-relaxed text-[#D9CBB4]">We partner with India's leading interior and exterior material brands to bring you quality, durability, and trade excellence under one roof.</p>
    </div>
</section>

<section class="bg-beige/40 py-12">
    <div class="mx-auto max-w-7xl px-5 md:px-8">
        <p class="text-[11px] font-medium uppercase tracking-[0.3em] text-gold">In the showroom</p>
        <div class="marquee-fade relative mt-6 overflow-hidden">
            <div class="animate-marquee">
                @foreach ([...$brands->whereNotNull('logo'), ...$brands->whereNotNull('logo')] as $i => $brand)
                    <div class="mr-3 grid h-24 w-40 shrink-0 place-items-center rounded-xl border border-[#E6DCCB] bg-white px-4 py-3 shadow-card sm:mr-4 sm:w-44" @if ($i >= $brands->whereNotNull('logo')->count()) aria-hidden="true" @endif>
                        <div class="flex flex-col items-center gap-1.5"><img src="{{ $brand->logo }}" alt="{{ $brand->name }}" loading="lazy" class="max-h-9 w-full object-contain"><span class="text-center text-[10px] font-medium text-[#5A4A38]">{{ $brand->name }}</span></div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

<section class="mx-auto max-w-7xl px-5 py-20 md:px-8">
    <p class="text-[11px] font-medium uppercase tracking-[0.3em] text-gold">Our Brand Partners</p>
    <h2 class="mt-3 font-serif text-3xl text-charcoal md:text-4xl">Brands We Work With</h2>
    <div class="mt-12 grid grid-cols-2 gap-5 sm:grid-cols-3 md:grid-cols-4">
        @foreach ($brands as $i => $brand)
            <div class="grid min-h-[140px] place-items-center rounded-xl border border-charcoal/5 bg-white p-5 shadow-card transition-shadow hover:shadow-lift" data-reveal="up" data-delay="{{ ($i % 8) * 60 }}">
                @if ($brand->logo)<img src="{{ $brand->logo }}" alt="{{ $brand->name }}" loading="lazy" class="max-h-12 w-full object-contain">@else<span class="font-serif text-lg text-charcoal">{{ $brand->name }}</span>@endif
            </div>
        @endforeach
    </div>
</section>
@endsection
