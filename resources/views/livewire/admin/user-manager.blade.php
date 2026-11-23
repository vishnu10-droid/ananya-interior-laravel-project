<div class="space-y-5">
    @if (session()->has('message'))<div class="rounded-xl border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-700">{{ session('message') }}</div>@endif
    <div class="flex items-end justify-between"><div><h1 class="font-serif text-3xl">Users & Admin Roles</h1><p class="text-sm text-coffee">Manage team access — Admin, Editor and Viewer</p></div><button wire:click="resetForm" class="rounded-full bg-charcoal px-5 py-3 text-sm text-cream">+ Add User</button></div>
    <div class="grid gap-5 xl:grid-cols-[2fr_1fr]">
        <div class="overflow-hidden rounded-2xl bg-white shadow-card border border-charcoal/5">
            <table class="w-full text-left text-sm"><thead class="bg-cream text-[10px] uppercase tracking-wider text-coffee"><tr><th class="px-5 py-3">Member</th><th class="px-5 py-3">Role</th><th class="px-5 py-3">Status</th><th class="px-5 py-3"></th></tr></thead>
                <tbody class="divide-y divide-charcoal/5">@foreach ($users as $user)<tr><td class="px-5 py-3"><div class="flex items-center gap-3"><span class="grid h-9 w-9 place-items-center rounded-full bg-beige font-serif text-golddark">{{ substr($user->name, 0, 1) }}</span><div><p class="font-medium">{{ $user->name }}</p><p class="text-xs text-coffee">{{ $user->email }}</p></div></div></td><td class="px-5 py-3"><span class="rounded-full bg-beige px-3 py-1 text-[11px] uppercase text-golddark">{{ $user->role }}</span></td><td class="px-5 py-3 text-xs {{ $user->active ? 'text-green-700' : 'text-red-600' }}">{{ $user->active ? 'Active' : 'Inactive' }}</td><td class="px-5 py-3"><div class="flex gap-2"><button wire:click="edit({{ $user->id }})" class="text-xs text-golddark">Edit</button><button wire:click="delete({{ $user->id }})" wire:confirm="Remove this user?" class="text-xs text-red-600">✕</button></div></td></tr>@endforeach</tbody>
            </table>
        </div>
        <form wire:submit="save" class="h-fit rounded-2xl bg-white p-6 shadow-card border border-charcoal/5 space-y-4">
            <h3 class="font-serif text-xl">{{ $editingId ? 'Edit User' : 'Add User' }}</h3>
            @error('email')<p class="text-xs text-red-600">{{ $message }}</p>@enderror
            <label class="block text-xs uppercase tracking-wider text-coffee">Name<input wire:model="name" class="mt-1.5 w-full rounded-xl border border-charcoal/10 bg-cream px-4 py-2.5 text-sm"></label>
            <label class="block text-xs uppercase tracking-wider text-coffee">Email<input wire:model="email" type="email" class="mt-1.5 w-full rounded-xl border border-charcoal/10 bg-cream px-4 py-2.5 text-sm"></label>
            <label class="block text-xs uppercase tracking-wider text-coffee">Password<input wire:model="password" type="password" class="mt-1.5 w-full rounded-xl border border-charcoal/10 bg-cream px-4 py-2.5 text-sm"></label>
            <label class="block text-xs uppercase tracking-wider text-coffee">Role<select wire:model="role" class="mt-1.5 w-full rounded-xl border border-charcoal/10 bg-cream px-4 py-2.5 text-sm"><option value="admin">Admin</option><option value="editor">Editor</option><option value="viewer">Viewer</option></select></label>
            <label class="flex items-center gap-2 text-sm"><input type="checkbox" wire:model="active" class="accent-gold"> Active</label>
            <button type="submit" class="w-full rounded-full bg-charcoal py-3 text-sm text-cream">Save User</button>
        </form>
    </div>
</div>
