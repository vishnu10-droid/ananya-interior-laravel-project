@extends('layouts.app')
@section('title', 'Journal | Ananya Interior')
@section('description', 'Stories, design ideas and material guides from the Ananya Interior studio.')
@section('content')
@php
    /* Exact editorial imagery from the reference BlogExperience. */
    $heroImage       = 'https://images.unsplash.com/photo-1618221195710-dd6b41faaea6?q=80&w=800&auto=format&fit=crop';
    $featuredImage   = 'https://images.unsplash.com/photo-1616486338812-3dadae4b4ace?q=80&w=1200&auto=format&fit=crop';
    $newsletterImage = 'https://images.unsplash.com/photo-1600210492486-724fe5c67fb0?q=80&w=900&auto=format&fit=crop';

    /* The React filters map a post category onto several journal categories.
       The contract filter engine splits data-category on whitespace, so each
       post carries every slug it belongs to. */
    $filterFor = function ($category) {
        $value = strtolower(trim((string) $category));
        if (str_contains($value, 'trade') || str_contains($value, 'living')) {
            return 'design-ideas material-guides living-room materials';
        }
        if (str_contains($value, 'kitchen')) {
            return 'material-guides space-planning kitchen materials';
        }
        if (str_contains($value, 'bedroom')) {
            return 'design-ideas trends bedroom';
        }
        if (str_contains($value, 'workspace') || str_contains($value, 'office')) {
            return 'space-planning trends design-tips';
        }
        return 'design-ideas material-guides space-planning trends';
    };
@endphp

