<?php

namespace App\Livewire\Pages\Blog;

use App\Models\Post;
use Livewire\Component;
use Livewire\WithPagination;

class BlogIndexLivewire extends Component
{
    use WithPagination;

    public $featuredPost;

    public $showPage = 5;
    public $search = '';

    public $tagBackgrounds = [
        'blue',
        'red',
        'rose',
        'amber',
        'violet'
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function paginationView()
    {
        return 'vendor.livewire.tailwind';
    }

    public function mount()
    {
        $this->featuredPost = Post::latest()->first();
    }

    public function render()
    {
        return view('livewire.pages.blog.blog-index-livewire', [
            'posts' => Post::where('title', 'like', '%' . $this->search . '%')->whereNot('id', $this->featuredPost->id)->where('status', 'PUBLISH')->paginate($this->showPage)
        ]);
    }
}
