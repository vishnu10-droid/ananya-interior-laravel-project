<div class="space-y-5">
    @if (session()->has('message'))<div class="rounded-xl border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-700">{{ session('message') }}</div>@endif
    <div><h1 class="font-serif text-3xl">Customers & Enquiries</h1><p class="text-sm text-coffee">{{ $enquiries->count() }} enquiries · manage status, notes and follow-ups</p></div>

    <div class="flex flex-wrap gap-2">
        @foreach (['' => 'All', 'new' => 'New', 'contacted' => 'Contacted', 'in_progress' => 'In Progress', 'converted' => 'Converted', 'closed' => 'Closed'] as $value => $label)
            <button wire:click="$set('status', '{{ $value }}')" class="rounded-full px-4 py-2 text-xs {{ $status === $value ? 'bg-charcoal text-cream' : 'border border-charcoal/10 bg-white text-coffee' }}">{{ $label }}</button>
        @endforeach
        <input wire:model.live="search" placeholder="Search name or phone…" class="ml-auto w-full max-w-xs rounded-full border border-charcoal/10 bg-white px-4 py-2 text-sm">
    </div>

    <div class="grid gap-5 xl:grid-cols-[1.3fr_1fr]">
        <div class="overflow-hidden rounded-2xl bg-white shadow-card border border-charcoal/5">
            <table class="w-full min-w-[560px] text-left text-sm"><thead class="bg-cream text-[10px] uppercase tracking-wider text-coffee"><tr><th class="px-5 py-3">Customer</th><th class="px-5 py-3">Interest</th><th class="px-5 py-3">Status</th><th class="px-5 py-3"></th></tr></thead>
                <tbody class="divide-y divide-charcoal/5">@foreach ($enquiries as $e)<tr class="hover:bg-cream/60 {{ $selectedId === $e->id ? 'bg-cream' : '' }}">
                    <td class="px-5 py-3"><button wire:click="select({{ $e->id }})" class="text-left"><p class="font-medium">{{ $e->name }}</p><p class="text-xs text-coffee">{{ $e->phone }}</p></button></td>
                    <td class="px-5 py-3 text-coffee">{{ $e->project_type ?: 'General' }}</td>
                    <td class="px-5 py-3"><span class="rounded-full bg-beige px-2.5 py-1 text-[10px] uppercase text-golddark">{{ str_replace('_', ' ', $e->status) }}</span></td>
                    <td class="px-5 py-3"><button wire:click="delete({{ $e->id }})" wire:confirm="Delete this enquiry?" class="text-red-600">✕</button></td>
                </tr>@endforeach</tbody>
            </table>
        </div>

        @if ($selected)
            <div class="h-fit space-y-4 rounded-2xl bg-white p-6 shadow-card border border-charcoal/5">
                <h3 class="font-serif text-xl">{{ $selected->name }}</h3>
                <p class="text-sm text-coffee">{{ $selected->phone }} @if ($selected->email)· {{ $selected->email }}@endif</p>
                <div class="rounded-xl bg-cream p-4 text-sm text-coffee"><p><span class="font-medium text-charcoal">Project:</span> {{ $selected->project_type ?: '—' }}</p><p><span class="font-medium text-charcoal">Profession:</span> {{ $selected->profession ?: '—' }}</p><p><span class="font-medium text-charcoal">Location:</span> {{ trim(($selected->city ?? '').' '.($selected->area ?? '').' '.($selected->pincode ?? '')) ?: '—' }}</p><p class="mt-2">{{ $selected->message }}</p></div>
                <div class="flex flex-wrap gap-2">
                    <a href="tel:{{ preg_replace('/[^0-9+]/', '', $selected->phone) }}" class="rounded-full bg-charcoal px-4 py-2 text-xs text-cream">Call</a>
                    <a href="{{ \App\Models\Setting::get('whatsapp', '#') }}" target="_blank" rel="noreferrer" class="rounded-full bg-green-600 px-4 py-2 text-xs text-white">WhatsApp</a>
                </div>
                <form wire:submit="updateEnquiry" class="grid gap-3 border-t border-charcoal/10 pt-4">
                    <label class="text-xs uppercase tracking-wider text-coffee">Status<select wire:model="newStatus" class="mt-1 w-full rounded-xl border border-charcoal/10 bg-cream px-4 py-2.5 text-sm">@foreach (['new','contacted','in_progress','converted','closed'] as $s)<option value="{{ $s }}">{{ str_replace('_',' ',$s) }}</option>@endforeach</select></label>
                    <label class="text-xs uppercase tracking-wider text-coffee">Assign to<select wire:model="assignedTo" class="mt-1 w-full rounded-xl border border-charcoal/10 bg-cream px-4 py-2.5 text-sm"><option value="">Unassigned</option>@foreach ($users as $user)<option value="{{ $user->id }}">{{ $user->name }}</option>@endforeach</select></label>
                    <label class="text-xs uppercase tracking-wider text-coffee">Follow-up date<input type="datetime-local" wire:model="followUpAt" class="mt-1 w-full rounded-xl border border-charcoal/10 bg-cream px-4 py-2.5 text-sm"></label>
                    <button class="rounded-full bg-charcoal py-2.5 text-sm text-cream">Update Enquiry</button>
                </form>
                <div class="border-t border-charcoal/10 pt-4">
                    <p class="text-xs uppercase tracking-wider text-coffee">Internal notes</p>
                    @foreach ($selected->notes as $note)<p class="mt-2 rounded-lg bg-cream p-3 text-sm text-coffee">{{ $note->note }} <span class="text-[10px] text-stonewarm">— {{ $note->user->name ?? 'System' }}</span></p>@endforeach
                    <form wire:submit="addNote" class="mt-3 flex gap-2"><input wire:model="note" placeholder="Add a note…" class="flex-1 rounded-full border border-charcoal/10 px-4 py-2 text-sm"><button class="rounded-full bg-gold px-4 py-2 text-xs text-charcoal">Add</button></form>
                </div>
            </div>
        @endif
    </div>
</div>
