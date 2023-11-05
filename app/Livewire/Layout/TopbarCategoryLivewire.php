<?php

namespace App\Livewire\Layout;

use App\Models\Category;
use Livewire\Component;

class TopbarCategoryLivewire extends Component
{
    public $categories;

    public function mount()
    {
        $this->categories = Category::latest()->limit(5)->get();
    }

    public function render()
    {
        return view('livewire.layout.topbar-category-livewire');
    }
}
