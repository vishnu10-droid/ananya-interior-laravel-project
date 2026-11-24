<div class="space-y-5">
    @if (session()->has('message'))<div class="rounded-xl border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-700">{{ session('message') }}</div>@endif
    <div class="flex items-end justify-between"><div><h1 class="font-serif text-3xl">Testimonials</h1><p class="text-sm text-coffee">Only approved reviews appear on the website</p></div><button wire:click="resetForm" class="rounded-full bg-charcoal px-5 py-3 text-sm text-cream">+ Add Testimonial</button></div>
    <div class="grid gap-5 xl:grid-cols-[2fr_1fr]">
        <div class="space-y-3">@foreach ($testimonials as $t)<div class="rounded-xl border border-charcoal/5 bg-white p-5 shadow-card"><div class="flex items-start justify-between"><div><p class="font-serif text-lg">{{ $t->name }}</p><p class="text-xs text-coffee">{{ $t->designation }}</p></div><span class="text-gold">{{ str_repeat('★', $t->rating) }}</span></div><p class="mt-3 text-sm leading-relaxed text-coffee">{{ $t->review }}</p><div class="mt-4 flex gap-2"><button wire:click="toggle({{ $t->id }})" class="rounded-full border border-charcoal/15 px-4 py-2 text-xs">{{ $t->approved ? 'Hide' : 'Approve' }}</button><button wire:click="edit({{ $t->id }})" class="rounded-full border border-charcoal/15 px-4 py-2 text-xs">Edit</button><button wire:click="delete({{ $t->id }})" wire:confirm="Delete?" class="rounded-full border border-red-200 px-4 py-2 text-xs text-red-600">Delete</button></div></div>@endforeach</div>
        <form wire:submit="save" class="h-fit rounded-2xl bg-white p-6 shadow-card border border-charcoal/5 space-y-4">
            <h3 class="font-serif text-xl">{{ $editingId ? 'Edit Testimonial' : 'Add Testimonial' }}</h3>
            @error('name')<p class="text-xs text-red-600">{{ $message }}</p>@enderror
            <label class="block text-xs uppercase tracking-wider text-coffee">Name<input wire:model="name" class="mt-1.5 w-full rounded-xl border border-charcoal/10 bg-cream px-4 py-2.5 text-sm"></label>
            <div class="grid grid-cols-2 gap-3">
                <label class="block text-xs uppercase tracking-wider text-coffee">Designation / City<input wire:model="designation" class="mt-1.5 w-full rounded-xl border border-charcoal/10 bg-cream px-4 py-2.5 text-sm"></label>
                <label class="block text-xs uppercase tracking-wider text-coffee">Date<input wire:model="date" placeholder="Feb 2026" class="mt-1.5 w-full rounded-xl border border-charcoal/10 bg-cream px-4 py-2.5 text-sm"></label>
            </div>
            <label class="block text-xs uppercase tracking-wider text-coffee">Review<textarea wire:model="review" rows="4" class="mt-1.5 w-full rounded-xl border border-charcoal/10 bg-cream px-4 py-2.5 text-sm"></textarea></label>
            <label class="block text-xs uppercase tracking-wider text-coffee">Photo URL<input wire:model="image" class="mt-1.5 w-full rounded-xl border border-charcoal/10 bg-cream px-4 py-2.5 text-sm"></label>
            <label class="block text-xs uppercase tracking-wider text-coffee">Or upload photo<input type="file" wire:model="photo" class="mt-1.5 w-full text-xs"></label>
            <label class="block text-xs uppercase tracking-wider text-coffee">Rating<select wire:model="rating" class="mt-1.5 w-full rounded-xl border border-charcoal/10 bg-cream px-4 py-2.5 text-sm">@for ($i=1;$i<=5;$i++)<option value="{{ $i }}">{{ $i }} stars</option>@endfor</select></label>
            <label class="flex items-center gap-2 text-sm"><input type="checkbox" wire:model="approved" class="accent-gold"> Approved</label>
            <button type="submit" class="w-full rounded-full bg-charcoal py-3 text-sm text-cream">Save Testimonial</button>
        </form>
    </div>
</div>
