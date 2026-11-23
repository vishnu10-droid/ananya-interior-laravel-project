@extends('layouts.app')
@section('title', 'Journal | Ananya Interior')
@section('content')
<div class="bg-[#F8F4EE] text-[#29231F]">
    <section class="relative h-[55vh] min-h-[420px] overflow-hidden bg-walnut">
        <img src="{{ \App\Models\Setting::get('image_hero', '/images/company-profile/page-01-image-01.png') }}" alt="Journal" class="absolute inset-0 h-full w-full object-cover opacity-50">
        <div class="absolute inset-0 bg-gradient-to-t from-walnut via-walnut/60 to-transparent"></div>
        <div class="relative mx-auto max-w-7xl px-5 pb-16 pt-40 text-cream md:px-8"><p class="text-[11px] font-semibold uppercase tracking-[0.32em] text-champagne">Our Journal</p><h1 class="mt-3 font-serif text-4xl md:text-5xl">Ideas &amp; Inspiration</h1></div>
    </section>

    <section id="journal-intro" class="px-5 pb-2 pt-8 text-center sm:pt-8">
        <p class="flex items-center justify-center gap-3 text-[10px] font-semibold uppercase tracking-[0.32em] text-[#A98548]"><span class="h-px w-10 bg-[#D9B87F]"></span>Our Journal<span class="h-px w-10 bg-[#D9B87F]"></span></p>
        <p class="mx-auto mt-3 max-w-xl text-[11px] leading-relaxed text-[#827467] sm:text-[12px]">Notes from our studio — practical thinking on materials, layouts and the details that make a space feel like yours.</p>
    </section>

    <section class="px-5 py-4 sm:px-8 sm:py-5">
        <div class="mx-auto grid max-w-[1240px] items-center gap-7 lg:grid-cols-[minmax(0,1.5fr)_minmax(0,1fr)]">
            @if ($blogs->first())
                @php $featured = $blogs->first(); @endphp
                <div class="group relative overflow-hidden rounded-xl shadow-card"><img src="{{ $featured->thumbnail }}" alt="{{ $featured->title }}" loading="lazy" class="aspect-[2.15/1] w-full object-cover transition-transform duration-700 group-hover:scale-105"><span class="absolute left-4 top-4 rounded-full bg-[#F8F4EE]/95 px-3 py-1.5 text-[9px] font-semibold uppercase tracking-[0.18em] text-[#8A6A16]">Featured</span></div>
                <div><p class="text-[10px] tracking-[0.1em] text-[#827467]">{{ $featured->published_at?->format('d M Y') }}</p><h3 class="mt-2 font-serif text-[22px] leading-[1.18] text-[#29231F]">{{ $featured->title }}</h3><p class="mt-2 text-[12px] leading-relaxed text-[#7A6C5E]">{{ $featured->meta_description }}</p><a href="#latest-articles" class="mt-4 inline-flex items-center gap-2.5 rounded-full bg-[#BD9254] px-5 py-2.5 text-[11px] font-semibold text-[#29231F]">Read Full Article</a></div>
            @endif
        </div>
    </section>

    <section id="latest-articles" class="scroll-mt-24 px-5 pb-6 pt-0 sm:px-8">
        <div class="mx-auto max-w-[1240px]">
            <h2 class="font-serif text-[27px] leading-tight text-[#29231F] sm:text-[31px]">Latest Articles</h2>
            <div class="mt-5 grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-4">
                @foreach ($blogs as $i => $blog)
                    <article class="group flex flex-1 flex-col overflow-hidden rounded-xl border border-[#E8DCCD] bg-white shadow-sm" data-reveal="up" data-delay="{{ ($i % 4) * 80 }}">
                        <img src="{{ $blog->thumbnail }}" alt="{{ $blog->title }}" loading="lazy" class="aspect-[2/1] w-full object-cover">
                        <div class="flex flex-1 flex-col p-3"><p class="text-[10px] text-[#827467]">{{ $blog->category }} · {{ $blog->published_at?->format('d M Y') }}</p><h3 class="mt-1.5 font-serif text-[14px] leading-snug text-[#29231F]">{{ $blog->title }}</h3><p class="mt-1.5 line-clamp-2 text-[10px] leading-relaxed text-[#7A6C5E]">{{ $blog->meta_description }}</p></div>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    <section class="relative overflow-hidden bg-[#30231C]">
        <div class="relative mx-auto grid max-w-[1240px] items-center gap-6 px-5 py-8 sm:px-8 sm:py-9 lg:grid-cols-[minmax(0,1fr)_auto] lg:pl-[26%]">
            <div><p class="text-[9px] font-semibold uppercase tracking-[0.32em] text-[#C9A76C]">Stay Inspired</p><h2 class="mt-2 font-serif text-[22px] leading-tight text-[#F8F4EE] sm:text-[27px]">Get Design Ideas in Your Inbox</h2><p class="mt-2 text-[11px] text-[#D8C8B6]">Join our newsletter for fresh articles, trend updates and material insights.</p></div>
            <form action="{{ route('contact.enquiry') }}" method="POST" class="flex w-full flex-col gap-2.5 sm:flex-row lg:w-auto">@csrf<input type="email" name="email" required placeholder="Enter your email" class="w-full rounded-full border border-white/20 bg-white px-5 py-3 text-[12px] sm:w-[260px]"><button class="inline-flex items-center justify-center gap-2.5 rounded-full bg-[#BD9254] px-5 py-3 text-[11px] font-semibold text-[#29231F]">Subscribe</button></form>
        </div>
    </section>
</div>
@endsection
