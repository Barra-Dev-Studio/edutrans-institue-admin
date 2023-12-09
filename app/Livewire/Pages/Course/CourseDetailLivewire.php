<?php

namespace App\Livewire\Pages\Course;

use Livewire\Component;

class CourseDetailLivewire extends Component
{
    public $course;
    public $previews;
    public $chapters;
    public $sections;

    public function showPreview($chapterId)
    {
        $this->dispatch('open-modal', $chapterId);
    }

    public function render()
    {
        return view('livewire.pages.course.course-detail-livewire');
    }
}
