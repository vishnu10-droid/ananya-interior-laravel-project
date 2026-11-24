<?php

namespace App\Livewire\Admin;

use App\Models\Brand;
use Livewire\Component;
use Livewire\WithFileUploads;

class BrandManager extends Component
{
    use WithFileUploads;

    public ?int $editingId = null;
    public string $name = '';
    public string $slug = '';
    public string $website_url = '';
    public string $description = '';
    public string $logo = '';
    public $photo = null;
    public bool $status = true;
    public bool $featured = false;

    public function edit(int $id): void
    {
        $b = Brand::findOrFail($id);
        $this->editingId = $b->id;
        $this->name = $b->name;
        $this->slug = $b->slug;
        $this->website_url = $b->website_url ?? '';
        $this->description = $b->description ?? '';
        $this->logo = $b->logo ?? '';
        $this->status = (bool) $b->status;
        $this->featured = (bool) $b->featured;
    }

    public function resetForm(): void
    {
        $this->reset(['editingId', 'name', 'slug', 'website_url', 'description', 'logo', 'photo']);
        $this->status = true;
        $this->featured = false;
    }

    public function save(): void
    {
        $this->validate([
            'name' => 'required|string|max:120',
            'slug' => 'nullable|string|max:120|unique:brands,slug,'.$this->editingId,
            'website_url' => 'nullable|url|max:255',
            'logo' => 'nullable|string|max:255',
            'photo' => 'nullable|image|max:4096',
        ]);

        if ($this->photo) {
            $this->logo = '/storage/'.$this->photo->store('brands', 'public');
        }

        Brand::updateOrCreate(['id' => $this->editingId], [
            'name' => $this->name,
            'slug' => $this->slug ?: \Illuminate\Support\Str::slug($this->name),
            'website_url' => $this->website_url ?: null,
            'description' => $this->description ?: null,
            'logo' => $this->logo ?: null,
            'status' => $this->status,
            'featured' => $this->featured,
        ]);

        session()->flash('message', 'Brand saved.');
        $this->resetForm();
    }

    public function delete(int $id): void
    {
        Brand::findOrFail($id)->delete();
        session()->flash('message', 'Brand deleted.');
    }

    public function render()
    {
        return view('livewire.admin.brand-manager', ['brands' => Brand::orderBy('sort_order')->get()]);
    }
}
