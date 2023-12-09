<?php

namespace App\Livewire\Pages\Rating;

use App\Models\Rating;
use App\Traits\DatatableModalTrait;
use Livewire\Component;
use Livewire\WithPagination;

class RatingTableLivewire extends Component
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
        return view('livewire.pages.rating.rating-table-livewire', [
            'ratings' => Rating::where('course_id', $this->courseId)->where('name', 'like', '%' . $this->search . '%')->paginate($this->showPage)
        ]);
    }
}
