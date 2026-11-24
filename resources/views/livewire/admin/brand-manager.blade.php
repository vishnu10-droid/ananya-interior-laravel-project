<div class="space-y-5">
    @if (session()->has('message'))<div class="rounded-xl border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-700">{{ session('message') }}</div>@endif
    <div class="flex items-end justify-between"><div><h1 class="font-serif text-3xl">Brands</h1><p class="text-sm text-coffee">Trusted brand partners</p></div><button wire:click="resetForm" class="rounded-full bg-charcoal px-5 py-3 text-sm text-cream">+ Add Brand</button></div>
    <div class="grid gap-5 xl:grid-cols-[2fr_1fr]">
        <div class="grid grid-cols-2 gap-3 sm:grid-cols-3">@foreach ($brands as $brand)<div class="flex items-center gap-3 rounded-xl border border-charcoal/5 bg-white p-4 shadow-card"><div class="grid h-10 w-10 shrink-0 place-items-center overflow-hidden rounded-lg bg-beige">@if ($brand->logo)<img src="{{ $brand->logo }}" alt="" class="h-full w-full object-contain">@else<span class="font-serif text-xs text-golddark">{{ substr($brand->name, 0, 2) }}</span>@endif</div><div class="min-w-0 flex-1"><p class="truncate text-sm font-medium">{{ $brand->name }}</p><p class="text-[10px] text-coffee">{{ $brand->products()->count() }} products</p></div><div class="flex gap-1"><button wire:click="edit({{ $brand->id }})" class="text-xs text-golddark">Edit</button><button wire:click="delete({{ $brand->id }})" wire:confirm="Delete?" class="text-xs text-red-600">✕</button></div></div>@endforeach</div>
        <form wire:submit="save" class="h-fit rounded-2xl bg-white p-6 shadow-card border border-charcoal/5 space-y-4">
            <h3 class="font-serif text-xl">{{ $editingId ? 'Edit Brand' : 'Add New Brand' }}</h3>
            @error('name')<p class="text-xs text-red-600">{{ $message }}</p>@enderror
            <label class="block text-xs uppercase tracking-wider text-coffee">Name<input wire:model="name" class="mt-1.5 w-full rounded-xl border border-charcoal/10 bg-cream px-4 py-2.5 text-sm"></label>
            <label class="block text-xs uppercase tracking-wider text-coffee">Slug<input wire:model="slug" class="mt-1.5 w-full rounded-xl border border-charcoal/10 bg-cream px-4 py-2.5 text-sm"></label>
            <label class="block text-xs uppercase tracking-wider text-coffee">Website<input wire:model="website_url" class="mt-1.5 w-full rounded-xl border border-charcoal/10 bg-cream px-4 py-2.5 text-sm"></label>
            <label class="block text-xs uppercase tracking-wider text-coffee">Description<textarea wire:model="description" rows="2" class="mt-1.5 w-full rounded-xl border border-charcoal/10 bg-cream px-4 py-2.5 text-sm"></textarea></label>
            <label class="block text-xs uppercase tracking-wider text-coffee">Logo URL<input wire:model="logo" class="mt-1.5 w-full rounded-xl border border-charcoal/10 bg-cream px-4 py-2.5 text-sm"></label>
            <label class="block text-xs uppercase tracking-wider text-coffee">Or upload logo<input type="file" wire:model="photo" class="mt-1.5 w-full text-xs"></label>
            <div class="flex gap-5 text-sm"><label class="flex items-center gap-2"><input type="checkbox" wire:model="featured" class="accent-gold"> Featured logo</label><label class="flex items-center gap-2"><input type="checkbox" wire:model="status" class="accent-gold"> Active</label></div>
            <button type="submit" class="w-full rounded-full bg-charcoal py-3 text-sm text-cream">Save Brand</button>
        </form>
    </div>
</div>
