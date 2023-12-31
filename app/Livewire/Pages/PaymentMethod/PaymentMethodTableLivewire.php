<?php

namespace App\Livewire\Pages\PaymentMethod;

use App\Models\Category;
use App\Models\CategoryPost;
use App\Models\PaymentMethod;
use App\Traits\DatatableModalTrait;
use Livewire\Component;
use Livewire\WithPagination;

class PaymentMethodTableLivewire extends Component
{
    use WithPagination;
    use DatatableModalTrait;

    public $showPage = 10;
    public $search = '';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function paginationView()
    {
        return 'vendor.livewire.tailwind';
    }

    public function updateStatus($id)
    {
        $paymentMethod = PaymentMethod::find($id);
        return PaymentMethod::where('id', $id)->update([
            'is_active' => !$paymentMethod->is_active
        ]);
    }

    public function render()
    {
        return view('livewire.pages.payment-method.payment-method-table-livewire', [
            'paymentMethods' => PaymentMethod::where('name', 'like', '%' . $this->search . '%')->paginate($this->showPage)
        ]);
    }
}
