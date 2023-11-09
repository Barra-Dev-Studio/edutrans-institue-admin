<?php

namespace App\Livewire\Pages\Member;

use App\Models\Course;
use Livewire\Component;
use Livewire\WithPagination;

class CourseLivewire extends Component
{
    use WithPagination;

    public $showPage = 5;
    public $search = '';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        return view('livewire.pages.member.course-livewire', [
            'courses' => Course::where('title', 'like', '%'.$this->search.'%')->paginate($this->showPage),
        ]);
    }
}