<div class="bg-[#F8F4EE] text-[#29231F]">

    {{-- 1. JOURNAL HERO --}}
    <section class="relative h-[230px] overflow-hidden bg-[#201A16] sm:h-[245px] lg:h-[260px]">
        <img src="{{ $heroImage }}" alt="Warm luxury living room" class="journal-zoom absolute inset-0 h-full w-full object-cover object-center">
        <div class="absolute inset-0 bg-gradient-to-r from-[#201A16]/95 via-[#201A16]/70 to-[#201A16]/5"></div>
        <div class="absolute inset-0 bg-gradient-to-t from-[#201A16]/50 via-transparent to-transparent"></div>
        <div class="relative mx-auto flex h-full max-w-[1240px] flex-col justify-center px-6 sm:px-10 lg:px-9">
            <div class="motion-in-up w-fit" style="--d:.06s">
                <span class="inline-flex items-center gap-2 rounded-full border border-[#BD9254]/70 px-3.5 py-1.5 text-[9px] font-medium uppercase tracking-[0.3em] text-[#D9B87F]"><span class="h-1.5 w-1.5 rounded-full bg-[#BD9254]"></span>Journal</span>
            </div>
            <div class="motion-in-up mt-4 max-w-2xl" style="--d:.18s">
                <h1 class="font-serif text-[34px] leading-[1.05] text-[#F8F4EE] sm:text-[44px] lg:text-[50px]">Ideas &amp; Inspiration</h1>
            </div>
            <div class="motion-in-up mt-3 max-w-md" style="--d:.3s">
                <p class="text-[12px] leading-relaxed text-[#E8DCCB]/85 sm:text-[13px]">Practical thinking on materials, layouts and the details that make a space feel like yours.</p>
            </div>
            <div class="motion-in-up mt-5" style="--d:.42s">
                <a href="#journal-intro" data-scroll-to="journal-intro" data-shine class="inline-flex items-center gap-2.5 rounded-full bg-[#BD9254] px-5 py-2.5 text-[11px] font-semibold text-[#29231F] transition-colors hover:bg-[#D0A867]">Explore Articles <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14m-6-6 6 6-6 6"/></svg></a>
            </div>
        </div>
    </section>

    {{-- 2. CATEGORY NAV STRIP --}}
    <nav class="border-b border-[#E4D6C4] bg-[#F2E9DE]" data-filter-group aria-label="Journal categories">
        <div class="no-scrollbar mx-auto flex max-w-[1240px] items-stretch overflow-x-auto px-3 sm:px-6 lg:px-9">
            @foreach ([
                ['Design Ideas', 'design-ideas', 'feather'],
                ['Material Guides', 'material-guides', 'layers'],
                ['Space Planning', 'space-planning', 'house'],
                ['Trends & Inspiration', 'trends', 'bulb'],
            ] as $i => $tab)
                <button type="button" data-filter="{{ $tab[1] }}" data-filter-target="latest-articles-grid" data-filter-label="{{ $tab[0] }}" data-filter-toggle class="group flex min-w-[170px] flex-1 items-center justify-center gap-2.5 whitespace-nowrap px-3 py-3.5 text-[11px] font-medium tracking-[0.06em] transition-colors sm:min-w-0 {{ $i > 0 ? 'border-l border-[#D5B98F]/70' : '' }} text-[#5C4C3C] hover:text-[#A98548]">
                    @if ($tab[2] === 'feather')
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="shrink-0 text-[#A98548]"><path d="M20.24 12.24a6 6 0 0 0-8.49-8.49L5 10.5V19h8.5z"/><path d="M16 8 2 22"/><path d="M17.5 15H9"/></svg>
                    @elseif ($tab[2] === 'layers')
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="shrink-0 text-[#A98548]"><path d="m12.83 2.18 8.58 3.9a1 1 0 0 1 0 1.83l-8.58 3.91a2 2 0 0 1-1.66 0L2.6 7.91a1 1 0 0 1 0-1.83z"/><path d="m22 12.18-8.51 3.91a2 2 0 0 1-1.66 0L2 11.18"/><path d="m22 17.65-8.51 3.91a2 2 0 0 1-1.66 0L2 16.65"/></svg>
                    @elseif ($tab[2] === 'house')
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="shrink-0 text-[#A98548]"><path d="m3 10 9-7 9 7v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><path d="M9 21v-6a2 2 0 0 1 2-2h2a2 2 0 0 1 2 2v6"/></svg>
                    @else
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="shrink-0 text-[#A98548]"><path d="M9 18h6"/><path d="M10 22h4"/><path d="M15.09 14c.18-.98.65-1.74 1.41-2.5A4.65 4.65 0 0 0 18 8 6 6 0 0 0 6 8c0 1 .23 2.23 1.5 3.5A4.61 4.61 0 0 1 8.91 14"/></svg>
                    @endif
                    {{ $tab[0] }}
                </button>
            @endforeach
        </div>
    </nav>

    {{-- 3. JOURNAL INTRO --}}
    <div id="journal-intro" class="scroll-mt-24">
        <section class="relative overflow-hidden bg-[#F8F4EE] px-5 pb-2 pt-7 text-center sm:pt-8">
            <div class="pointer-events-none absolute -right-6 -top-10 hidden h-60 w-60 opacity-70 sm:block soft-leaf-shadow">
                <svg width="190" height="190" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="0.6" class="absolute right-2 top-2 rotate-[28deg] text-[#C9B79E]/40"><path d="M11 20A7 7 0 0 1 9.8 6.1C15.5 5 17 4.48 19 2c1 2 2 4.18 2 8 0 5.5-4.78 10-10 10Z"/><path d="M2 21c0-3 1.85-5.36 5.08-6C9.5 14.52 12 13 13 12"/></svg>
            </div>
            <div class="mx-auto max-w-3xl" data-reveal="up">
                <p class="flex items-center justify-center gap-3 text-[10px] font-semibold uppercase tracking-[0.32em] text-[#A98548]"><span class="h-px w-10 bg-[#D9B87F]"></span>Our Journal<span class="h-px w-10 bg-[#D9B87F]"></span></p>
                <h2 class="mt-2 font-serif text-[29px] leading-tight text-[#29231F] sm:text-[36px]">Ideas &amp; Inspiration</h2>
                <div class="mx-auto mt-2 h-px w-16 bg-[#BD9254]"></div>
                <p class="mx-auto mt-3 max-w-xl text-[11px] leading-relaxed text-[#827467] sm:text-[12px]">Notes from our studio — practical thinking on materials, layouts and the details that make a space feel like yours.</p>
            </div>
        </section>
    </div>

    {{-- 4. FEATURED ARTICLE --}}
    @if ($featured = $blogs->first())
        <section class="bg-[#F8F4EE] px-5 py-4 sm:px-8 sm:py-5">
            <div class="mx-auto grid max-w-[1240px] items-center gap-7 lg:grid-cols-[minmax(0,1.5fr)_minmax(0,1fr)_minmax(0,0.8fr)] lg:gap-8">
                <div data-reveal="left">
                    <div class="group relative overflow-hidden rounded-xl shadow-card">
                        <img src="{{ $featuredImage }}" alt="{{ $featured->title }}" loading="lazy" class="aspect-[2.15/1] w-full object-cover object-center transition-transform duration-700 ease-out group-hover:scale-105">
                        <div class="pointer-events-none absolute inset-0 bg-gradient-to-r from-[#8A5A2B]/10 via-transparent to-transparent"></div>
                        <span class="absolute left-4 top-4 rounded-full bg-[#F8F4EE]/95 px-3 py-1.5 text-[9px] font-semibold uppercase tracking-[0.18em] text-[#8A6A16] shadow-sm">Featured</span>
                        <button type="button" data-modal-open="article-modal-{{ $featured->id }}" aria-label="Read {{ $featured->title }}" class="absolute bottom-4 right-4 grid h-10 w-10 place-items-center rounded-full bg-[#F8F4EE]/95 text-[#29231F] shadow-md transition-colors hover:bg-[#BD9254] hover:text-white"><svg width="15" height="15" viewBox="0 0 24 24" fill="currentColor"><path d="M8 5v14l11-7z"/></svg></button>
                    </div>
                </div>
                <div data-reveal="up">
                    <p class="flex items-center gap-2 text-[10px] tracking-[0.1em] text-[#827467]"><svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="text-[#A98548]"><rect x="3" y="5" width="18" height="16" rx="2"/><path d="M16 3v4M8 3v4M3 11h18"/></svg>{{ $featured->published_at?->format('d M Y') }}</p>
                    <h3 class="mt-2 font-serif text-[22px] leading-[1.18] text-[#29231F] sm:text-[25px]">{{ $featured->title }}</h3>
                    <p class="mt-2 max-w-sm text-[12px] leading-relaxed text-[#7A6C5E]">{{ $featured->meta_description }}</p>
                    <button type="button" data-modal-open="article-modal-{{ $featured->id }}" class="group/link mt-4 inline-flex items-center gap-2.5 rounded-full bg-[#BD9254] px-5 py-2.5 text-[11px] font-semibold text-[#29231F] transition-colors hover:bg-[#D0A867]">Read Full Article <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="transition-transform duration-300 group-hover/link:translate-x-1"><path d="M5 12h14m-6-6 6 6-6 6"/></svg></button>
                </div>
                <div data-reveal="right">
                    <div class="lg:border-l lg:border-[#D9B87F]/50 lg:pl-7">
                        <h3 class="font-serif text-[20px] text-[#29231F]">Categories</h3>
                        <div class="mt-3 space-y-1.5">
                            @foreach ([
                                ['Living Room', '12', 'living-room', 'sofa'],
                                ['Kitchen', '08', 'kitchen', 'pot'],
                                ['Bedroom', '10', 'bedroom', 'bed'],
                                ['Materials', '15', 'materials', 'layers'],
                                ['Design Tips', '09', 'design-tips', 'bulb'],
                            ] as $cat)
                                <button type="button" data-filter-jump="{{ $cat[2] }}" data-filter-label="{{ $cat[0] }}" data-scroll-to="latest-articles" class="flex w-full items-center gap-2.5 rounded-full border border-[#E8DCCD] bg-white px-3.5 py-1.5 text-left shadow-[0_4px_14px_-8px_rgba(41,35,31,0.25)] transition-all hover:-translate-y-0.5 hover:border-[#BD9254] hover:shadow-card">
                                    @if ($cat[3] === 'sofa')
                                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="shrink-0 text-[#A98548]"><path d="M20 9V6a2 2 0 0 0-2-2H6a2 2 0 0 0-2 2v3"/><path d="M2 11v5a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-5a2 2 0 0 0-4 0v2H6v-2a2 2 0 0 0-4 0Z"/><path d="M6 18v2M18 18v2"/></svg>
                                    @elseif ($cat[3] === 'pot')
                                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="shrink-0 text-[#A98548]"><path d="M2 12h20"/><path d="M20 12v6a3 3 0 0 1-3 3H7a3 3 0 0 1-3-3v-6"/><path d="M9 12V7a3 3 0 0 1 6 0v5"/><path d="M12 2v2"/></svg>
                                    @elseif ($cat[3] === 'bed')
                                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="shrink-0 text-[#A98548]"><path d="M2 20v-8a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v8"/><path d="M4 10V6a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v4"/><path d="M12 4v6M2 18h20"/></svg>
                                    @elseif ($cat[3] === 'layers')
                                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="shrink-0 text-[#A98548]"><path d="m12.83 2.18 8.58 3.9a1 1 0 0 1 0 1.83l-8.58 3.91a2 2 0 0 1-1.66 0L2.6 7.91a1 1 0 0 1 0-1.83z"/><path d="m22 12.18-8.51 3.91a2 2 0 0 1-1.66 0L2 11.18"/><path d="m22 17.65-8.51 3.91a2 2 0 0 1-1.66 0L2 16.65"/></svg>
                                    @else
                                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="shrink-0 text-[#A98548]"><path d="M9 18h6"/><path d="M10 22h4"/><path d="M15.09 14c.18-.98.65-1.74 1.41-2.5A4.65 4.65 0 0 0 18 8 6 6 0 0 0 6 8c0 1 .23 2.23 1.5 3.5A4.61 4.61 0 0 1 8.91 14"/></svg>
                                    @endif
                                    <span class="flex-1 text-[11px] font-medium text-[#5C4C3C]">{{ $cat[0] }}</span>
                                    <span class="text-[10px] tabular-nums text-[#A98548]">{{ $cat[1] }}</span>
                                </button>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif

    {{-- 5. LATEST ARTICLES --}}
    <section id="latest-articles" class="scroll-mt-24 bg-[#F8F4EE] px-5 pb-6 pt-0 sm:px-8">
        <div class="mx-auto max-w-[1240px]">
            <div class="mb-5 flex flex-wrap items-end justify-between gap-3">
                <div>
                    <h2 class="font-serif text-[27px] leading-tight text-[#29231F] sm:text-[31px]">Latest Articles</h2>
                    <p id="filter-status" class="mt-1 hidden text-[11px] text-[#827467]">Showing <strong id="filter-status-label" class="font-medium text-[#A98548]"></strong><button type="button" data-filter-jump="all" class="ml-2 underline hover:text-[#A98548]">Clear</button></p>
                </div>
                <button type="button" data-filter-jump="all" class="group/link inline-flex items-center gap-2 text-[11px] font-medium text-[#A98548] hover:text-[#8A6A16]">View All Articles <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="transition-transform duration-300 group-hover/link:translate-x-1"><path d="M5 12h14m-6-6 6 6-6 6"/></svg></button>
            </div>

            <div id="latest-articles-grid" class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-4">
                @foreach ($blogs as $i => $blog)
                    <article data-filter-item data-category="{{ $filterFor($blog->category) }}" data-reveal="{{ ['left', 'up', 'right', 'up'][$i % 4] }}" data-delay="{{ ($i % 4) * 80 }}" class="group flex h-full flex-col overflow-hidden rounded-xl border border-[#EDE3D6] bg-white shadow-card transition-all duration-300 hover:-translate-y-1 hover:shadow-lift">
                        <div class="relative overflow-hidden bg-[#EFE6DA]">
                            <img src="{{ $blog->thumbnail }}" alt="{{ $blog->title }}" loading="lazy" class="aspect-[2/1] w-full object-cover object-center transition-transform duration-700 ease-out group-hover:scale-110">
                            <span class="absolute left-3 top-3 rounded-full bg-[#F8F4EE]/95 px-2.5 py-1 text-[8px] font-semibold uppercase tracking-[0.16em] text-[#8A6A16] shadow-sm">{{ $blog->category }}</span>
                        </div>
                        <div class="flex flex-1 flex-col p-3">
                            <p class="flex items-center gap-1.5 text-[10px] text-[#827467]"><svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="text-[#A98548]"><rect x="3" y="5" width="18" height="16" rx="2"/><path d="M16 3v4M8 3v4M3 11h18"/></svg>{{ $blog->published_at?->format('d M Y') }}</p>
                            <h3 class="mt-1.5 font-serif text-[14px] leading-snug text-[#29231F] transition-colors group-hover:text-[#A98548]">{{ $blog->title }}</h3>
                            <p class="mt-1.5 line-clamp-2 text-[10px] leading-relaxed text-[#7A6C5E]">{{ $blog->meta_description }}</p>
                            <button type="button" data-modal-open="article-modal-{{ $blog->id }}" class="group/link mt-auto inline-flex items-center gap-1.5 pt-3 text-[10.5px] font-semibold text-[#A98548]">Read More <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="transition-transform duration-300 group-hover/link:translate-x-1"><path d="M5 12h14m-6-6 6 6-6 6"/></svg></button>
                        </div>
                    </article>
                @endforeach
            </div>
        </div>

        {{-- Hidden filter buttons: the pill engine drives these from the sidebar links. --}}
        <div hidden>
            <button type="button" id="filter-all" data-filter="all" data-filter-target="latest-articles-grid" data-filter-label=""></button>
            @foreach ([['living-room', 'Living Room'], ['kitchen', 'Kitchen'], ['bedroom', 'Bedroom'], ['materials', 'Materials'], ['design-tips', 'Design Tips']] as $hiddenFilter)
                <button type="button" data-filter="{{ $hiddenFilter[0] }}" data-filter-target="latest-articles-grid" data-filter-label="{{ $hiddenFilter[1] }}"></button>
            @endforeach
        </div>
    </section>

    {{-- 6. NEWSLETTER --}}
    <section class="relative overflow-hidden bg-[#30231C]">
        <div class="absolute inset-y-0 left-0 hidden w-[22%] sm:block">
            <img src="{{ $newsletterImage }}" alt="Warm interior details" loading="lazy" class="h-full w-full object-cover object-center">
            <div class="absolute inset-0 bg-gradient-to-r from-transparent via-[#30231C]/40 to-[#30231C]"></div>
        </div>
        <div class="relative mx-auto grid max-w-[1240px] items-center gap-6 px-5 py-7 sm:px-8 sm:py-9 lg:grid-cols-[minmax(0,1fr)_auto] lg:pl-[26%]">
            <div data-reveal="up">
                <p class="text-[9px] font-semibold uppercase tracking-[0.32em] text-[#C9A76C]">Stay Inspired</p>
                <h2 class="mt-2 font-serif text-[22px] leading-tight text-[#F8F4EE] sm:text-[27px]">Get Design Ideas in Your Inbox</h2>
                <p class="mt-2 text-[11px] text-[#D8C8B6]">Join our newsletter for fresh articles, trend updates and material insights.</p>
            </div>
            <form action="mailto:contact@ananyadesigns.com" method="get" enctype="text/plain" class="flex w-full flex-col gap-2.5 sm:flex-row lg:w-auto">
                <input type="email" name="email" required placeholder="Enter your email" aria-label="Email address" class="w-full rounded-full border border-white/20 bg-white px-5 py-3 text-[12px] text-[#29231F] placeholder:text-[#9A8B7E] sm:w-[260px]">
                <button type="submit" data-shine class="inline-flex items-center justify-center gap-2.5 rounded-full bg-[#BD9254] px-5 py-3 text-[11px] font-semibold text-[#29231F] transition-colors hover:bg-[#D0A867]">Subscribe <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14m-6-6 6 6-6 6"/></svg></button>
            </form>
        </div>
    </section>

    {{-- 7. ARTICLE DETAIL MODALS --}}
    @foreach ($blogs as $blog)
        <div data-modal id="article-modal-{{ $blog->id }}" hidden>
            <div class="modal-backdrop" data-modal-close></div>
            <div class="modal-panel mx-auto max-h-[88vh] max-w-4xl overflow-y-auto rounded-3xl bg-cream shadow-lift">
                <button type="button" data-modal-close aria-label="Close" class="sticky top-4 float-right z-10 mr-4 mt-4 grid h-10 w-10 place-items-center rounded-full bg-charcoal text-cream shadow-lg transition-transform hover:scale-105"><svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 6 6 18M6 6l12 12"/></svg></button>
                <img src="{{ $blog->thumbnail }}" alt="{{ $blog->title }}" class="max-h-[42vh] w-full object-cover">
                <div class="px-6 pb-8 pt-6 md:px-9">
                    <p class="flex items-center gap-2 text-[11px] tracking-[0.2em] uppercase text-[#A98548]"><svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="5" width="18" height="16" rx="2"/><path d="M16 3v4M8 3v4M3 11h18"/></svg>{{ $blog->published_at?->format('d M Y') }} &middot; {{ $blog->category }}</p>
                    <h3 class="mt-3 font-serif text-2xl text-[#29231F] md:text-3xl">{{ $blog->title }}</h3>
                    <p class="mt-4 text-[15px] leading-relaxed text-[#6B5B4C]">{{ $blog->content }}</p>
                    @if (!empty($blog->highlights))
                        <ul class="mt-6 grid gap-2.5 sm:grid-cols-2">
                            @foreach ($blog->highlights as $point)
                                <li class="flex items-center gap-2 text-sm text-[#29231F]/85">
                                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="shrink-0 text-[#A98548]"><circle cx="12" cy="12" r="9"/><path d="m8.5 12 2.5 2.5 4.5-5"/></svg>
                                    {{ $point }}
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>
        </div>
    @endforeach

