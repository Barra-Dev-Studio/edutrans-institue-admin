<?php

namespace App\Livewire\Pages\Book;

use Livewire\Component;

class BookDetailLivewire extends Component
{
    public $book;
    
    public function render()
    {
        return view('livewire.pages.book.book-detail-livewire');
    }
}
