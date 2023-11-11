<?php

namespace App\Livewire\Pages\Member;

use Livewire\Component;

class CheckoutLivewire extends Component
{
    public $course;
    public $payments;
    public $paymentMethod;

    public $tax = 0;
    public $totalPrice = 0;
    public $additionalPrice = 0;

    public $selectedPayment = null;

    public function mount()
    {
        $this->updatePrice();
    }

    public function countTax()
    {
        $this->tax = $this->course->price * (11 / 100);
    }

    public function setSelectedPayment()
    {
        if ($this->paymentMethod == -1) {
            $this->selectedPayment = null;
            $this->additionalPrice = 0;
        } else {
            $this->selectedPayment = $this->paymentMethod;
            $this->additionalPrice = $this->payments[$this->paymentMethod];
        }
        $this->updatePrice();
    }

    public function updatePrice()
    {
        $this->countTax();
        $this->totalPrice = $this->course->price + $this->tax + $this->additionalPrice;
    }

    public function render()
    {
        return view('livewire.pages.member.checkout-livewire');
    }
}
