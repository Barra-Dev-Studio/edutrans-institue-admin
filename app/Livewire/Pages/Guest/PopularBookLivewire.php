<?php

namespace App\Livewire\Pages\Guest;

use App\Models\Book;
use Livewire\Component;

class PopularBookLivewire extends Component
{
    public $books;

    public function mount()
    {
       $this->books = Book::where('status', 'PUBLISHED')
           ->orderBy('total_purchased', 'desc')
           ->limit(5)
           ->get();
    }

    public function render()
    {
        return view('livewire.pages.guest.popular-book-livewire');
    }
}
