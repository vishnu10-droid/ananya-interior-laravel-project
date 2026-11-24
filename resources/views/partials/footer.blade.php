@php
    $phone = \App\Models\Setting::get('phone', '+91 7351400063 / +91 90847 27055');
    $address = \App\Models\Setting::get('address', 'Mangal Sen Bhawan, 21/18, Freeganj Rd, Belanganj, Civil Lines, Agra, Uttar Pradesh 282003');
    $nav = [['/', 'Home'], ['/about', 'About'], ['/products', 'Products'], ['/brands', 'Brands'], ['/services', 'Services'], ['/contact', 'Contact']];
    $svc = [['/services/home-interiors', 'Home Interior'], ['/services/modular-kitchen', 'Modular Kitchen'], ['/services/bedroom', 'Bedroom'], ['/services/living-room', 'Living Room'], ['/services/office-interiors', 'Office Interior']];
    $socials = [
        ['Instagram', \App\Models\Setting::get('instagram_url', 'https://www.instagram.com/'), 'M7 2h10a5 5 0 0 1 5 5v10a5 5 0 0 1-5 5H7a5 5 0 0 1-5-5V7a5 5 0 0 1 5-5zm0 2a3 3 0 0 0-3 3v10a3 3 0 0 0 3 3h10a3 3 0 0 0 3-3V7a3 3 0 0 0-3-3H7z'],
        ['Facebook', \App\Models\Setting::get('facebook_url', 'https://www.facebook.com/'), 'M13.5 21v-8h2.7l.4-3.1h-3.1V7.9c0-.9.25-1.5 1.55-1.5H17V3.6c-.3-.04-1.3-.13-2.45-.13-2.43 0-4.1 1.48-4.1 4.2v2.23H7.75V13h2.7v8h3.05z'],
        ['YouTube', \App\Models\Setting::get('youtube_url', 'https://www.youtube.com/'), 'M21.6 7.2c-.24-.9-.94-1.6-1.83-1.84C18.25 5 12 5 12 5s-6.25 0-7.77.36c-.89.24-1.59.94-1.83 1.84C2 8.75 2 12 2 12s0 3.25.4 4.8c.24.9.94 1.6 1.83 1.84C5.75 19 12 19 12 19s6.25 0 7.77-.36c.89-.24 1.59-.94 1.83-1.84.4-1.55.4-4.8.4-4.8s0-3.25-.4-4.8zM10 15.5v-7l6 3.5-6 3.5z'],
        ['LinkedIn', \App\Models\Setting::get('linkedin_url', 'https://www.linkedin.com/'), 'M6.5 8.5H3V21h3.5V8.5zM4.75 3a2 2 0 1 0 0 4 2 2 0 0 0 0-4zM21 13.8c0-3-1.6-4.4-3.7-4.4-1.7 0-2.5.94-2.9 1.6V8.5H11V21h3.4v-6.6c0-1.75.9-2.8 2.3-2.8 1.3 0 1.9.95 1.9 2.8V21H21v-7.2z'],
    ];
@endphp

<footer class="relative overflow-hidden bg-espressodeep text-cream">
    <div class="pointer-events-none absolute inset-x-0 top-0 h-px bg-gradient-to-r from-transparent via-champagne/60 to-transparent"></div>
    <div class="mx-auto grid max-w-7xl grid-cols-1 gap-10 px-5 py-16 sm:grid-cols-2 lg:grid-cols-4 md:px-8">
        <div data-reveal="left">
            <a href="/" class="inline-flex items-center shrink-0"><img src="/assets/logo.png" alt="Ananya Interior Logo" class="h-16 w-16 rounded-xl bg-champagne/10 p-1 ring-1 ring-champagne/30"></a>
            <p class="mt-5 max-w-xs text-sm leading-relaxed text-cream/60">Premium residential and commercial interior design studio in Agra — modern, elegant and functional spaces.</p>
            <div class="mt-6 flex items-center gap-2.5">
                @foreach ($socials as [$label, $href, $path])
                    <a href="{{ $href }}" target="_blank" rel="noreferrer" aria-label="{{ $label }}" title="{{ $label }}" data-lift data-shine class="grid h-9 w-9 place-items-center rounded-full border border-white/15 text-cream/70 transition-all duration-300 hover:-translate-y-1 hover:border-champagne hover:bg-champagne/10 hover:text-champagne">
                        <svg viewBox="0 0 24 24" fill="currentColor" class="h-[15px] w-[15px]" aria-hidden="true"><path d="{{ $path }}"/></svg>
                    </a>
                @endforeach
            </div>
        </div>

        <div data-reveal="up" class="lg:border-l lg:border-white/10 lg:pl-8">
            <p class="text-[11px] font-medium uppercase tracking-[0.3em] text-champagne">Navigation</p>
            <ul class="mt-5 space-y-2.5 text-sm">
                @foreach ($nav as [$to, $label])<li><a href="{{ $to }}" class="text-cream/70 transition-colors hover:pl-1 hover:text-champagne">{{ $label }}</a></li>@endforeach
            </ul>
        </div>

        <div data-reveal="up" data-delay="80" class="lg:border-l lg:border-white/10 lg:pl-8">
            <p class="text-[11px] font-medium uppercase tracking-[0.3em] text-champagne">Services</p>
            <ul class="mt-5 space-y-2.5 text-sm">
                @foreach ($svc as [$to, $label])<li><a href="{{ $to }}" class="text-cream/70 transition-colors hover:pl-1 hover:text-champagne">{{ $label }}</a></li>@endforeach
            </ul>
        </div>

        <div data-reveal="right" class="lg:border-l lg:border-white/10 lg:pl-8">
            <p class="text-[11px] font-medium uppercase tracking-[0.3em] text-champagne">Contact</p>
            <ul class="mt-5 space-y-3.5 text-sm text-cream/70">
                @foreach (\App\Models\Setting::phones() as $phoneOption)
                    <li><a href="{{ $phoneOption['tel'] }}" class="flex items-center gap-2.5 transition-colors hover:text-champagne"><svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="shrink-0 text-champagne"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.13.96.36 1.9.7 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.91.34 1.85.57 2.81.7A2 2 0 0 1 22 16.92z"/></svg>{{ $phoneOption['label'] }}</a></li>
                @endforeach
                <li class="flex items-start gap-2.5"><svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="mt-0.5 shrink-0 text-champagne"><path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/><circle cx="12" cy="10" r="3"/></svg><span class="leading-relaxed">{{ $address }}</span></li>
                <li class="flex items-center gap-2.5"><svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="shrink-0 text-champagne"><circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/></svg>Open 24 Hours</li>
            </ul>
        </div>
    </div>
    <div class="relative border-t border-white/10 bg-black/10">
        <div class="mx-auto flex max-w-7xl flex-col items-center justify-between gap-3 px-5 py-6 text-xs text-cream/50 sm:flex-row md:px-8" data-reveal="up">
            <p>Copyright © 2026 Ananya Interior. All Rights Reserved.</p>
            <button type="button" data-scroll-top class="inline-flex items-center gap-2 rounded-full border border-white/15 px-4 py-2 transition-colors hover:border-champagne hover:text-champagne">Back to top <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="m18 15-6-6-6 6"/></svg></button>
        </div>
    </div>
</footer>
