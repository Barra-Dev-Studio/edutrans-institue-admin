<?php

namespace App\Livewire\Pages\Member;

use App\Models\Course;
use App\Models\OwnedCourse;
use Livewire\Component;
use Livewire\WithPagination;

class CourseLivewire extends Component
{
    use WithPagination;

    public $showPage = 8;
    public $search = '';
    public $mentor;
    public $category;

    public $categories;
    public $mentors;

    protected $defer = true;

    public function mount()
    {
        $this->categories = OwnedCourse::where('member_id', auth()->user()->id)
                ->distinct()->pluck('category');
        $this->mentors = OwnedCourse::where('member_id', auth()->user()->id)
                ->distinct()->pluck('mentor');
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingCategory()
    {
        $this->resetPage();
    }

    public function updatingMentor()
    {
        $this->resetPage();
    }

    public function render()
    {
        $mentor = $this->mentor;
        $category = $this->category;
        $courses = OwnedCourse::where('member_id', auth()->user()->id)
            ->where('title', 'like','%'. $this->search .'%')
            ->where(function ($query) use ($mentor, $category) {
                if ($mentor != '' && $mentor != -1 && $mentor != null) {
                    $query->where('mentor', $mentor);
                }
                if ($category != '' && $category != -1 && $category != null) {
                    $query->where('category', $category);
                }
            })
            ->paginate($this->showPage);
        return view('livewire.pages.member.course-livewire', [
            'courses' => $courses,
        ]);
    }
}
