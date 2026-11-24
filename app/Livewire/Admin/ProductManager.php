<?php

namespace App\Livewire\Admin;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Livewire\Component;
use Livewire\WithFileUploads;

class ProductManager extends Component
{
    use WithFileUploads;

    public string $search = '';
    public ?int $editingId = null;
    public string $name = '';
    public string $slug = '';
    public $category_id = '';
    public $brand_id = '';
    public string $short_description = '';
    public string $description = '';
    public string $image = '';
    public bool $featured = false;
    public bool $active = true;
    public $photo = null;

    protected function rules(): array
    {
        return [
            'name' => 'required|string|max:160',
            'slug' => 'nullable|string|max:160',
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'nullable|exists:brands,id',
            'short_description' => 'nullable|string|max:500',
            'description' => 'nullable|string',
            'image' => 'nullable|string|max:255',
            'photo' => 'nullable|image|max:4096',
        ];
    }

    public function edit(int $id): void
    {
        $product = Product::findOrFail($id);
        $this->editingId = $product->id;
        $this->name = $product->name;
        $this->slug = $product->slug;
        $this->category_id = $product->category_id;
        $this->brand_id = $product->brand_id;
        $this->short_description = $product->short_description ?? '';
        $this->description = $product->description ?? '';
        $this->image = $product->image ?? '';
        $this->featured = (bool) $product->featured;
        $this->active = (bool) $product->active;
    }

    public function resetForm(): void
    {
        $this->reset(['editingId', 'name', 'slug', 'category_id', 'brand_id', 'short_description', 'description', 'image', 'photo', 'featured']);
        $this->active = true;
    }

    public function save(): void
    {
        $this->validate();

        if ($this->photo) {
            $this->image = '/storage/'.$this->photo->store('products', 'public');
        }

        Product::updateOrCreate(
            ['id' => $this->editingId],
            [
                'name' => $this->name,
                'slug' => $this->slug ?: \Illuminate\Support\Str::slug($this->name),
                'category_id' => $this->category_id,
                'brand_id' => $this->brand_id ?: null,
                'short_description' => $this->short_description ?: null,
                'description' => $this->description ?: null,
                'image' => $this->image ?: '/images/company-profile/page-06-image-01.png',
                'featured' => $this->featured,
                'active' => $this->active,
            ]
        );

        session()->flash('message', $this->editingId ? 'Product updated.' : 'Product created.');
        $this->resetForm();
    }

    public function delete(int $id): void
    {
        Product::findOrFail($id)->delete();
        session()->flash('message', 'Product deleted.');
    }

    public function render()
    {
        $products = Product::with(['category', 'brand'])
            ->when($this->search, fn ($q) => $q->where('name', 'like', "%{$this->search}%"))
            ->orderBy('sort_order')
            ->get();

        return view('livewire.admin.product-manager', [
            'products' => $products,
            'categories' => Category::orderBy('name')->get(),
            'brands' => Brand::orderBy('name')->get(),
        ]);
    }
}
