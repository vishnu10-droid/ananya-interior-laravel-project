@php
    $links = [
        ['to' => '/', 'label' => 'Home'],
        ['to' => '/about', 'label' => 'About'],
        ['to' => '/products', 'label' => 'Product'],
        ['to' => '/categories', 'label' => 'Category'],
        ['to' => '/blog', 'label' => 'Blog'],
        ['to' => '/contact', 'label' => 'Contact'],
    ];
    $isHome = request()->is('/');
@endphp

<header id="site-header" class="fixed top-0 inset-x-0 z-50 transition-all duration-500 {{ $isHome ? 'bg-transparent' : 'nav-solid' }}">
    <div class="max-w-[1440px] mx-auto px-4 md:px-6 h-[72px] flex items-center justify-between gap-2 lg:gap-4">
        <a href="/" class="flex items-center shrink-0" aria-label="Ananya Home">
            <img src="/assets/logo.png" alt="Ananya Logo" class="h-14 sm:h-14 object-contain">
        </a>

        <nav class="hidden lg:flex items-center gap-3 xl:gap-5">
            @foreach ($links as $link)
                <a href="{{ $link['to'] }}" class="nav-link relative text-[13px] tracking-[0.14em] uppercase transition-colors {{ request()->is(ltrim($link['to'], '/')) || ($link['to'] === '/' && $isHome) ? 'text-champagne after:absolute after:-bottom-1.5 after:left-1/2 after:h-[2px] after:w-5 after:-translate-x-1/2 after:rounded-full after:bg-champagne' : '' }}">
                    {{ $link['label'] }}
                </a>
            @endforeach

            <div class="group relative">
                <span class="nav-link flex cursor-pointer list-none items-center gap-1 text-[13px] tracking-[0.14em] uppercase transition-colors">
                    More
                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="transition-transform duration-300 group-hover:rotate-180"><path d="m6 9 6 6 6-6"/></svg>
                </span>
                <div class="invisible absolute right-0 top-full mt-4 w-40 rounded-2xl border border-charcoal/5 bg-white p-2 opacity-0 shadow-lift transition-all group-hover:visible group-hover:opacity-100">
                    <a href="/services" class="block rounded-xl px-4 py-2.5 text-sm text-charcoal/80 transition-colors hover:bg-beige hover:text-charcoal">Services</a>
                    <a href="/#projects" class="block rounded-xl px-4 py-2.5 text-sm text-charcoal/80 transition-colors hover:bg-beige hover:text-charcoal">Projects</a>
                    <a href="/brands" class="block rounded-xl px-4 py-2.5 text-sm text-charcoal/80 transition-colors hover:bg-beige hover:text-charcoal">Brands</a>
                </div>
            </div>
        </nav>

        <div class="flex items-center gap-1.5 sm:gap-2">
            <form action="/products" method="GET" class="relative hidden lg:block">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="pointer-events-none absolute left-3 top-1/2 -translate-y-1/2 text-stonewarm"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35"/></svg>
                <input type="search" name="q" placeholder="Search materials" aria-label="Search materials" class="w-36 rounded-full border border-charcoal/10 bg-white/90 py-2 pl-9 pr-3 text-[12px] text-charcoal placeholder:text-stonewarm xl:w-44">
            </form>

            <a href="/contact" class="hidden items-center gap-2 whitespace-nowrap bg-charcoal text-cream text-[12px] tracking-wide px-4 py-2.5 rounded-full hover:bg-espresso transition-colors lg:inline-flex xl:px-5">
                Get a Quote
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14m-6-6 6 6-6 6"/></svg>
            </a>

            <a href="/dashboard" title="Dashboard" aria-label="Open dashboard" class="w-10 h-10 rounded-full grid place-items-center border transition-colors border-charcoal/15 bg-white text-charcoal hover:bg-beige">
                <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="7" rx="1"/><rect x="14" y="3" width="7" height="7" rx="1"/><rect x="3" y="14" width="7" height="7" rx="1"/><rect x="14" y="14" width="7" height="7" rx="1"/></svg>
            </a>

            <button id="mobile-menu-open" aria-label="Open menu" aria-expanded="false" class="lg:hidden w-10 h-10 rounded-full grid place-items-center border border-charcoal/15 bg-white text-charcoal">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 6h16M4 12h16M4 18h16"/></svg>
            </button>
        </div>
    </div>
</header>

<div id="mobile-menu" class="fixed inset-0 z-[60] hidden lg:hidden">
    <div class="absolute inset-0 bg-charcoal/60 backdrop-blur-sm" data-close-menu></div>
    <aside data-drawer-panel class="absolute right-0 top-0 h-full w-[84%] max-w-sm bg-cream shadow-lift flex flex-col">
        <div class="flex items-center justify-between px-6 h-[72px] border-b border-charcoal/10">
            <a href="/" data-drawer-link class="flex items-center shrink-0"><img src="/assets/logo.png" alt="Ananya Logo" class="w-[110px] h-[55px] object-contain"></a>
            <button data-close-menu aria-label="Close menu" class="w-10 h-10 rounded-full grid place-items-center bg-white border border-charcoal/10">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 6 6 18M6 6l12 12"/></svg>
            </button>
        </div>
        <nav class="flex-1 overflow-y-auto px-6 py-6 flex flex-col gap-1">
            @foreach ($links as $link)
                <a href="{{ $link['to'] }}" data-drawer-link class="flex items-center justify-between py-3.5 border-b border-charcoal/10 font-serif text-[20px] {{ request()->is(ltrim($link['to'], '/')) || ($link['to'] === '/' && $isHome) ? 'text-champagne' : 'text-charcoal' }}">
                    {{ $link['label'] }}
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="opacity-40"><path d="M5 12h14m-6-6 6 6-6 6"/></svg>
                </a>
            @endforeach
            <div class="mt-4 flex flex-wrap gap-2">
                <a href="/services" data-drawer-link class="rounded-full border border-charcoal/10 bg-white px-4 py-2 text-xs tracking-wide text-coffee hover:border-gold hover:text-charcoal">Services</a>
                <a href="/brands" data-drawer-link class="rounded-full border border-charcoal/10 bg-white px-4 py-2 text-xs tracking-wide text-coffee hover:border-gold hover:text-charcoal">Brands</a>
            </div>
            <a href="/contact" data-drawer-link class="mt-4 flex items-center justify-center gap-2 rounded-xl bg-gold px-5 py-3.5 text-sm font-medium text-charcoal">Get a Quote <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14m-6-6 6 6-6 6"/></svg></a>
            <a href="/dashboard" data-drawer-link class="mt-5 flex items-center gap-3 rounded-xl bg-charcoal text-cream px-5 py-4 text-sm tracking-wide">Open Dashboard</a>
        </nav>
    </aside>
</div>
