<div class="space-y-5">
    @if (session()->has('message'))<div class="rounded-xl border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-700">{{ session('message') }}</div>@endif
    <div><h1 class="font-serif text-3xl">Website Settings</h1><p class="text-sm text-coffee">All values are stored in MySQL and used across the public website</p></div>
    <form wire:submit="save" class="space-y-5">
        @foreach ($groups as $group => $keys)
            <div class="rounded-2xl bg-white p-6 shadow-card border border-charcoal/5">
                <h3 class="font-serif text-xl">{{ $group }}</h3>
                <div class="mt-5 grid gap-4 md:grid-cols-2">
                    @foreach ($keys as $key)
                        <label class="block text-xs uppercase tracking-wider text-coffee">{{ str_replace('_', ' ', $key) }}
                            <input wire:model="values.{{ $key }}" value="{{ $values[$key] ?? '' }}" class="mt-1.5 w-full rounded-xl border border-charcoal/10 bg-cream px-4 py-2.5 text-sm normal-case tracking-normal">
                        </label>
                    @endforeach
                </div>
            </div>
        @endforeach
        <button type="submit" class="rounded-full bg-charcoal px-8 py-3 text-sm text-cream">Save Changes</button>
    </form>
</div>
