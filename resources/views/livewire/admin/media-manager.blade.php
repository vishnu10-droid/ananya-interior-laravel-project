<div class="space-y-5">
    @if (session()->has('message'))<div class="rounded-xl border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-700">{{ session('message') }}</div>@endif

    <div class="flex flex-wrap items-end justify-between gap-3">
        <div><h1 class="font-serif text-3xl">Gallery & Reels</h1><p class="text-sm text-coffee">Showcase photos and trending videos shown on the home page</p></div>
        <button wire:click="resetForm" class="rounded-full bg-charcoal px-5 py-3 text-sm text-cream">+ Add Item</button>
    </div>

    <div class="flex gap-2">
        @foreach (['showcase' => 'Showcase Images', 'reels' => 'Trending Reels', 'general' => 'General'] as $key => $label)
            <button wire:click="$set('folder', '{{ $key }}')" class="rounded-full px-4 py-2 text-sm {{ $folder === $key ? 'bg-charcoal text-cream' : 'border border-charcoal/15 bg-white' }}">{{ $label }}</button>
        @endforeach
    </div>

    <div class="grid gap-5 xl:grid-cols-[2fr_1fr]">
        <div class="grid grid-cols-2 gap-3 sm:grid-cols-3">
            @forelse ($items as $item)
                <div class="overflow-hidden rounded-xl border border-charcoal/5 bg-white shadow-card">
                    @if (str_starts_with((string) $item->mime_type, 'video'))
                        <video src="{{ $item->path }}" class="h-28 w-full bg-charcoal object-cover" muted></video>
                    @else
                        <img src="{{ $item->path }}" alt="{{ $item->title }}" class="h-28 w-full bg-beige object-cover">
                    @endif
                    <div class="p-3">
                        <p class="truncate text-sm font-medium">{{ $item->title ?: $item->alt_text }}</p>
                        <p class="truncate text-[10px] text-coffee">{{ $item->category ?: $item->folder }}</p>
                        <div class="mt-2 flex gap-2">
                            <button wire:click="edit({{ $item->id }})" class="text-xs text-golddark">Edit</button>
                            <button wire:click="delete({{ $item->id }})" wire:confirm="Delete this item?" class="text-xs text-red-600">Delete</button>
                        </div>
                    </div>
                </div>
            @empty
                <p class="col-span-full rounded-xl bg-white p-6 text-center text-sm text-coffee">Nothing here yet.</p>
            @endforelse
        </div>

        <form wire:submit="save" class="h-fit rounded-2xl bg-white p-6 shadow-card border border-charcoal/5 space-y-4">
            <h3 class="font-serif text-xl">{{ $editingId ? 'Edit Item' : 'Add New Item' }}</h3>
            @error('path')<p class="text-xs text-red-600">{{ $message }}</p>@enderror
            <label class="block text-xs uppercase tracking-wider text-coffee">Folder<select wire:model="folder" class="mt-1.5 w-full rounded-xl border border-charcoal/10 bg-cream px-4 py-2.5 text-sm"><option value="showcase">Showcase Images</option><option value="reels">Trending Reels</option><option value="general">General</option></select></label>
            <label class="block text-xs uppercase tracking-wider text-coffee">Title<input wire:model="title" class="mt-1.5 w-full rounded-xl border border-charcoal/10 bg-cream px-4 py-2.5 text-sm"></label>
            <label class="block text-xs uppercase tracking-wider text-coffee">Category<input wire:model="category" class="mt-1.5 w-full rounded-xl border border-charcoal/10 bg-cream px-4 py-2.5 text-sm"></label>
            <label class="block text-xs uppercase tracking-wider text-coffee">Alt text<input wire:model="alt_text" class="mt-1.5 w-full rounded-xl border border-charcoal/10 bg-cream px-4 py-2.5 text-sm"></label>
            <label class="block text-xs uppercase tracking-wider text-coffee">File URL<input wire:model="path" class="mt-1.5 w-full rounded-xl border border-charcoal/10 bg-cream px-4 py-2.5 text-sm"></label>
            <label class="block text-xs uppercase tracking-wider text-coffee">Or upload file<input type="file" wire:model="file" class="mt-1.5 w-full text-xs"></label>
            <label class="block text-xs uppercase tracking-wider text-coffee">Extra options (JSON, for reels)<textarea wire:model="meta" rows="3" placeholder='{"caption":null,"overlay":null,"tip":null}' class="mt-1.5 w-full rounded-xl border border-charcoal/10 bg-cream px-4 py-2.5 text-xs"></textarea></label>
            <button type="submit" class="w-full rounded-full bg-charcoal py-3 text-sm text-cream">{{ $editingId ? 'Save Changes' : 'Add Media' }}</button>
        </form>
    </div>
</div>
