<?php

namespace App\Livewire\Pages\Book;

use App\Livewire\Plugin\TrixLivewire;
use App\Models\Book;
use App\Models\Category;
use App\Models\Mentor;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;

class BookUpdateLivewire extends Component
{
    use WithFileUploads;

    public $title;
    public $slug;
    public $description;
    public $author;
    public $publisher;
    public $isbn;
    public $publishedYear;
    public $category;
    public $cover;
    public $file;
    public $price = 0;
    public $discountPrice = 0;
    public $totalViews = 0;
    public $totalShares = 0;
    public $totalPages = 0;
    public $totalPurchased = 0;
    public $status = 'DRAFT';

    public $categories = [];
    public $authors = [];
    public $selectedCategory = null;
    public $selectedAuthor = null;

    public $id;
    public $currentCover;
    public $currentFile;

    protected $rules = [
        'title' => ['required', 'min:4'],
        'slug' => ['required'],
        'description' => ['required'],
        'author' => ['required'],
        'publisher' => ['required'],
        'category' => ['required'],
        'isbn' => ['required'],
        'publishedYear' => ['required'],
        'cover' => ['nullable', 'image', 'max:1024'],
        'file' => ['nullable', 'file'],
        'price' => ['required'],
        'discountPrice' => ['required'],
        'totalViews' => ['required'],
        'totalShares' => ['required'],
        'totalPurchased' => ['required'],
        'totalPages' => ['required'],
        'status' => ['required'],
    ];

    public $listeners = [
        TrixLivewire::EVENT_VALUE_UPDATED => 'updateFromTrix'
    ];

    public function updateFromTrix($value)
    {
        $this->description = $value;
    }

    public function mount()
    {
        $this->categories = Category::orderBy('name')->get();
        $this->authors = Mentor::orderBy('name')->get();

        $book = Book::where('id', $this->id)->first();

        $this->title = $book->title;
        $this->slug = $book->slug;
        $this->description = $book->description;
        $this->author = $book->author_id;
        $this->publisher = $book->publisher;
        $this->isbn = $book->isbn;
        $this->publishedYear = $book->published_year;
        $this->category = $book->category_id;
        $this->currentCover = $book->cover;
        $this->currentFile = $book->file;
        $this->price = $book->price;
        $this->discountPrice = $book->discount_price;
        $this->totalViews = $book->total_views;
        $this->totalShares = $book->total_shares;
        $this->totalPurchased = $book->total_purchased;
        $this->totalPages = $book->total_pages;
        $this->status = $book->status;

        $this->selectedCategory = Category::where('id', $book->category_id)->first();
        $this->selectedAuthor = Mentor::where('id', $book->author_id)->first();
    }

    public function setSelectedCategory()
    {
        $this->selectedCategory = $this->category != '-1' ? Category::findOrFail($this->category) : null;
    }

    public function setSelectedAuthor()
    {
        $this->selectedAuthor = $this->author != '-1' ? Mentor::findOrFail($this->author) : null;
    }

    public function setStatus($status)
    {
        $this->status = $status;
    }

    public function updated($propertyName)
    {
        if ($propertyName === 'title') {
            $this->slug = Str::slug($this->title);
        }
        $this->validateOnly($propertyName);
    }

    public function submit()
    {
        $this->validate();
        try {
            $cover = $this->cover ? $this->cover->store('book/cover') : $this->currentCover;
            $file = $this->file ? $this->file->store('book/file', 'local') : $this->currentFile;
            Book::where('id', $this->id)->update([
                'title' => $this->title,
                'slug' => $this->slug,
                'author_id' => $this->author,
                'publisher' => $this->publisher,
                'isbn' => $this->isbn,
                'description' => $this->description,
                'published_year' => $this->publishedYear,
                'category_id' => $this->category,
                'price' => $this->price,
                'discount_price' => $this->discountPrice,
                'total_views' => $this->totalViews,
                'total_shares' => $this->totalShares,
                'total_purchased' => $this->totalPurchased,
                'total_pages' => $this->totalPages,
                'status' => $this->status,
                'cover' => $cover,
                'file' => $file,
            ]);
            return redirect()->route('dashboard.book.show', $this->id)->with('success', 'Book updated successfuly');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to update book');
        }
    }

    public function render()
    {
        return view('livewire.pages.book.book-update-livewire');
    }
}
