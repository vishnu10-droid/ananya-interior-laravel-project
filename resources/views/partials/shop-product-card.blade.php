{{-- Exact ShopProductCard from the React reference site. Expects $card, $index, $compact. --}}
<article data-shop-card data-reveal="up" data-delay="{{ min(($index % 6) * 80, 300) }}" class="group w-full">
    <div class="overflow-hidden rounded-xl border border-charcoal/8 bg-white shadow-[0_2px_12px_rgba(28,25,23,0.05)] transition-all duration-300 hover:border-gold/40 hover:shadow-card">
        <div class="relative">
            <a href="/products/{{ $card['slug'] }}" class="block" aria-label="View {{ $card['name'] }}">
                <div class="relative aspect-square overflow-hidden bg-beige">
                    <img src="{{ $card['image'] }}" alt="{{ $card['name'] }}" loading="lazy" decoding="async" class="shop-front absolute inset-0 h-full w-full object-cover object-center">
                    <img src="{{ $card['image'] }}" alt="{{ $card['name'] }} — material detail" loading="lazy" decoding="async" aria-hidden="true" class="shop-hover absolute inset-0 h-full w-full object-cover object-center">
                    <span class="absolute left-2.5 top-2.5 rounded bg-white/95 px-2 py-1 text-[9px] font-semibold uppercase tracking-[0.14em] text-golddark shadow-sm">{{ $card['brands'][0] ?? 'Premium' }}</span>
                </div>
            </a>
        </div>
        <div class="relative p-3.5">
            <div class="absolute -top-10 right-2.5 flex gap-1.5">
                <button type="button" data-modal-open="saved-modal" aria-label="Add {{ $card['name'] }} to wishlist" title="Save to wishlist" class="grid h-8 w-8 place-items-center rounded-full bg-white/95 text-charcoal/60 shadow-sm transition-colors hover:text-[#C2564B]"><svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M20.8 4.6a5.5 5.5 0 0 0-7.8 0L12 5.7l-1-1.1a5.5 5.5 0 0 0-7.8 7.8l1.1 1L12 21l7.7-7.6 1.1-1a5.5 5.5 0 0 0 0-7.8Z"/></svg></button>
                <button type="button" data-modal-open="saved-modal" aria-label="Shortlist {{ $card['name'] }}" title="Add to shortlist" class="grid h-8 w-8 place-items-center rounded-full bg-white/95 text-charcoal/60 shadow-sm transition-colors hover:text-golddark"><svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M6 2h12v20l-6-4-6 4z"/></svg></button>
            </div>
            <p class="text-[9px] font-medium uppercase tracking-[0.18em] text-stonewarm">{{ $card['types'][0] ?? 'Interior Material' }}</p>
            <a href="/products/{{ $card['slug'] }}" class="mt-1 block"><h3 class="line-clamp-1 text-[13px] font-semibold text-charcoal transition-colors group-hover:text-golddark">{{ $card['name'] }}</h3></a>
            <p class="mt-1 line-clamp-1 text-[11px] text-coffee/70">by {{ $card['brands'][0] ?? 'Ananya Interior' }}</p>
            <div class="mt-2 flex items-center gap-2 border-t border-charcoal/5 pt-2">
                <span class="text-[12px] font-semibold text-charcoal">Price on request</span>
                <span class="text-[10px] text-stonewarm">&middot; MOQ 1</span>
            </div>
        </div>
    </div>
</article>
