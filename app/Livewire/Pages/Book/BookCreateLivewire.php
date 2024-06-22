<?php

namespace App\Livewire\Pages\Book;

use App\Livewire\Plugin\TrixLivewire;
use App\Models\Book;
use App\Models\Category;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;

class BookCreateLivewire extends Component
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
    public $price = 0;
    public $discountPrice = 0;
    public $totalPages= 0;
    public $totalViews = 0;
    public $totalShares = 0;
    public $totalPurchased = 0;
    public $status = 'DRAFT';

    public $categories = [];
    public $selectedCategory = null;

    protected $rules = [
        'title' => ['required', 'min:4'],
        'slug' => ['required'],
        'description' => ['required'],
        'author' => ['required'],
        'publisher' => ['required'],
        'category' => ['required'],
        'isbn' => ['required'],
        'publishedYear' => ['required'],
        'cover' => ['required', 'image', 'max:1024'],
        'price' => ['required'],
        'discountPrice' => ['required'],
        'totalViews' => ['required'],
        'totalShares' => ['required'],
        'totalPages' => ['required'],
        'totalPurchased' => ['required'],
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
    }

    public function setSelectedCategory()
    {
        $this->selectedCategory = $this->category != '-1' ? Category::findOrFail($this->category) : null;
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
            $cover = $this->cover->store('book/cover');
            $book = Book::create([
                'title' => $this->title,
                'slug' => $this->slug,
                'author' => $this->author,
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
                'cover' => $cover
            ]);
            return redirect()->route('dashboard.book.show', $book->id)->with('success', 'Book created successfuly');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to add new book');
        }
    }

    public function render()
    {
        return view('livewire.pages.book.book-create-livewire');
    }
}
