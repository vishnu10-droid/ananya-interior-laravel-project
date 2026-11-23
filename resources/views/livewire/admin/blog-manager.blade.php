<div class="space-y-5">
    @if (session()->has('message'))<div class="rounded-xl border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-700">{{ session('message') }}</div>@endif
    <div class="flex items-end justify-between"><div><h1 class="font-serif text-3xl">Blogs</h1><p class="text-sm text-coffee">Journal articles and SEO metadata</p></div><button wire:click="resetForm" class="rounded-full bg-charcoal px-5 py-3 text-sm text-cream">+ Write Blog</button></div>
    <div class="grid gap-5 xl:grid-cols-[2fr_1fr]">
        <div class="space-y-3">@foreach ($blogs as $b)<div class="flex items-center gap-4 rounded-xl border border-charcoal/5 bg-white p-4 shadow-card"><img src="{{ $b->thumbnail }}" alt="" class="h-16 w-24 rounded-lg object-cover"><div class="min-w-0 flex-1"><p class="font-serif text-lg">{{ $b->title }}</p><p class="text-xs text-coffee">{{ $b->category }} · {{ $b->published_at?->format('d M Y') }} · {{ $b->published ? 'Published' : 'Draft' }}</p></div><div class="flex gap-2"><button wire:click="toggle({{ $b->id }})" class="text-xs text-golddark">{{ $b->published ? 'Unpublish' : 'Publish' }}</button><button wire:click="edit({{ $b->id }})" class="text-xs text-golddark">Edit</button><button wire:click="delete({{ $b->id }})" wire:confirm="Delete?" class="text-xs text-red-600">✕</button></div></div>@endforeach</div>
        <form wire:submit="save" class="h-fit rounded-2xl bg-white p-6 shadow-card border border-charcoal/5 space-y-4">
            <h3 class="font-serif text-xl">{{ $editingId ? 'Edit Blog' : 'Write Blog' }}</h3>
            @error('title')<p class="text-xs text-red-600">{{ $message }}</p>@enderror
            <label class="block text-xs uppercase tracking-wider text-coffee">Title<input wire:model="title" class="mt-1.5 w-full rounded-xl border border-charcoal/10 bg-cream px-4 py-2.5 text-sm"></label>
            <label class="block text-xs uppercase tracking-wider text-coffee">Slug<input wire:model="slug" class="mt-1.5 w-full rounded-xl border border-charcoal/10 bg-cream px-4 py-2.5 text-sm"></label>
            <label class="block text-xs uppercase tracking-wider text-coffee">Category<input wire:model="category" class="mt-1.5 w-full rounded-xl border border-charcoal/10 bg-cream px-4 py-2.5 text-sm"></label>
            <label class="block text-xs uppercase tracking-wider text-coffee">Content<textarea wire:model="content" rows="5" class="mt-1.5 w-full rounded-xl border border-charcoal/10 bg-cream px-4 py-2.5 text-sm"></textarea></label>
            <label class="block text-xs uppercase tracking-wider text-coffee">Meta description<textarea wire:model="meta_description" rows="2" class="mt-1.5 w-full rounded-xl border border-charcoal/10 bg-cream px-4 py-2.5 text-sm"></textarea></label>
            <label class="block text-xs uppercase tracking-wider text-coffee">Thumbnail URL<input wire:model="thumbnail" class="mt-1.5 w-full rounded-xl border border-charcoal/10 bg-cream px-4 py-2.5 text-sm"></label>
            <label class="block text-xs uppercase tracking-wider text-coffee">Or upload<input type="file" wire:model="photo" class="mt-1.5 w-full text-xs"></label>
            <label class="flex items-center gap-2 text-sm"><input type="checkbox" wire:model="published" class="accent-gold"> Published</label>
            <button type="submit" class="w-full rounded-full bg-charcoal py-3 text-sm text-cream">Save Blog</button>
        </form>
    </div>
</div>
