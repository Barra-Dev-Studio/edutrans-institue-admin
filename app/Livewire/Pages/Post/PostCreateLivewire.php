<?php

namespace App\Livewire\Pages\Post;

use App\Livewire\Plugin\TrixLivewire;
use App\Models\Post;
use Illuminate\Support\Str;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;

class PostCreateLivewire extends Component
{
    use WithFileUploads;

    public $statuses = [
        ['id' => 'PUBLISH', 'name' => 'PUBLISH'],
        ['id' => 'DRAFT', 'name' => 'DRAFT']
    ];

    public $title;
    public $slug;
    public $content;
    public $thumbnail;
    public $tags;
    public $author;
    public $description;
    public $status;

    protected $rules = [
        'title' => 'required',
        'slug' => 'required',
        'content' => 'required',
        'tags' => 'required',
        'author' => 'required',
        'description' => 'required',
        'status' => 'required',
        'thumbnail' => ['required', 'image', 'max:1024']
    ];

    public $listeners = [
        TrixLivewire::EVENT_VALUE_UPDATED => 'updateFromTrix'
    ];

    public function updateFromTrix($value)
    {
        $this->content = $value;
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function updateSlug()
    {
        $this->slug = Str::slug($this->title);
    }

    public function submit()
    {
        $this->validate();
        try {
            $thumbnail = $this->thumbnail->store('posts');
            Post::create([
                'title' => $this->title,
                'slug' => $this->slug,
                'content' => $this->content,
                'tags' => $this->tags,
                'author' => $this->author,
                'description' => $this->description,
                'status' => $this->status,
                'thumbnail' => $thumbnail
            ]);
            return redirect()->route('dashboard.post.index')->with('success', 'Post created successfuly');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to add new post');
        }
    }

    public function render()
    {
        return view('livewire.pages.post.post-create-livewire');
    }
}