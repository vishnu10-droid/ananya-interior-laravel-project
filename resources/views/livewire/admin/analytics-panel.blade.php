<div class="space-y-5">
    <div><h1 class="font-serif text-3xl">Analytics & Report</h1><p class="text-sm text-coffee">Live figures from the MySQL database</p></div>
    <div class="grid gap-4 sm:grid-cols-2">
        <div class="rounded-2xl bg-white p-6 shadow-card"><p class="font-serif text-4xl">{{ $totals['enquiries'] }}</p><p class="mt-1 text-xs uppercase tracking-wider text-coffee">Total Enquiries</p></div>
        <div class="rounded-2xl bg-white p-6 shadow-card"><p class="font-serif text-4xl">{{ $totals['products'] }}</p><p class="mt-1 text-xs uppercase tracking-wider text-coffee">Total Products</p></div>
    </div>
    <div class="grid gap-5 lg:grid-cols-2">
        <div class="rounded-2xl bg-white p-6 shadow-card">
            <h3 class="font-serif text-lg">Enquiries by status</h3>
            <div class="mt-5 space-y-3">@foreach ($byStatus as $status => $total)<div class="flex items-center justify-between border-b border-charcoal/5 pb-2 text-sm"><span class="capitalize text-coffee">{{ str_replace('_', ' ', $status) }}</span><span class="font-medium">{{ $total }}</span></div>@endforeach</div>
        </div>
        <div class="rounded-2xl bg-white p-6 shadow-card">
            <h3 class="font-serif text-lg">Products by category</h3>
            <div class="mt-5 space-y-4">@php $max = max(1, $byCategory->max('products_count')); @endphp
                @foreach ($byCategory as $category)<div><div class="mb-1 flex justify-between text-xs"><span class="text-coffee">{{ $category->name }}</span><span>{{ $category->products_count }}</span></div><div class="h-2 rounded-full bg-beige"><div class="h-full rounded-full bg-gold" style="width: {{ ($category->products_count / $max) * 100 }}%"></div></div></div>@endforeach
            </div>
        </div>
    </div>
</div>
