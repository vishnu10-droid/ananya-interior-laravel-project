<?php

namespace App\Livewire\Admin;

use App\Models\Media;
use Livewire\Component;
use Livewire\WithFileUploads;

class MediaManager extends Component
{
    use WithFileUploads;

    public string $folder = 'showcase';
    public ?int $editingId = null;
    public string $title = '';
    public string $category = '';
    public string $path = '';
    public string $alt_text = '';
    public string $meta = '';
    public $file = null;

    protected function rules(): array
    {
        return [
            'title' => 'nullable|string|max:160',
            'category' => 'nullable|string|max:120',
            'path' => 'nullable|string|max:500',
            'alt_text' => 'nullable|string|max:160',
            'file' => 'nullable|file|max:51200',
        ];
    }

    public function edit(int $id): void
    {
        $media = Media::findOrFail($id);
        $this->editingId = $media->id;
        $this->folder = $media->folder;
        $this->title = $media->title ?? '';
        $this->category = $media->category ?? '';
        $this->path = $media->path;
        $this->alt_text = $media->alt_text ?? '';
        $this->meta = $media->meta ? json_encode($media->meta, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) : '';
    }

    public function resetForm(): void
    {
        $this->reset(['editingId', 'title', 'category', 'path', 'alt_text', 'meta', 'file']);
    }

    public function save(): void
    {
        $this->validate();

        if ($this->file) {
            $this->path = '/storage/'.$this->file->store('media/'.$this->folder, 'public');
        }

        $decoded = $this->meta !== '' ? json_decode($this->meta, true) : null;

        Media::updateOrCreate(['id' => $this->editingId], [
            'filename' => basename(parse_url($this->path, PHP_URL_PATH) ?: $this->path),
            'path' => $this->path,
            'alt_text' => $this->alt_text ?: $this->title,
            'title' => $this->title ?: null,
            'category' => $this->category ?: null,
            'meta' => is_array($decoded) ? $decoded : null,
            'mime_type' => $this->mime($this->path),
            'folder' => $this->folder,
        ]);

        session()->flash('message', $this->editingId ? 'Media updated.' : 'Media added.');
        $this->resetForm();
    }

    public function delete(int $id): void
    {
        Media::findOrFail($id)->delete();
        session()->flash('message', 'Media deleted.');
    }

    private function mime(string $path): string
    {
        $extension = strtolower(pathinfo(parse_url($path, PHP_URL_PATH) ?: $path, PATHINFO_EXTENSION));

        return match ($extension) {
            'png' => 'image/png',
            'jpg', 'jpeg' => 'image/jpeg',
            'svg' => 'image/svg+xml',
            'mp4' => 'video/mp4',
            default => 'application/octet-stream',
        };
    }

    public function render()
    {
        return view('livewire.admin.media-manager', [
            'items' => Media::where('folder', $this->folder)->orderBy('id')->get(),
        ]);
    }
}
