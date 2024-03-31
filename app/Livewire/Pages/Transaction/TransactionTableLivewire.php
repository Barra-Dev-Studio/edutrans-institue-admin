<?php

namespace App\Livewire\Pages\Transaction;

use App\Models\Transaction;
use App\Traits\DatatableLivewire;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use Livewire\WithPagination;

class TransactionTableLivewire extends Component
{
    use WithPagination, DatatableLivewire;
    public string|Transaction $model = Transaction::class;

    public function mount(): void
    {
        $this->columns = [
            'id' => ['type' => 'text', 'label' => 'No'],
            'created_at' => ['type' => 'text', 'label' => 'Date'],
            'member.name' => ['type' => 'text', 'label' => 'Member'],
            'transactionDetails.item_name' => ['type' => 'text', 'label' => 'Items'],
            'paymentMethod.name' => ['type' => 'text', 'label' => 'Payment'],
            'total_disc' => ['type' => 'text', 'label' => 'Total discount'],
            'total_price' => ['type' => 'text', 'label' => 'Total price'],
            'total_payment' => ['type' => 'text', 'label' => 'Total payment'],
            'status' => ['type' => 'text', 'label' => 'Status']
        ];
    }

    public function render(): View
    {
        $data = $this->getData(new ($this->model));

        return view('livewire.pages.transaction.transaction-table-livewire', [
            'data' => $data
        ]);
    }
}
