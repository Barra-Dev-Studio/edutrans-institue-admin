<?php

namespace App\Livewire\Pages\Guest;

use App\Models\Category;
use App\Models\Course;
use Livewire\Component;
use Livewire\WithPagination;

class CourseListLivewire extends Component
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
        $order = [$this->selectedSort == 'terbaru' ? 'created_at' : 'total_students', 'desc'];
        if ($this->selectedSort === 'promo') {
            $order = ['discount_price', 'desc'];
        }
        $courses = Course::where('category_id', 'like', $this->selectedCategory !== 'all' ? $this->selectedCategory : '%%')
            ->where('title', 'like', '%'. $this->query . '%')
            ->where('status', 'PUBLISHED')
            ->with('mentor')
            ->orderBy($order[0], $order[1])
            ->paginate($this->showPage);
        return view('livewire.pages.guest.course-list-livewire', [
            'courses' => $courses
        ]);
    }
}
