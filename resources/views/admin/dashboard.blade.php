@extends('layouts.admin')
@section('title', 'Dashboard')
@section('content')
<div class="mb-6">
    <h1 class="motion-in-left font-serif text-3xl" style="--d:.1s">Welcome back, {{ explode(' ', Auth::user()->name)[0] }}</h1>
    <p class="motion-in-up mt-1 text-sm text-coffee" style="--d:.18s">Here is what is happening at Ananya Interior today.</p>
</div>

<div class="grid gap-4 sm:grid-cols-2 xl:grid-cols-4">
    @foreach ([
        ['Total Products', $stats['products'], 'M20 7 12 3 4 7l8 4 8-4Z'],
        ['Total Categories', $stats['categories'], 'M4 4h6v6H4zM14 4h6v6h-6zM4 14h6v6H4zM14 14h6v6h-6z'],
        ['Total Brands', $stats['brands'], 'M20 12 12 4 4 12l8 8 8-8Z'],
        ['Total Enquiries', $stats['enquiries'], 'M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2v10Z'],
        ['New Enquiries', $stats['new'], 'M12 5v14M5 12h14'],
        ['Pending Follow-ups', $stats['followups'], 'M12 8v4l3 2M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z'],
        ['Total Projects', $stats['projects'], 'M3 21h18M5 21V7l7-4 7 4v14'],
        ['Total Blogs', $stats['blogs'], 'M4 19.5A2.5 2.5 0 0 1 6.5 17H20'],
    ] as $card)
        <div class="rounded-2xl bg-white p-6 shadow-card border border-charcoal/5 transition-all duration-500 hover:-translate-y-1.5 hover:shadow-lift hover:border-gold/40" data-reveal="up" data-delay="{{ $loop->index * 70 }}" data-lift>
            <div class="flex items-center justify-between">
                <span class="w-10 h-10 rounded-xl bg-beige text-golddark grid place-items-center"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="{{ $card[2] }}"/></svg></span>
            </div>
            <p class="mt-4 font-serif text-4xl"><span data-count="{{ (int) $card[1] }}">{{ $card[1] }}</span></p>
            <p class="mt-1 text-xs uppercase tracking-[0.16em] text-coffee">{{ $card[0] }}</p>
        </div>
    @endforeach
</div>

<div class="mt-6 grid gap-5 lg:grid-cols-3">
    <div class="rounded-2xl bg-white p-6 shadow-card border border-charcoal/5 lg:col-span-2" data-reveal="left">
        <h3 class="font-serif text-lg">Enquiries overview</h3>
        @php $max = max(1, $chart->max('total')); @endphp
        <div class="mt-6 space-y-4">
            @forelse ($chart as $row)
                <div data-reveal="up" data-delay="{{ $loop->index * 60 }}">
                    <div class="mb-1.5 flex justify-between text-xs"><span class="text-coffee">{{ $row->label }}</span><span class="font-medium">{{ $row->total }}</span></div>
                    <div class="h-2 overflow-hidden rounded-full bg-beige"><div class="h-full rounded-full bg-gold transition-[width] duration-1000 ease-out" style="width: {{ ($row->total / $max) * 100 }}%"></div></div>
                </div>
            @empty
                <p class="py-8 text-center text-sm text-coffee">No enquiries yet.</p>
            @endforelse
        </div>
    </div>

    <div class="rounded-2xl bg-white p-6 shadow-card border border-charcoal/5" data-reveal="right" data-delay="100">
        <h3 class="font-serif text-lg">Popular categories</h3>
        <div class="mt-5 space-y-3">
            @foreach ($popularCategories as $category)
                <div class="flex items-center justify-between border-b border-charcoal/5 pb-2 text-sm">
                    <span class="text-coffee">{{ $category->name }}</span>
                    <span class="rounded-full bg-beige px-2 py-0.5 text-xs">{{ $category->products_count }}</span>
                </div>
            @endforeach
        </div>
    </div>
</div>

<div class="mt-6 grid gap-5 lg:grid-cols-2">
    <div class="rounded-2xl bg-white p-6 shadow-card border border-charcoal/5" data-reveal="right" data-delay="100">
        <div class="flex items-center justify-between"><h3 class="font-serif text-lg">Recent enquiries</h3><a href="{{ route('admin.customers') }}" class="text-xs text-golddark">View all →</a></div>
        <div class="mt-4 space-y-3">
            @forelse ($recentEnquiries as $enquiry)
                <div class="flex items-center justify-between rounded-xl border border-charcoal/5 p-3">
                    <div><p class="text-sm font-medium">{{ $enquiry->name }}</p><p class="text-xs text-coffee">{{ $enquiry->project_type ?: 'General enquiry' }}</p></div>
                    <span class="rounded-full bg-beige px-3 py-1 text-[10px] uppercase tracking-wider text-golddark">{{ str_replace('_', ' ', $enquiry->status) }}</span>
                </div>
            @empty
                <p class="py-6 text-center text-sm text-coffee">No enquiries yet.</p>
            @endforelse
        </div>
    </div>
    <div class="rounded-2xl bg-white p-6 shadow-card border border-charcoal/5" data-reveal="right" data-delay="100">
        <div class="flex items-center justify-between"><h3 class="font-serif text-lg">Recent projects</h3></div>
        <div class="mt-4 space-y-3">
            @foreach ($recentProjects as $project)
                <div class="flex items-center gap-3 rounded-xl border border-charcoal/5 p-2">
                    <img src="{{ $project->image }}" alt="" class="h-12 w-14 rounded-lg object-cover">
                    <div><p class="text-sm font-medium">{{ $project->title }}</p><p class="text-xs text-coffee">{{ $project->location }}</p></div>
                </div>
            @endforeach
        </div>
    </div>
</div>

<div class="mt-6 flex flex-wrap gap-3">
    <a href="{{ route('admin.products') }}" data-lift data-reveal="up" class="rounded-full bg-charcoal px-5 py-3 text-sm text-cream">Add Product</a>
    <a href="{{ route('admin.customers') }}" data-lift data-reveal="up" data-delay="70" class="rounded-full border border-charcoal/15 px-5 py-3 text-sm">View Enquiries</a>
    <a href="{{ route('admin.blogs') }}" data-lift data-reveal="up" data-delay="140" class="rounded-full border border-charcoal/15 px-5 py-3 text-sm">Write Blog</a>
</div>
@endsection
