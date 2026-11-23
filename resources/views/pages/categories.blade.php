@extends('layouts.app')
@section('title', ($active->name ?? 'Categories').' | Ananya Interior')
@section('content')
<section class="relative overflow-hidden bg-[#1C1109] text-[#F7EEDF]">
    <div class="absolute inset-0 bg-gradient-to-r from-[#1C1109] via-[#1C1109]/85 to-[#1C1109]/10"></div>
    <img src="{{ $active->image ?? '' }}" alt="{{ $active->name ?? 'Materials' }}" class="absolute right-0 top-0 h-full w-1/2 object-cover opacity-40">
    <div class="relative mx-auto max-w-7xl px-5 py-14 md:px-8">
        <p class="text-[10px] text-[#CDBB9E]"><a href="/" class="hover:text-[#D9B45B]">Home</a> › <a href="/products" class="hover:text-[#D9B45B]">Products</a> › {{ $active->name ?? 'Categories' }}</p>
        <div class="mt-4 grid items-center gap-6 lg:grid-cols-[0.92fr_1.08fr]">
            <div><p class="text-[10px] font-medium uppercase tracking-[0.28em] text-[#D9B45B]">Premium Wood Materials</p><h1 class="mt-3 font-serif text-[38px] leading-[1.02] sm:text-[46px]">{{ $active->name ?? 'All Categories' }}</h1><p class="mt-3 max-w-md text-[12px] leading-relaxed text-[#D9CBB4]">{{ $active->description ?? 'Explore our complete range of interior and exterior materials.' }}</p><a href="#catalogue-grid" class="mt-5 inline-flex items-center gap-2 rounded-full bg-[#D9B45B] px-5 py-2.5 text-[11px] font-semibold text-[#24160D]">Explore Collection</a></div>
        </div>
    </div>
</section>

<section class="bg-[#F8F4ED] px-4 py-8 md:px-8">
    <div class="mx-auto max-w-[1600px]">
        <div class="mb-5 flex items-end justify-between"><div><p class="text-[10px] font-semibold uppercase tracking-[0.28em] text-[#B58A22]">Product range</p><h2 class="mt-1 font-serif text-xl text-[#3A2A1B] sm:text-2xl">Explore by category</h2></div><a href="/products" class="rounded-full border border-[#D9B45B]/60 bg-white px-4 py-2 text-[11px] font-semibold uppercase tracking-[0.12em] text-[#8A6A16]">View All</a></div>
        <div class="grid grid-cols-2 gap-3 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6">
            @foreach ($categories as $i => $category)
                <a href="/categories/{{ $category->slug }}" class="group flex h-[250px] flex-col overflow-hidden rounded-xl border bg-white text-left shadow-sm transition-all hover:-translate-y-1 hover:shadow-lg {{ $category->id === ($active->id ?? null) ? 'border-[#D9B45B] ring-1 ring-[#D9B45B]/50' : 'border-[#E3D8C7]' }}" data-reveal="up" data-delay="{{ ($i % 6) * 90 }}">
                    <div class="flex h-[188px] shrink-0 items-center justify-center overflow-hidden bg-[#EFE6D9]"><div class="h-[160px] w-[112px] overflow-hidden rounded-md"><img src="{{ $category->image }}" alt="{{ $category->name }}" loading="lazy" class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-110"></div></div>
                    <div class="flex flex-1 items-center px-3"><p class="line-clamp-2 text-[11px] font-semibold leading-tight {{ $category->id === ($active->id ?? null) ? 'text-[#8A6A16]' : 'text-[#3A2A1B] group-hover:text-[#8A6A16]' }}">{{ $category->name }}</p></div>
                </a>
            @endforeach
        </div>
    </div>
</section>

<section id="catalogue-grid" class="mx-auto max-w-[1600px] scroll-mt-20 px-4 py-6 sm:px-8">
    <p class="text-[12px] text-[#6B5A45]">Showing <strong>{{ $products->count() }}</strong> Products</p>
    <div class="mt-6 grid grid-cols-2 gap-3 sm:grid-cols-3 md:grid-cols-4 xl:grid-cols-5">
        @foreach ($products as $i => $product)
            <a href="/products/{{ $product->slug }}" class="group flex h-[440px] flex-col overflow-hidden rounded-2xl border border-[#B68B4D]/30 bg-[#F8F5EF] text-[#30251E] shadow-card transition-all hover:-translate-y-1 hover:shadow-lift" data-reveal="up" data-delay="{{ ($i % 5) * 60 }}">
                <div class="relative h-[52%] overflow-hidden bg-[#EDE5D9]"><img src="{{ $product->image }}" alt="{{ $product->name }}" loading="lazy" class="h-full w-full object-cover transition-transform duration-700 group-hover:scale-110"><span class="absolute left-3 top-3 rounded-full bg-[#F8F5EF]/95 px-3 py-1 text-[10px] font-semibold uppercase text-[#8A6A16]">{{ $product->category->name ?? '' }}</span></div>
                <div class="flex flex-1 flex-col p-4"><h3 class="font-serif text-[18px] leading-tight">{{ $product->name }}</h3><p class="mt-2 line-clamp-2 text-[11px] text-[#6B5A45]">{{ $product->short_description }}</p><span class="mt-auto inline-flex items-center gap-1 text-[9px] font-semibold uppercase text-[#8A6A16]">Explore Details</span></div>
            </a>
        @endforeach
    </div>
    @if ($products->isEmpty())<div class="rounded-xl border border-[#E6DCCB] bg-white py-16 text-center text-coffee">No products in this category yet.</div>@endif
</section>
@endsection
