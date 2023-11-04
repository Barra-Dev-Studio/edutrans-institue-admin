<?php

namespace App\Livewire\Pages\Member;

use App\Models\Transaction;
use Livewire\Component;
use Livewire\WithPagination;

class TransactionTableLivewire extends Component
{
    use WithPagination;

    public $showPage = 5;
    public $search = '';
    public $memberId;

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
        return view('livewire.pages.member.transaction-table-livewire', [
            'courses' => Transaction::where('member_id', $this->memberId)->paginate($this->showPage)
        ]);
    }
}
