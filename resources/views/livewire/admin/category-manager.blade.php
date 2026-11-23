<div class="space-y-5">
    @if (session()->has('message'))<div class="rounded-xl border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-700">{{ session('message') }}</div>@endif
    <div class="flex items-end justify-between"><div><h1 class="font-serif text-3xl">Categories</h1><p class="text-sm text-coffee">Material families in the catalogue</p></div><button wire:click="resetForm" class="rounded-full bg-charcoal px-5 py-3 text-sm text-cream">+ Add Category</button></div>

    <div class="grid gap-5 xl:grid-cols-[2fr_1fr]">
        <div class="overflow-hidden rounded-2xl bg-white shadow-card border border-charcoal/5">
            <table class="w-full text-left text-sm"><thead class="bg-cream text-[10px] uppercase tracking-wider text-coffee"><tr><th class="px-5 py-3">Category</th><th class="px-5 py-3">Products</th><th class="px-5 py-3"></th></tr></thead>
                <tbody class="divide-y divide-charcoal/5">@foreach ($categories as $category)<tr><td class="px-5 py-3"><div class="flex items-center gap-3"><img src="{{ $category->image }}" alt="" class="h-10 w-10 rounded-lg object-cover"><span class="font-medium">{{ $category->name }}</span></div></td><td class="px-5 py-3 text-coffee">{{ $category->products()->count() }}</td><td class="px-5 py-3"><div class="flex gap-2"><button wire:click="edit({{ $category->id }})" class="rounded-lg border border-charcoal/15 px-3 py-2 text-xs">Edit</button><button wire:click="delete({{ $category->id }})" wire:confirm="Delete this category?" class="rounded-lg border border-red-200 px-3 py-2 text-xs text-red-600">Delete</button></div></td></tr>@endforeach</tbody>
            </table>
        </div>
        <form wire:submit="save" class="h-fit rounded-2xl bg-white p-6 shadow-card border border-charcoal/5 space-y-4">
            <h3 class="font-serif text-xl">{{ $editingId ? 'Edit Category' : 'Add New Category' }}</h3>
            @error('name')<p class="text-xs text-red-600">{{ $message }}</p>@enderror
            <label class="block text-xs uppercase tracking-wider text-coffee">Name<input wire:model="name" class="mt-1.5 w-full rounded-xl border border-charcoal/10 bg-cream px-4 py-2.5 text-sm"></label>
            <label class="block text-xs uppercase tracking-wider text-coffee">Slug<input wire:model="slug" class="mt-1.5 w-full rounded-xl border border-charcoal/10 bg-cream px-4 py-2.5 text-sm"></label>
            <label class="block text-xs uppercase tracking-wider text-coffee">Description<textarea wire:model="description" rows="3" class="mt-1.5 w-full rounded-xl border border-charcoal/10 bg-cream px-4 py-2.5 text-sm"></textarea></label>
            <label class="block text-xs uppercase tracking-wider text-coffee">Image URL<input wire:model="image" class="mt-1.5 w-full rounded-xl border border-charcoal/10 bg-cream px-4 py-2.5 text-sm"></label>
            <label class="block text-xs uppercase tracking-wider text-coffee">Or upload<input type="file" wire:model="photo" class="mt-1.5 w-full text-xs"></label>
            <label class="flex items-center gap-2 text-sm"><input type="checkbox" wire:model="status" class="accent-gold"> Active</label>
            <button type="submit" class="w-full rounded-full bg-charcoal py-3 text-sm text-cream">Save Category</button>
        </form>
    </div>
</div>
