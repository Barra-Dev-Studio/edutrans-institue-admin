<?php

namespace App\Livewire\Pages\Guest;

use App\Models\Course;
use Livewire\Component;

class PopularCourseLivewire extends Component
{
    public $courses;

    public function mount()
    {
       $this->courses = Course::orderBy('total_students', 'desc')->limit(9)->get();
    }
    public function render()
    {
        return view('livewire.pages.guest.popular-course-livewire');
    }
}
