<?php

namespace App\Livewire\Pages\Guest;

use App\Models\Book;
use App\Models\Category;
use Livewire\Component;
use Livewire\WithPagination;

class BookListLivewire extends Component
{
    use WithPagination;

    public $query;
    public $categories;

    public $selectedCategory = 'all';
    public $selectedSort = 'terbaru';
    public $showPage = 6;

    public function mount()
    {
        $this->categories = $this->getCategories();
    }

    public function getCategories()
    {
        return Category::orderBy("name","asc")->get();
    }

    public function selectCategory($categoryId)
    {
        $this->selectedCategory = $categoryId;
        $this->resetPage();
    }

    public function selectSort($sort)
    {
        $this->selectedSort = $sort;
        $this->resetPage();
    }


    public function render()
    {
        $order = [$this->selectedSort == 'terbaru' ? 'created_at' : 'total_purchased', 'desc'];
        if ($this->selectedSort === 'promo') {
            $order = ['discount_price', 'desc'];
        }
        $books = Book::where('category_id', 'like', $this->selectedCategory !== 'all' ? $this->selectedCategory : '%%')
            ->where('title', 'like', '%'. $this->query . '%')
            ->where('status', 'PUBLISHED')
            ->with('author')
            ->orderBy($order[0], $order[1])
            ->paginate($this->showPage);

        return view('livewire.pages.guest.book-list-livewire', [
            'books' => $books
        ]);
    }
}
