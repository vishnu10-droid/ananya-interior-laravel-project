@extends('layouts.app')
@section('title', $service->name.' | Ananya Interior')
@section('content')
<section class="relative h-[60vh] min-h-[440px] overflow-hidden bg-charcoal">
    <img src="{{ $service->image }}" alt="{{ $service->name }}" class="absolute inset-0 h-full w-full object-cover opacity-60">
    <div class="absolute inset-0 bg-gradient-to-t from-charcoal via-charcoal/60 to-charcoal/20"></div>
    <div class="relative mx-auto max-w-7xl px-5 pb-16 pt-40 text-cream md:px-8">
        <a href="/services" class="text-xs text-cream/70 hover:text-gold">← Back to services</a>
        <h1 class="mt-5 font-serif text-4xl leading-tight md:text-6xl">{{ $service->name }}</h1>
        <p class="mt-4 max-w-2xl text-sm leading-relaxed text-cream/75">{{ $service->short_description }}</p>
    </div>
</section>
<section class="mx-auto max-w-7xl px-5 py-16 md:px-8">
    <p class="text-sm leading-[1.9] text-coffee">{{ $service->description }}</p>
    @if ($service->features)
        <div class="mt-10 grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
            @foreach ($service->features as $feature)
                <div class="rounded-xl border border-gold/25 bg-white p-5 text-sm text-charcoal shadow-card">✓ {{ $feature }}</div>
            @endforeach
        </div>
    @endif
    <div class="mt-12"><a href="/contact" class="inline-flex items-center gap-2 rounded-full bg-charcoal px-7 py-3.5 text-sm text-cream">Send Enquiry <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14m-6-6 6 6-6 6"/></svg></a></div>
</section>
@endsection
