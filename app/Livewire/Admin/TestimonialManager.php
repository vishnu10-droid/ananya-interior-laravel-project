<?php

namespace App\Livewire\Admin;

use App\Models\Testimonial;
use Livewire\Component;

class TestimonialManager extends Component
{
    public ?int $editingId = null;
    public string $name = '';
    public string $designation = '';
    public string $review = '';
    public int $rating = 5;
    public bool $approved = true;

    public function edit(int $id): void
    {
        $t = Testimonial::findOrFail($id);
        $this->editingId = $t->id;
        $this->name = $t->name;
        $this->designation = $t->designation ?? '';
        $this->review = $t->review;
        $this->rating = $t->rating;
        $this->approved = (bool) $t->approved;
    }

    public function resetForm(): void
    {
        $this->reset(['editingId', 'name', 'designation', 'review']);
        $this->rating = 5;
        $this->approved = true;
    }

    public function save(): void
    {
        $this->validate(['name' => 'required|string|max:120', 'review' => 'required|string', 'rating' => 'required|integer|min:1|max:5']);
        Testimonial::updateOrCreate(['id' => $this->editingId], [
            'name' => $this->name,
            'designation' => $this->designation ?: null,
            'review' => $this->review,
            'rating' => $this->rating,
            'approved' => $this->approved,
        ]);
        session()->flash('message', 'Testimonial saved.');
        $this->resetForm();
    }

    public function toggle(int $id): void
    {
        $t = Testimonial::findOrFail($id);
        $t->update(['approved' => ! $t->approved]);
    }

    public function delete(int $id): void
    {
        Testimonial::findOrFail($id)->delete();
        session()->flash('message', 'Testimonial deleted.');
    }

    public function render()
    {
        return view('livewire.admin.testimonial-manager', ['testimonials' => Testimonial::latest()->get()]);
    }
}
