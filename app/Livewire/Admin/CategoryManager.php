<?php

namespace App\Livewire\Admin;

use App\Models\Category;
use Livewire\Component;
use Livewire\WithFileUploads;

class CategoryManager extends Component
{
    use WithFileUploads;

    public string $search = '';
    public ?int $editingId = null;
    public string $name = '';
    public string $slug = '';
    public string $description = '';
    public string $types = '';
    public string $features = '';
    public string $applications = '';
    public string $variants = '';
    public string $brands = '';
    public string $group = '';
    public string $tag = '';
    public string $note = '';
    public string $pdf_page = '';
    public string $image = '';
    public string $hover_image = '';
    public bool $featured = false;
    public bool $status = true;
    public $photo = null;
    public string $look_one_image = '';
    public string $look_one_caption = '';
    public string $look_two_image = '';
    public string $look_two_caption = '';
    public $look_one_photo = null;
    public $look_two_photo = null;

    public function edit(int $id): void
    {
        $c = Category::findOrFail($id);
        $this->editingId = $c->id;
        $this->name = $c->name;
        $this->slug = $c->slug;
        $this->description = $c->description ?? '';
        $this->types = $this->lines($c->types);
        $this->features = $this->lines($c->features);
        $this->applications = $this->lines($c->applications);
        $this->variants = $this->lines($c->variants);
        $this->brands = $this->lines($c->brands);
        $this->group = $c->group ?? '';
        $this->tag = $c->tag ?? '';
        $this->note = $c->note ?? '';
        $this->pdf_page = (string) ($c->pdf_page ?? '');
        $this->image = $c->image ?? '';
        $this->hover_image = $c->hover_image ?? '';
        $this->featured = (bool) $c->featured;
        $this->status = (bool) $c->status;
        $this->look_one_image = $c->look_one_image ?? '';
        $this->look_one_caption = $c->look_one_caption ?? '';
        $this->look_two_image = $c->look_two_image ?? '';
        $this->look_two_caption = $c->look_two_caption ?? '';
    }

    private function lines(?array $values): string
    {
        return implode("\n", $values ?? []);
    }

    private function toArray(string $value): array
    {
        return array_values(array_filter(array_map('trim', preg_split('/\r\n|\r|\n/', $value) ?: [])));
    }

    public function resetForm(): void
    {
        $this->reset(['editingId', 'name', 'slug', 'description', 'types', 'features', 'applications', 'variants', 'brands', 'group', 'tag', 'note', 'pdf_page', 'image', 'hover_image', 'photo', 'look_one_image', 'look_one_caption', 'look_two_image', 'look_two_caption', 'look_one_photo', 'look_two_photo']);
        $this->featured = false;
        $this->status = true;
    }

    public function save(): void
    {
        $this->validate([
            'name' => 'required|string|max:120',
            'slug' => 'nullable|string|max:120|unique:categories,slug,'.$this->editingId,
            'description' => 'nullable|string',
            'image' => 'nullable|string|max:255',
            'hover_image' => 'nullable|string|max:255',
            'photo' => 'nullable|image|max:4096',
            'look_one_image' => 'nullable|string|max:255',
            'look_two_image' => 'nullable|string|max:255',
            'look_one_photo' => 'nullable|image|max:4096',
            'look_two_photo' => 'nullable|image|max:4096',
        ]);

        if ($this->photo) {
            $this->image = '/storage/'.$this->photo->store('categories', 'public');
        }
        if ($this->look_one_photo) {
            $this->look_one_image = '/storage/'.$this->look_one_photo->store('categories/looks', 'public');
        }
        if ($this->look_two_photo) {
            $this->look_two_image = '/storage/'.$this->look_two_photo->store('categories/looks', 'public');
        }

        Category::updateOrCreate(['id' => $this->editingId], [
            'name' => $this->name,
            'slug' => $this->slug ?: \Illuminate\Support\Str::slug($this->name),
            'description' => $this->description ?: null,
            'types' => $this->toArray($this->types),
            'features' => $this->toArray($this->features),
            'applications' => $this->toArray($this->applications),
            'variants' => $this->toArray($this->variants),
            'brands' => $this->toArray($this->brands),
            'group' => $this->group ?: null,
            'tag' => $this->tag ?: null,
            'note' => $this->note ?: null,
            'pdf_page' => $this->pdf_page !== '' ? (int) $this->pdf_page : null,
            'image' => $this->image ?: '/images/company-profile/page-06-image-01.png',
            'hover_image' => $this->hover_image ?: null,
            'featured' => $this->featured,
            'status' => $this->status,
            'look_one_image' => $this->look_one_image ?: null,
            'look_one_caption' => $this->look_one_caption ?: null,
            'look_two_image' => $this->look_two_image ?: null,
            'look_two_caption' => $this->look_two_caption ?: null,
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
        return view('livewire.admin.category-manager', [
            'categories' => Category::when($this->search, fn ($q) => $q->where('name', 'like', "%{$this->search}%"))
                ->orderBy('sort_order')->get(),
        ]);
    }
}
