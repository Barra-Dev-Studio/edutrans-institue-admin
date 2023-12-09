<?php

namespace App\Livewire\Pages\Section;

use App\Models\Section;
use App\Traits\DatatableModalTrait;
use Livewire\Component;
use Livewire\WithPagination;

class SectionTableLivewire extends Component
{
    use WithPagination;
    use DatatableModalTrait;

    public $showPage = 5;
    public $search = '';
    public $courseId;

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
        return view('livewire.pages.section.section-table-livewire', [
            'sections' => Section::where('course_id', $this->courseId)->where('title', 'like', '%' . $this->search . '%')->paginate($this->showPage)
        ]);
    }
}
