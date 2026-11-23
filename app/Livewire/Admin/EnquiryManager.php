<?php

namespace App\Livewire\Admin;

use App\Models\Enquiry;
use App\Models\User;
use Livewire\Component;

class EnquiryManager extends Component
{
    public string $search = '';
    public string $status = '';
    public ?int $selectedId = null;
    public string $note = '';
    public string $newStatus = '';
    public $followUpAt = null;
    public $assignedTo = '';

    public function select(int $id): void
    {
        $enquiry = Enquiry::with('notes')->findOrFail($id);
        $this->selectedId = $enquiry->id;
        $this->newStatus = $enquiry->status;
        $this->followUpAt = $enquiry->follow_up_at?->format('Y-m-d\TH:i');
        $this->assignedTo = $enquiry->assigned_to ?? '';
    }

    public function updateEnquiry(): void
    {
        $enquiry = Enquiry::findOrFail($this->selectedId);
        $enquiry->update([
            'status' => $this->newStatus,
            'assigned_to' => $this->assignedTo ?: null,
            'follow_up_at' => $this->followUpAt ?: null,
        ]);
        session()->flash('message', 'Enquiry updated.');
    }

    public function addNote(): void
    {
        $this->validate(['note' => 'required|string']);
        Enquiry::findOrFail($this->selectedId)->notes()->create([
            'user_id' => auth()->id(),
            'note' => $this->note,
        ]);
        $this->note = '';
        session()->flash('message', 'Note added.');
    }

    public function delete(int $id): void
    {
        Enquiry::findOrFail($id)->delete();
        if ($this->selectedId === $id) {
            $this->selectedId = null;
        }
        session()->flash('message', 'Enquiry deleted.');
    }

    public function render()
    {
        $enquiries = Enquiry::when($this->status, fn ($q) => $q->where('status', $this->status))
            ->when($this->search, fn ($q) => $q->where(function ($q) {
                $q->where('name', 'like', "%{$this->search}%")
                    ->orWhere('phone', 'like', "%{$this->search}%");
            }))
            ->latest()
            ->get();

        return view('livewire.admin.enquiry-manager', [
            'enquiries' => $enquiries,
            'selected' => $this->selectedId ? Enquiry::with('notes')->find($this->selectedId) : null,
            'users' => User::orderBy('name')->get(),
        ]);
    }
}
