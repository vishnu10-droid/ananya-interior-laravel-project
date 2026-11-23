<?php

namespace App\Livewire\Admin;

use App\Models\Category;
use Livewire\Component;
use Livewire\WithFileUploads;

class CategoryManager extends Component
{
    use WithFileUploads;

    public ?int $editingId = null;
    public string $name = '';
    public string $slug = '';
    public string $description = '';
    public string $image = '';
    public bool $status = true;
    public $photo = null;

    public function edit(int $id): void
    {
        $c = Category::findOrFail($id);
        $this->editingId = $c->id;
        $this->name = $c->name;
        $this->slug = $c->slug;
        $this->description = $c->description ?? '';
        $this->image = $c->image ?? '';
        $this->status = (bool) $c->status;
    }

    public function resetForm(): void
    {
        $this->reset(['editingId', 'name', 'slug', 'description', 'image', 'photo']);
        $this->status = true;
    }

    public function save(): void
    {
        $this->validate([
            'name' => 'required|string|max:120',
            'slug' => 'nullable|string|max:120|unique:categories,slug,'.$this->editingId,
            'description' => 'nullable|string',
            'image' => 'nullable|string|max:255',
            'photo' => 'nullable|image|max:4096',
        ]);

        if ($this->photo) {
            $this->image = $this->photo->store('categories', 'public');
        }

        Category::updateOrCreate(['id' => $this->editingId], [
            'name' => $this->name,
            'slug' => $this->slug ?: \Illuminate\Support\Str::slug($this->name),
            'description' => $this->description ?: null,
            'image' => $this->image ?: '/images/company-profile/page-06-image-01.png',
            'status' => $this->status,
        ]);

        session()->flash('message', 'Category saved.');
        $this->resetForm();
    }

    public function delete(int $id): void
    {
        Category::findOrFail($id)->delete();
        session()->flash('message', 'Category deleted.');
    }

    public function render()
    {
        return view('livewire.admin.category-manager', ['categories' => Category::orderBy('sort_order')->get()]);
    }
}
