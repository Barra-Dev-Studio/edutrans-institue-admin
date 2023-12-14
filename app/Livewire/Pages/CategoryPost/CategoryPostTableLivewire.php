<?php

namespace App\Livewire\Pages\CategoryPost;

use App\Models\Category;
use App\Models\CategoryPost;
use App\Traits\DatatableModalTrait;
use Livewire\Component;
use Livewire\WithPagination;

class CategoryPostTableLivewire extends Component
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
        return view('livewire.pages.categorypost.categorypost-table-livewire', [
            'categories' => CategoryPost::where('name', 'like', '%' . $this->search . '%')->paginate($this->showPage)
        ]);
    }
}
