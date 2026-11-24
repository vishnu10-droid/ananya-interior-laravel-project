<?php

namespace App\Livewire\Admin;

use App\Models\Project;
use App\Models\ProjectImage;
use Livewire\Component;
use Livewire\WithFileUploads;

class ProjectManager extends Component
{
    use WithFileUploads;

    public string $search = '';
    public ?int $editingId = null;
    public string $title = '';
    public string $slug = '';
    public string $category = '';
    public string $location = '';
    public string $date = '';
    public string $description = '';
    public string $highlights = '';
    public string $gallery = '';
    public string $image = '';
    public bool $featured = false;
    public bool $published = true;
    public $photo = null;
    public array $photos = [];

    protected function rules(): array
    {
        return [
            'title' => 'required|string|max:160',
            'slug' => 'nullable|string|max:160|unique:projects,slug,'.$this->editingId,
            'category' => 'nullable|string|max:120',
            'location' => 'nullable|string|max:160',
            'date' => 'nullable|string|max:60',
            'description' => 'nullable|string',
            'image' => 'nullable|string|max:255',
            'photo' => 'nullable|image|max:4096',
            'photos' => 'nullable|array',
            'photos.*' => 'image|max:4096',
        ];
    }

    public function edit(int $id): void
    {
        $project = Project::with('images')->findOrFail($id);
        $this->editingId = $project->id;
        $this->title = $project->title;
        $this->slug = $project->slug;
        $this->category = $project->category ?? '';
        $this->location = $project->location ?? '';
        $this->date = $project->date ?? '';
        $this->description = $project->description ?? '';
        $this->highlights = implode("\n", $project->highlights ?? []);
        $this->gallery = $project->images->pluck('path')->implode("\n");
        $this->image = $project->image ?? '';
        $this->featured = (bool) $project->featured;
        $this->published = (bool) $project->published;
    }

    public function resetForm(): void
    {
        $this->reset(['editingId', 'title', 'slug', 'category', 'location', 'date', 'description', 'highlights', 'gallery', 'image', 'photo', 'photos']);
        $this->featured = false;
        $this->published = true;
    }

    public function save(): void
    {
        $this->validate();

        if ($this->photo) {
            $this->image = '/storage/'.$this->photo->store('projects', 'public');
        }

        $project = Project::updateOrCreate(['id' => $this->editingId], [
            'title' => $this->title,
            'slug' => $this->slug ?: \Illuminate\Support\Str::slug($this->title),
            'category' => $this->category ?: null,
            'location' => $this->location ?: null,
            'date' => $this->date ?: null,
            'description' => $this->description ?: null,
            'highlights' => $this->lines($this->highlights),
            'image' => $this->image ?: '/images/company-profile/page-02-image-01.png',
            'featured' => $this->featured,
            'published' => $this->published,
        ]);

        $paths = $this->lines($this->gallery);
        foreach ($this->photos as $upload) {
            $paths[] = '/storage/'.$upload->store('projects', 'public');
        }

        $project->images()->delete();
        foreach (array_values(array_unique($paths)) as $index => $path) {
            ProjectImage::create([
                'project_id' => $project->id,
                'path' => $path,
                'alt_text' => $project->title,
                'sort_order' => $index,
            ]);
        }

        session()->flash('message', $this->editingId ? 'Project updated.' : 'Project created.');
        $this->resetForm();
    }

    public function delete(int $id): void
    {
        Project::findOrFail($id)->delete();
        session()->flash('message', 'Project deleted.');
    }

    private function lines(string $value): array
    {
        return array_values(array_filter(array_map('trim', preg_split('/\r\n|\r|\n/', $value) ?: [])));
    }

    public function render()
    {
        return view('livewire.admin.project-manager', [
            'projects' => Project::when($this->search, fn ($q) => $q->where('title', 'like', "%{$this->search}%"))
                ->orderBy('sort_order')->get(),
        ]);
    }
}
