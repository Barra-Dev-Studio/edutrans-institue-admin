<?php

namespace App\Livewire\Pages\User;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use App\Traits\DatatableModalTrait;

class UserTableLivewire extends Component
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
        return view('livewire.pages.user.user-table-livewire', [
            'users' => User::where('name', 'like', '%' . $this->search . '%')->paginate($this->showPage)
        ]);
    }
}
