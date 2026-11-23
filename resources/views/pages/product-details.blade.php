@extends('layouts.app')
@section('title', $product->name.' | Ananya Interior')
@section('content')
<section class="mx-auto max-w-7xl px-5 py-10 md:px-8 md:py-14">
    <p class="text-[11px] text-coffee"><a href="/products" class="hover:text-golddark">Products</a> › <a href="/categories/{{ $product->category->slug ?? '' }}" class="hover:text-golddark">{{ $product->category->name ?? '' }}</a> › {{ $product->name }}</p>
    <div class="mt-6 grid gap-10 lg:grid-cols-2">
        <div>
            <div class="overflow-hidden rounded-2xl border border-gold/20 bg-beige"><img src="{{ $product->image }}" alt="{{ $product->name }}" class="aspect-[4/3] w-full object-cover"></div>
            @if ($product->images->count() > 1)
                <div class="mt-3 grid grid-cols-4 gap-3">@foreach ($product->images as $image)<img src="{{ $image->path }}" alt="{{ $product->name }}" loading="lazy" class="aspect-square w-full rounded-lg border border-charcoal/10 object-cover">@endforeach</div>
            @endif
        </div>
        <div>
            <p class="text-[11px] uppercase tracking-[0.28em] text-golddark">{{ $product->category->name ?? 'Materials' }}</p>
            <h1 class="mt-3 font-serif text-3xl leading-tight text-charcoal md:text-4xl">{{ $product->name }}</h1>
            @if ($product->brand)<p class="mt-3 text-sm text-coffee">Brand: <span class="font-medium text-charcoal">{{ $product->brand->name }}</span></p>@endif
            <p class="mt-5 text-sm leading-[1.9] text-coffee">{{ $product->short_description }}</p>
            <p class="mt-3 text-sm leading-[1.9] text-coffee">{{ $product->description }}</p>
            @if ($product->features)
                <div class="mt-6"><h3 class="font-serif text-lg text-charcoal">Highlights</h3><ul class="mt-3 space-y-2">@foreach ($product->features as $feature)<li class="flex items-center gap-2 text-sm text-coffee">✓ {{ $feature }}</li>@endforeach</ul></div>
            @endif
            <a href="/contact" class="mt-8 inline-flex items-center gap-2 rounded-full bg-charcoal px-8 py-3.5 text-sm text-cream hover:bg-espresso">Send Enquiry <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14m-6-6 6 6-6 6"/></svg></a>
            <div class="mt-8 rounded-2xl border border-charcoal/10 bg-cream p-5 text-sm text-coffee"><p class="font-medium text-charcoal">Display Centre</p><p class="mt-1">{{ \App\Models\Setting::get('display_centre') }}</p></div>
        </div>
    </div>
</section>

@if ($related->count())
<section class="mx-auto max-w-7xl px-5 pb-16 md:px-8">
    <h2 class="font-serif text-2xl text-charcoal">More {{ $product->category->name ?? '' }} Products</h2>
    <div class="mt-6 grid grid-cols-2 gap-4 sm:grid-cols-3 lg:grid-cols-4">
        @foreach ($related as $item)
            <a href="/products/{{ $item->slug }}" class="group overflow-hidden rounded-xl border border-charcoal/8 bg-white shadow-sm hover:shadow-card"><div class="aspect-[4/3] overflow-hidden bg-beige"><img src="{{ $item->image }}" alt="{{ $item->name }}" loading="lazy" class="h-full w-full object-cover group-hover:scale-105 transition-transform"></div><div class="p-3"><p class="line-clamp-2 text-[13px] font-medium text-charcoal">{{ $item->name }}</p></div></a>
        @endforeach
    </div>
</section>
@endif
@endsection
