<?php

namespace App\Livewire\Pages\Mentor;

use App\Models\Mentor;
use App\Traits\DatatableModalTrait;
use Livewire\Component;
use Livewire\WithPagination;

class MentorTableLivewire extends Component
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
        return view('livewire.pages.mentor.mentor-table-livewire', [
            'mentors' => Mentor::where('name', 'like', '%' . $this->search . '%')->paginate($this->showPage)
        ]);
    }
}
