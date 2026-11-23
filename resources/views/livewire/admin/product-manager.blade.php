<div class="space-y-5">
    @if (session()->has('message'))<div class="rounded-xl border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-700">{{ session('message') }}</div>@endif

    <div class="flex flex-wrap items-end justify-between gap-3">
        <div><h1 class="font-serif text-3xl">Products</h1><p class="text-sm text-coffee">{{ $products->count() }} products in the catalogue</p></div>
        <button wire:click="resetForm" class="rounded-full bg-charcoal px-5 py-3 text-sm text-cream">+ Add New Product</button>
    </div>

    <div class="rounded-2xl bg-white p-5 shadow-card border border-charcoal/5">
        <input wire:model.live="search" placeholder="Search products…" class="w-full max-w-sm rounded-full border border-charcoal/10 bg-cream px-4 py-2.5 text-sm">
    </div>

    <div class="grid gap-5 xl:grid-cols-[2fr_1fr]">
        <div class="overflow-hidden rounded-2xl bg-white shadow-card border border-charcoal/5">
            <div class="overflow-x-auto"><table class="w-full min-w-[640px] text-left text-sm">
                <thead class="bg-cream text-[10px] uppercase tracking-[0.16em] text-coffee"><tr><th class="px-5 py-3">Product</th><th class="px-5 py-3">Category</th><th class="px-5 py-3">Status</th><th class="px-5 py-3"></th></tr></thead>
                <tbody class="divide-y divide-charcoal/5">
                    @foreach ($products as $product)
                        <tr class="hover:bg-cream/60">
                            <td class="px-5 py-3"><div class="flex items-center gap-3"><img src="{{ $product->image }}" alt="" class="h-10 w-10 rounded-lg object-cover"><span class="font-medium">{{ $product->name }}</span></div></td>
                            <td class="px-5 py-3 text-coffee">{{ $product->category->name ?? '—' }}</td>
                            <td class="px-5 py-3"><span class="rounded-full {{ $product->active ? 'bg-green-100 text-green-800' : 'bg-stone-200 text-stone-600' }} px-2.5 py-1 text-[11px]">{{ $product->active ? 'Active' : 'Inactive' }}</span></td>
                            <td class="px-5 py-3"><div class="flex gap-2"><button wire:click="edit({{ $product->id }})" class="rounded-lg border border-charcoal/15 px-3 py-2 text-xs hover:bg-beige">Edit</button><button wire:click="delete({{ $product->id }})" wire:confirm="Delete this product?" class="rounded-lg border border-red-200 px-3 py-2 text-xs text-red-600 hover:bg-red-50">Delete</button></div></td>
                        </tr>
                    @endforeach
                </tbody>
            </table></div>
        </div>

        <form wire:submit="save" class="h-fit rounded-2xl bg-white p-6 shadow-card border border-charcoal/5 space-y-4">
            <h3 class="font-serif text-xl">{{ $editingId ? 'Edit Product' : 'Add New Product' }}</h3>
            @error('name')<p class="text-xs text-red-600">{{ $message }}</p>@enderror
            <label class="block text-xs uppercase tracking-wider text-coffee">Name<input wire:model="name" class="mt-1.5 w-full rounded-xl border border-charcoal/10 bg-cream px-4 py-2.5 text-sm"></label>
            <label class="block text-xs uppercase tracking-wider text-coffee">Slug<input wire:model="slug" class="mt-1.5 w-full rounded-xl border border-charcoal/10 bg-cream px-4 py-2.5 text-sm"></label>
            @error('category_id')<p class="text-xs text-red-600">{{ $message }}</p>@enderror
            <label class="block text-xs uppercase tracking-wider text-coffee">Category<select wire:model="category_id" class="mt-1.5 w-full rounded-xl border border-charcoal/10 bg-cream px-4 py-2.5 text-sm"><option value="">Select…</option>@foreach ($categories as $category)<option value="{{ $category->id }}">{{ $category->name }}</option>@endforeach</select></label>
            <label class="block text-xs uppercase tracking-wider text-coffee">Brand<select wire:model="brand_id" class="mt-1.5 w-full rounded-xl border border-charcoal/10 bg-cream px-4 py-2.5 text-sm"><option value="">None</option>@foreach ($brands as $brand)<option value="{{ $brand->id }}">{{ $brand->name }}</option>@endforeach</select></label>
            <label class="block text-xs uppercase tracking-wider text-coffee">Short Description<textarea wire:model="short_description" rows="2" class="mt-1.5 w-full rounded-xl border border-charcoal/10 bg-cream px-4 py-2.5 text-sm"></textarea></label>
            <label class="block text-xs uppercase tracking-wider text-coffee">Description<textarea wire:model="description" rows="3" class="mt-1.5 w-full rounded-xl border border-charcoal/10 bg-cream px-4 py-2.5 text-sm"></textarea></label>
            <label class="block text-xs uppercase tracking-wider text-coffee">Image URL<input wire:model="image" class="mt-1.5 w-full rounded-xl border border-charcoal/10 bg-cream px-4 py-2.5 text-sm"></label>
            <label class="block text-xs uppercase tracking-wider text-coffee">Or upload image<input type="file" wire:model="photo" class="mt-1.5 w-full text-xs"></label>
            @error('photo')<p class="text-xs text-red-600">{{ $message }}</p>@enderror
            <div class="flex gap-5 text-sm"><label class="flex items-center gap-2"><input type="checkbox" wire:model="featured" class="accent-gold"> Featured</label><label class="flex items-center gap-2"><input type="checkbox" wire:model="active" class="accent-gold"> Active</label></div>
            <button type="submit" class="w-full rounded-full bg-charcoal py-3 text-sm text-cream">{{ $editingId ? 'Save Changes' : 'Create Product' }}</button>
        </form>
    </div>
</div>
