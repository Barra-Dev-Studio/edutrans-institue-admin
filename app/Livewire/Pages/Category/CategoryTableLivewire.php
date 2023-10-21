<?php

namespace App\Livewire\Pages\Category;

use App\Models\Category;
use App\Traits\DatatableModalTrait;
use Livewire\Component;
use Livewire\WithPagination;

class CategoryTableLivewire extends Component
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
        return view('livewire.pages.category.category-table-livewire', [
            'categories' => Category::where('name', 'like', '%' . $this->search . '%')->paginate($this->showPage)
        ]);
    }
}
