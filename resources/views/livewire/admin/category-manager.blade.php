<div class="space-y-5">
    @if (session()->has('message'))<div class="rounded-xl border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-700">{{ session('message') }}</div>@endif
    <div class="flex items-end justify-between"><div><h1 class="font-serif text-3xl">Categories</h1><p class="text-sm text-coffee">Material families in the catalogue</p></div><button wire:click="resetForm" class="rounded-full bg-charcoal px-5 py-3 text-sm text-cream">+ Add Category</button></div>

    <div class="rounded-2xl bg-white p-5 shadow-card border border-charcoal/5">
        <input wire:model.live="search" placeholder="Search categories…" class="w-full max-w-sm rounded-full border border-charcoal/10 bg-cream px-4 py-2.5 text-sm">
    </div>

    <div class="grid gap-5 xl:grid-cols-[2fr_1fr]">
        <div class="overflow-hidden rounded-2xl bg-white shadow-card border border-charcoal/5">
            <table class="w-full text-left text-sm"><thead class="bg-cream text-[10px] uppercase tracking-wider text-coffee"><tr><th class="px-5 py-3">Category</th><th class="px-5 py-3">Group</th><th class="px-5 py-3">Products</th><th class="px-5 py-3"></th></tr></thead>
                <tbody class="divide-y divide-charcoal/5">@foreach ($categories as $category)<tr><td class="px-5 py-3"><div class="flex items-center gap-3"><img src="{{ $category->image }}" alt="" class="h-10 w-10 rounded-lg object-cover"><span class="font-medium">{{ $category->name }}</span>@if ($category->featured)<span class="rounded-full bg-gold/20 px-2 py-0.5 text-[9px] text-golddark">Featured</span>@endif</div></td><td class="px-5 py-3 text-coffee">{{ $category->group ?: '—' }}</td><td class="px-5 py-3 text-coffee">{{ $category->products()->count() }}</td><td class="px-5 py-3"><div class="flex gap-2"><button wire:click="edit({{ $category->id }})" class="rounded-lg border border-charcoal/15 px-3 py-2 text-xs">Edit</button><button wire:click="delete({{ $category->id }})" wire:confirm="Delete this category?" class="rounded-lg border border-red-200 px-3 py-2 text-xs text-red-600">Delete</button></div></td></tr>@endforeach</tbody>
            </table>
        </div>
        <form wire:submit="save" class="h-fit rounded-2xl bg-white p-6 shadow-card border border-charcoal/5 space-y-4">
            <h3 class="font-serif text-xl">{{ $editingId ? 'Edit Category' : 'Add New Category' }}</h3>
            @error('name')<p class="text-xs text-red-600">{{ $message }}</p>@enderror
            <label class="block text-xs uppercase tracking-wider text-coffee">Name<input wire:model="name" class="mt-1.5 w-full rounded-xl border border-charcoal/10 bg-cream px-4 py-2.5 text-sm"></label>
            <label class="block text-xs uppercase tracking-wider text-coffee">Slug<input wire:model="slug" class="mt-1.5 w-full rounded-xl border border-charcoal/10 bg-cream px-4 py-2.5 text-sm"></label>
            <label class="block text-xs uppercase tracking-wider text-coffee">Description<textarea wire:model="description" rows="3" class="mt-1.5 w-full rounded-xl border border-charcoal/10 bg-cream px-4 py-2.5 text-sm"></textarea></label>
            <div class="grid grid-cols-2 gap-3">
                <label class="block text-xs uppercase tracking-wider text-coffee">Shop filter group<input wire:model="group" placeholder="Boards & Laminates" class="mt-1.5 w-full rounded-xl border border-charcoal/10 bg-cream px-4 py-2.5 text-sm"></label>
                <label class="block text-xs uppercase tracking-wider text-coffee">PDF page<input wire:model="pdf_page" type="number" min="1" class="mt-1.5 w-full rounded-xl border border-charcoal/10 bg-cream px-4 py-2.5 text-sm"></label>
            </div>
            <div class="grid grid-cols-2 gap-3">
                <label class="block text-xs uppercase tracking-wider text-coffee">Card tag<input wire:model="tag" placeholder="The Foundation" class="mt-1.5 w-full rounded-xl border border-charcoal/10 bg-cream px-4 py-2.5 text-sm"></label>
                <label class="block text-xs uppercase tracking-wider text-coffee">Card note<input wire:model="note" placeholder="Strength beneath every finish" class="mt-1.5 w-full rounded-xl border border-charcoal/10 bg-cream px-4 py-2.5 text-sm"></label>
            </div>
            <label class="block text-xs uppercase tracking-wider text-coffee">Types <span class="normal-case tracking-normal">(one per line)</span><textarea wire:model="types" rows="3" class="mt-1.5 w-full rounded-xl border border-charcoal/10 bg-cream px-4 py-2.5 text-sm"></textarea></label>
            <label class="block text-xs uppercase tracking-wider text-coffee">Variants <span class="normal-case tracking-normal">(one per line)</span><textarea wire:model="variants" rows="2" class="mt-1.5 w-full rounded-xl border border-charcoal/10 bg-cream px-4 py-2.5 text-sm"></textarea></label>
            <label class="block text-xs uppercase tracking-wider text-coffee">Features <span class="normal-case tracking-normal">(one per line)</span><textarea wire:model="features" rows="2" class="mt-1.5 w-full rounded-xl border border-charcoal/10 bg-cream px-4 py-2.5 text-sm"></textarea></label>
            <label class="block text-xs uppercase tracking-wider text-coffee">Applications <span class="normal-case tracking-normal">(one per line)</span><textarea wire:model="applications" rows="2" class="mt-1.5 w-full rounded-xl border border-charcoal/10 bg-cream px-4 py-2.5 text-sm"></textarea></label>
            <label class="block text-xs uppercase tracking-wider text-coffee">Brands <span class="normal-case tracking-normal">(one per line)</span><textarea wire:model="brands" rows="2" class="mt-1.5 w-full rounded-xl border border-charcoal/10 bg-cream px-4 py-2.5 text-sm"></textarea></label>
            <label class="block text-xs uppercase tracking-wider text-coffee">Image URL<input wire:model="image" class="mt-1.5 w-full rounded-xl border border-charcoal/10 bg-cream px-4 py-2.5 text-sm"></label>
            <label class="block text-xs uppercase tracking-wider text-coffee">Hover image URL<input wire:model="hover_image" class="mt-1.5 w-full rounded-xl border border-charcoal/10 bg-cream px-4 py-2.5 text-sm"></label>
            <label class="block text-xs uppercase tracking-wider text-coffee">Or upload<input type="file" wire:model="photo" class="mt-1.5 w-full text-xs"></label>
            <div class="rounded-xl border border-gold/30 bg-beige/40 p-4 space-y-3">
                <p class="text-xs font-semibold uppercase tracking-wider text-golddark">Product page cards (after application)</p>
                <label class="block text-xs uppercase tracking-wider text-coffee">Card 1 caption<input wire:model="look_one_caption" placeholder="Warm wood ceiling and decking" class="mt-1.5 w-full rounded-xl border border-charcoal/10 bg-white px-4 py-2.5 text-sm"></label>
                <label class="block text-xs uppercase tracking-wider text-coffee">Card 1 image URL<input wire:model="look_one_image" class="mt-1.5 w-full rounded-xl border border-charcoal/10 bg-white px-4 py-2.5 text-sm"></label>
                <label class="block text-xs uppercase tracking-wider text-coffee">Or upload card 1 image<input type="file" wire:model="look_one_photo" class="mt-1.5 w-full text-xs"></label>
                @error('look_one_photo')<p class="text-xs text-red-600">{{ $message }}</p>@enderror
                <label class="block text-xs uppercase tracking-wider text-coffee">Card 2 caption<input wire:model="look_two_caption" placeholder="Fluted plywood panelling behind a counter" class="mt-1.5 w-full rounded-xl border border-charcoal/10 bg-white px-4 py-2.5 text-sm"></label>
                <label class="block text-xs uppercase tracking-wider text-coffee">Card 2 image URL<input wire:model="look_two_image" class="mt-1.5 w-full rounded-xl border border-charcoal/10 bg-white px-4 py-2.5 text-sm"></label>
                <label class="block text-xs uppercase tracking-wider text-coffee">Or upload card 2 image<input type="file" wire:model="look_two_photo" class="mt-1.5 w-full text-xs"></label>
                @error('look_two_photo')<p class="text-xs text-red-600">{{ $message }}</p>@enderror
            </div>
            <div class="flex gap-5 text-sm"><label class="flex items-center gap-2"><input type="checkbox" wire:model="featured" class="accent-gold"> Featured on home</label><label class="flex items-center gap-2"><input type="checkbox" wire:model="status" class="accent-gold"> Active</label></div>
            <button type="submit" class="w-full rounded-full bg-charcoal py-3 text-sm text-cream">Save Category</button>
        </form>
    </div>
</div>
