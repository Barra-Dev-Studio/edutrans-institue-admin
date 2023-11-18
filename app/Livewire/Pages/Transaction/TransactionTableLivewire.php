<?php

namespace App\Livewire\Pages\Transaction;

use App\Models\Transaction;
use Livewire\Component;
use Livewire\WithPagination;

class TransactionTableLivewire extends Component
{
    use WithPagination;

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
        return view('livewire.pages.transaction.transaction-table-livewire', [
            'transactions' => Transaction::paginate($this->showPage)
        ]);
    }
}
