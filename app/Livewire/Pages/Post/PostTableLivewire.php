<?php

namespace App\Livewire\Pages\Post;

use App\Models\Post;
use App\Traits\DatatableModalTrait;
use Livewire\Component;
use Livewire\WithPagination;

class PostTableLivewire extends Component
{
    use WithPagination;
    use DatatableModalTrait;

    public $showPage = 5;
    public $search = '';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function paginationView()
    {
        return 'vendor.livewire.tailwind';
    }

    public function render()
    {
        return view('livewire.pages.post.post-table-livewire', [
            'posts' => Post::where('title', 'like', '%' . $this->search . '%')->paginate($this->showPage)
        ]);
    }
}