</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    var status = document.getElementById('filter-status');
    var statusLabel = document.getElementById('filter-status-label');

    function setStatus(label) {
        if (!status || !statusLabel) return;
        statusLabel.textContent = label || '';
        status.classList.toggle('hidden', !label);
    }

    document.querySelectorAll('[data-scroll-to]').forEach(function (el) {
        el.addEventListener('click', function (event) {
            var target = document.getElementById(el.dataset.scrollTo);
            if (!target) return;
            event.preventDefault();
            target.scrollIntoView({ behavior: 'smooth', block: 'start' });
        });
    });

    // Sidebar "Categories" + "View All Articles" + "Clear" drive the pill engine.
    document.querySelectorAll('[data-filter-jump]').forEach(function (el) {
        el.addEventListener('click', function (event) {
            event.preventDefault();
            var pill = document.querySelector('[data-filter="' + el.dataset.filterJump + '"][data-filter-target="latest-articles-grid"]');
            if (pill) pill.click();
            setStatus(el.dataset.filterLabel || '');
        });
    });

    // Keep the "Showing …" indicator in sync with every journal filter pill.
    document.addEventListener('click', function (event) {
        var pill = event.target.closest('[data-filter][data-filter-target="latest-articles-grid"]');
        if (!pill) return;
        setStatus(pill.dataset.filter === 'all' ? '' : (pill.dataset.filterLabel || ''));
    });

    // React behaviour: clicking the active strip tab clears the filter.
    document.addEventListener('click', function (event) {
        var tab = event.target.closest('[data-filter-toggle]');
        if (!tab || !tab.classList.contains('is-active')) return;
        event.preventDefault();
        event.stopImmediatePropagation();
        var all = document.getElementById('filter-all');
        if (all) all.click();
        setStatus('');
    }, true);
});
</script>
@endsection
