<?php

namespace App\Livewire\Pages\Guest;

use App\Models\Post;
use Livewire\Component;

class LatestPostLivewire extends Component
{
    public $posts;

    public function mount()
    {
        $this->posts = Post::latest()->limit(4)->get();
    }

    public function render()
    {
        return view('livewire.pages.guest.latest-post-livewire');
    }
}
