{{-- Exact FilterPanel from CategoryShowcase.jsx. Expects $category, $availableBrands, $viewAll, $brandFilter, $categorySlug. --}}
<div class="rounded-xl border border-[#E6DCCB] bg-white p-4 shadow-sm">
    <div class="flex items-center justify-between">
        <h3 class="flex items-center gap-2 font-serif text-[17px] text-[#3A2A1B]">
            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="#B58A22" stroke-width="2"><path d="M4 6h16M7 12h10m-7 6h4"/></svg>
            Filter By
        </h3>
        <a href="/categories/{{ $categorySlug }}" class="text-[10px] font-medium text-[#B58A22] hover:underline">Clear All</a>
    </div>

    <div data-accordion class="border-b border-[#E6DCCB] py-3">
        <button type="button" data-accordion-trigger aria-expanded="true" class="flex w-full items-center justify-between text-[12px] font-semibold text-[#3A2A1B]">
            Brand
            <svg data-accordion-icon width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#B58A22" stroke-width="2"><path d="m6 9 6 6 6-6"/></svg>
        </button>
        <div data-accordion-panel class="overflow-hidden" style="max-height: 260px; opacity: 1;">
            <div class="max-h-60 space-y-2 overflow-y-auto pr-1 pt-3">
                <label class="flex cursor-pointer items-center gap-2 text-[11px] font-semibold text-[#3A2A1B]">
                    <input type="radio" name="brand-filter" value="" data-brand-href="/categories/{{ $categorySlug }}?viewall=1" class="h-3.5 w-3.5 accent-[#B58A22]" @if ($viewAll) checked @endif> All Brands
                </label>
                @foreach ($availableBrands as $brand)
                    <label class="flex cursor-pointer items-center gap-2 text-[11px] text-[#5A4A38]">
                        <input type="radio" name="brand-filter" value="{{ $brand }}" data-brand-href="/categories/{{ $categorySlug }}?brand={{ rawurlencode($brand) }}" class="h-3.5 w-3.5 accent-[#B58A22]" @if (! $viewAll && $brandFilter === $brand) checked @endif> {{ $brand }}
                    </label>
                @endforeach
            </div>
        </div>
    </div>

    @foreach (array_slice($category['types'] ?? [], 0, 4) as $type)
        <div data-accordion class="border-b border-[#E6DCCB] py-3">
            <button type="button" data-accordion-trigger aria-expanded="false" class="flex w-full items-center justify-between text-[12px] font-semibold text-[#3A2A1B]">
                {{ $type }}
                <svg data-accordion-icon width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#B58A22" stroke-width="2"><path d="m6 9 6 6 6-6"/></svg>
            </button>
            <div data-accordion-panel class="overflow-hidden" style="max-height: 0; opacity: 0;">
                <p class="pt-3 text-[11px] text-[#7A6A56]">Available in {{ $category['name'] }}.</p>
            </div>
        </div>
    @endforeach

    <div data-accordion class="border-b border-[#E6DCCB] py-3">
        <button type="button" data-accordion-trigger aria-expanded="false" class="flex w-full items-center justify-between text-[12px] font-semibold text-[#3A2A1B]">
            Availability
            <svg data-accordion-icon width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#B58A22" stroke-width="2"><path d="m6 9 6 6 6-6"/></svg>
        </button>
        <div data-accordion-panel class="overflow-hidden" style="max-height: 0; opacity: 0;">
            <p class="pt-3 text-[11px] text-[#7A6A56]">In stock &mdash; ready to enquire.</p>
        </div>
    </div>

    <div class="mt-4 overflow-hidden rounded-xl bg-[#24160D] p-4 text-[#F7EEDF]">
        <img src="/images/company-profile/page-25-image-01.png" alt="Plywood boards" class="mb-3 h-16 w-full rounded-lg object-cover">
        <p class="font-serif text-[15px] leading-snug">Need Project Quantity?</p>
        <p class="mt-1 text-[10px] text-[#D9CBB4]">Get exclusive pricing and expert assistance.</p>
        <a href="/contact" class="mt-3 inline-flex items-center gap-1.5 rounded-full bg-[#D9B45B] px-3 py-2 text-[10px] font-semibold text-[#24160D]">Talk to an Expert <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14m-6-6 6 6-6 6"/></svg></a>
    </div>
</div>
