<?php

namespace App\Livewire\Pages\Course;

use App\Models\Course;
use App\Traits\DatatableModalTrait;
use Livewire\Component;
use Livewire\WithPagination;

class CourseTableLivewire extends Component
{
    use WithPagination;
    use DatatableModalTrait;

    public $showPage = 5;
    public $search = '';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function paginationView()
    {
        return 'vendor.livewire.tailwind';
    }

    public function render()
    {
        return view('livewire.pages.course.course-table-livewire', [
            'courses' => Course::where('title', 'like', '%' . $this->search . '%')->paginate($this->showPage)
        ]);
    }
}
