<?php

namespace App\Livewire\Admin;

use App\Models\Blog;
use Livewire\Component;
use Livewire\WithFileUploads;

class BlogManager extends Component
{
    use WithFileUploads;

    public ?int $editingId = null;
    public string $title = '';
    public string $slug = '';
    public string $category = '';
    public string $content = '';
    public string $meta_description = '';
    public string $thumbnail = '';
    public $photo = null;
    public bool $published = true;

    public function edit(int $id): void
    {
        $b = Blog::findOrFail($id);
        $this->editingId = $b->id;
        $this->title = $b->title;
        $this->slug = $b->slug;
        $this->category = $b->category ?? '';
        $this->content = $b->content ?? '';
        $this->meta_description = $b->meta_description ?? '';
        $this->thumbnail = $b->thumbnail ?? '';
        $this->published = (bool) $b->published;
    }

    public function resetForm(): void
    {
        $this->reset(['editingId', 'title', 'slug', 'category', 'content', 'meta_description', 'thumbnail', 'photo']);
        $this->published = true;
    }

    public function save(): void
    {
        $this->validate([
            'title' => 'required|string|max:200',
            'slug' => 'nullable|string|max:200|unique:blogs,slug,'.$this->editingId,
            'content' => 'nullable|string',
            'thumbnail' => 'nullable|string|max:255',
            'photo' => 'nullable|image|max:4096',
        ]);

        if ($this->photo) {
            $this->thumbnail = $this->photo->store('blogs', 'public');
        }

        Blog::updateOrCreate(['id' => $this->editingId], [
            'title' => $this->title,
            'slug' => $this->slug ?: \Illuminate\Support\Str::slug($this->title),
            'category' => $this->category ?: null,
            'content' => $this->content ?: null,
            'meta_description' => $this->meta_description ?: null,
            'thumbnail' => $this->thumbnail ?: null,
            'author' => auth()->user()->name,
            'seo_title' => $this->title,
            'published' => $this->published,
            'published_at' => $this->published ? now() : null,
        ]);

        session()->flash('message', 'Blog saved.');
        $this->resetForm();
    }

    public function toggle(int $id): void
    {
        $b = Blog::findOrFail($id);
        $b->update(['published' => ! $b->published]);
    }

    public function delete(int $id): void
    {
        Blog::findOrFail($id)->delete();
        session()->flash('message', 'Blog deleted.');
    }

    public function render()
    {
        return view('livewire.admin.blog-manager', ['blogs' => Blog::latest()->get()]);
    }
}
