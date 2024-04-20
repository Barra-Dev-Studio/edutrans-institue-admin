<?php

namespace App\Livewire\Pages\Voucher;

use App\Models\Voucher;
use App\Traits\DatatableLivewire;
use App\Traits\DatatableModalTrait;
use Livewire\Component;
use Livewire\WithPagination;

class VoucherTableLivewire extends Component
{
    use WithPagination, DatatableLivewire, DatatableModalTrait;
    public string|Voucher $model = Voucher::class;

    public function mount(): void
    {
        $this->columns = [
            'id' => ['type' => 'text', 'label' => 'No'],
            'name' => ['type' => 'text', 'label' => 'Name'],
            'qty' => ['type' => 'text', 'label' => 'Quantity'],
            'valid' => ['type' => 'text', 'label' => 'Valid'],
            'disc' => ['type' => 'text', 'label' => 'Discount'],
        ];
    }

    public function render()
    {
        $data = $this->getData(new ($this->model));

        return view('livewire.pages.voucher.voucher-table-livewire', [
            'data' => $data
        ]);
    }
}
