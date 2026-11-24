<?php

namespace App\Livewire\Admin;

use App\Models\Service;
use Livewire\Component;
use Livewire\WithFileUploads;

class ServiceManager extends Component
{
    use WithFileUploads;

    public string $search = '';
    public ?int $editingId = null;
    public string $name = '';
    public string $slug = '';
    public string $short_description = '';
    public string $description = '';
    public string $features = '';
    public string $image = '';
    public bool $active = true;
    public $photo = null;

    protected function rules(): array
    {
        return [
            'name' => 'required|string|max:160',
            'slug' => 'nullable|string|max:160|unique:services,slug,'.$this->editingId,
            'short_description' => 'nullable|string|max:500',
            'description' => 'nullable|string',
            'image' => 'nullable|string|max:255',
            'photo' => 'nullable|image|max:4096',
        ];
    }

    public function edit(int $id): void
    {
        $service = Service::findOrFail($id);
        $this->editingId = $service->id;
        $this->name = $service->name;
        $this->slug = $service->slug;
        $this->short_description = $service->short_description ?? '';
        $this->description = $service->description ?? '';
        $this->features = implode("\n", $service->features ?? []);
        $this->image = $service->image ?? '';
        $this->active = (bool) $service->active;
    }

    public function resetForm(): void
    {
        $this->reset(['editingId', 'name', 'slug', 'short_description', 'description', 'features', 'image', 'photo']);
        $this->active = true;
    }

    public function save(): void
    {
        $this->validate();

        if ($this->photo) {
            $this->image = '/storage/'.$this->photo->store('services', 'public');
        }

        Service::updateOrCreate(['id' => $this->editingId], [
            'name' => $this->name,
            'slug' => $this->slug ?: \Illuminate\Support\Str::slug($this->name),
            'short_description' => $this->short_description ?: null,
            'description' => $this->description ?: null,
            'features' => array_values(array_filter(array_map('trim', preg_split('/\r\n|\r|\n/', $this->features) ?: []))),
            'image' => $this->image ?: '/images/company-profile/page-02-image-01.png',
            'active' => $this->active,
        ]);

        session()->flash('message', $this->editingId ? 'Service updated.' : 'Service created.');
        $this->resetForm();
    }

    public function delete(int $id): void
    {
        Service::findOrFail($id)->delete();
        session()->flash('message', 'Service deleted.');
    }

    public function render()
    {
        return view('livewire.admin.service-manager', [
            'services' => Service::when($this->search, fn ($q) => $q->where('name', 'like', "%{$this->search}%"))
                ->orderBy('sort_order')->get(),
        ]);
    }
}
