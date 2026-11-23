<?php

namespace App\Livewire\Admin;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class UserManager extends Component
{
    public ?int $editingId = null;
    public string $name = '';
    public string $email = '';
    public string $password = '';
    public string $role = 'viewer';
    public bool $active = true;

    public function edit(int $id): void
    {
        $u = User::findOrFail($id);
        $this->editingId = $u->id;
        $this->name = $u->name;
        $this->email = $u->email;
        $this->role = $u->role;
        $this->active = (bool) $u->active;
    }

    public function resetForm(): void
    {
        $this->reset(['editingId', 'name', 'email', 'password']);
        $this->role = 'viewer';
        $this->active = true;
    }

    public function save(): void
    {
        $this->validate([
            'name' => 'required|string|max:120',
            'email' => 'required|email|unique:users,email,'.$this->editingId,
            'password' => 'nullable|string|min:8',
        ]);

        $data = [
            'name' => $this->name,
            'email' => $this->email,
            'role' => $this->role,
            'active' => $this->active,
        ];
        if ($this->password) {
            $data['password'] = Hash::make($this->password);
        }

        User::updateOrCreate(['id' => $this->editingId], $data);
        session()->flash('message', 'User saved.');
        $this->resetForm();
    }

    public function delete(int $id): void
    {
        if ($id === auth()->id()) {
            session()->flash('message', 'You cannot delete your own account.');
            return;
        }
        User::findOrFail($id)->delete();
        session()->flash('message', 'User removed.');
    }

    public function render()
    {
        return view('livewire.admin.user-manager', ['users' => User::orderBy('name')->get()]);
    }
}
