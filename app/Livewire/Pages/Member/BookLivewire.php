<?php

namespace App\Livewire\Pages\Member;

use App\Models\OwnedBook;
use Livewire\Component;
use Livewire\WithPagination;

class BookLivewire extends Component
{
    use WithPagination;

    public $search;
    public $showPage = 12;
    public $categories;

    public function mount()
    {
        $this->categories = OwnedBook::where('member_id', auth()->user()->id)
                ->distinct()->pluck('category');
    }

    public function render()
    {
        $books = OwnedBook::paginate($this->showPage);

        return view('livewire.pages.member.book-livewire', [
            'books' => $books
        ]);
    }
}
