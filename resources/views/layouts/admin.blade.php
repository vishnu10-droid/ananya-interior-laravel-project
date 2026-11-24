<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard') | Ananya Interior Admin</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,500;0,600;1,400&family=Jost:wght@300;400;500;600&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="bg-cream text-charcoal font-sans antialiased">
    <div data-scroll-progress></div>
@php
    $links = [
        ['dashboard', 'Dashboard', 'M3 12h18M3 6h18M3 18h18', 'admin.dashboard'],
        ['products', 'Products', 'M20 7 12 3 4 7l8 4 8-4Zm-16 0v10l8 4 8-4V7M12 11v10', 'admin.products'],
        ['categories', 'Categories', 'M4 4h6v6H4zM14 4h6v6h-6zM4 14h6v6H4zM14 14h6v6h-6z', 'admin.categories'],
        ['brands', 'Brands', 'M20 12 12 4 4 12l8 8 8-8ZM8 12l4-4 4 4-4 4-4-4Z', 'admin.brands'],
        ['services', 'Services', 'M4 6h16M4 12h16M4 18h10', 'admin.services'],
        ['projects', 'Projects', 'M3 21h18M5 21V7l7-4 7 4v14M9 21v-6h6v6', 'admin.projects'],
        ['media', 'Gallery & Reels', 'M4 5h16v14H4zM4 15l4-4 4 4 3-3 5 5', 'admin.media'],
        ['customers', 'Customers & Enquiries', 'M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2M9 11a4 4 0 1 0 0-8 4 4 0 0 0 0 8ZM22 21v-2a4 4 0 0 0-3-3.87M16 3.13a4 4 0 0 1 0 7.75', 'admin.customers'],
        ['testimonials', 'Testimonials', 'M12 17.27 18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21 12 17.27Z', 'admin.testimonials'],
        ['blogs', 'Blogs', 'M4 19.5A2.5 2.5 0 0 1 6.5 17H20M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2Z', 'admin.blogs'],
        ['analytics', 'Analytics & Report', 'M3 3v18h18M7 16v-5M12 16V7M17 16v-8', 'admin.analytics'],
        ['settings', 'Settings', 'M12 15a3 3 0 1 0 0-6 3 3 0 0 0 0 6ZM19.4 15a1.7 1.7 0 0 0 .34 1.88l.06.06a2 2 0 1 1-2.83 2.83l-.06-.06a1.7 1.7 0 0 0-1.88-.34 1.7 1.7 0 0 0-1 1.55V21a2 2 0 1 1-4 0v-.08a1.7 1.7 0 0 0-1.11-1.55 1.7 1.7 0 0 0-1.88.34l-.06.06a2 2 0 1 1-2.83-2.83l.06-.06A1.7 1.7 0 0 0 4.6 15a1.7 1.7 0 0 0-1.55-1H3a2 2 0 1 1 0-4h.08a1.7 1.7 0 0 0 1.55-1.11 1.7 1.7 0 0 0-.34-1.88l-.06-.06a2 2 0 1 1 2.83-2.83l.06.06A1.7 1.7 0 0 0 9 4.6a1.7 1.7 0 0 0 1-1.55V3a2 2 0 1 1 4 0v.08a1.7 1.7 0 0 0 1 1.55 1.7 1.7 0 0 0 1.88-.34l.06-.06a2 2 0 1 1 2.83 2.83l-.06.06a1.7 1.7 0 0 0-.34 1.88V9a1.7 1.7 0 0 0 1.55 1H21a2 2 0 1 1 0 4h-.08a1.7 1.7 0 0 0-1.52 1Z', 'admin.settings'],
        ['users', 'Users & Admin Roles', 'M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2M9 11a4 4 0 1 0 0-8 4 4 0 0 0 0 8ZM22 21v-2a4 4 0 0 0-3-3.87M16 3.13a4 4 0 0 1 0 7.75', 'admin.users'],
    ];
@endphp

<div class="min-h-screen">
    <aside class="motion-in-left hidden lg:block fixed left-0 top-0 bottom-0 w-64 border-r border-charcoal/10 bg-white/80 backdrop-blur z-40" style="--d:.05s">
        <div class="flex flex-col h-full">
            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-6 h-[72px] border-b border-charcoal/10 text-left">
                <span class="w-10 h-10 rounded-lg bg-charcoal text-gold grid place-items-center font-serif text-lg">AF</span>
                <span><span class="block font-serif tracking-[0.15em] text-[15px] leading-tight">Ananya Interior</span><span class="block text-[10px] tracking-[0.3em] text-coffee">Admin Panel</span></span>
            </a>
            <nav class="flex-1 overflow-y-auto px-4 py-4 space-y-1">
                @foreach ($links as [$key, $label, $path, $route])
                    <a href="{{ route($route) }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm transition-colors {{ request()->routeIs($route) ? 'bg-charcoal text-cream shadow-card' : 'text-charcoal/70 hover:bg-beige' }}">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="{{ $path }}"/></svg>
                        <span class="font-medium">{{ $label }}</span>
                    </a>
                @endforeach
            </nav>
            <div class="p-4 border-t border-charcoal/10">
                <form method="POST" action="{{ route('admin.logout') }}">@csrf<button class="w-full flex items-center gap-3 px-4 py-3 rounded-xl text-sm text-red-700 bg-red-50 hover:bg-red-100 transition-colors"><svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4M16 17l5-5-5-5M21 12H9"/></svg> Logout</button></form>
            </div>
        </div>
    </aside>

    <div class="lg:pl-64">
        <header class="motion-in-up sticky top-0 z-30 border-b border-charcoal/10 bg-cream/85 backdrop-blur-xl" style="--d:.12s">
            <div class="flex items-center gap-3 px-4 md:px-8 h-[72px]">
                <a href="/" class="text-sm text-coffee hover:text-golddark">← Website</a>
                <div class="ml-auto flex items-center gap-3 text-sm">
                    <span class="hidden sm:block">{{ Auth::user()->name }} <span class="ml-1 rounded-full bg-gold/20 px-2 py-0.5 text-[10px] uppercase tracking-wider text-golddark">{{ Auth::user()->role }}</span></span>
                    <form method="POST" action="{{ route('admin.logout') }}">@csrf<button class="rounded-full border border-charcoal/15 bg-white px-4 py-2 text-xs hover:bg-beige lg:hidden">Logout</button></form>
                </div>
            </div>
        </header>
        <main class="motion-in-up p-4 md:p-8 max-w-7xl" style="--d:.18s">
            @yield('content')
        </main>
    </div>
</div>
@livewireScripts
@stack('scripts')
</body>
</html>
