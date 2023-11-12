<?php

namespace App\Livewire\Pages\Member;

use App\Services\CheckoutService;
use Livewire\Component;

class CheckoutLivewire extends Component
{
    public $course;
    public $payments;
    public $paymentMethod;

    public $tax = 0;
    public $totalPrice = 0;
    public $additionalPrice = 0;
    public $disc = 0;

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

    public function submit()
    {
        if (CheckoutService::checkIfUserOwnedTheCourse($this->course->id)) {
            return redirect()->route("member.play", $this->course->slug)->with('success', 'Kamu telah memiliki katalog kelas ini');
        }

        if ($this->selectedPayment == null || !auth()->check()) {
            return back();
        }

        $data = (object) [
            'total_price' => $this->totalPrice,
            'total_payment' => $this->totalPrice,
            'total_disc' => $this->disc,
            'tax' => $this->tax,
            'additional_price' => $this->additionalPrice,
            'payment_method' => $this->selectedPayment,
            'items' => [
                (object) [
                    'id' => $this->course->id,
                    'type' => 'course',
                    'price' => $this->course->price,
                    'disc' => $this->course->discount ?? 0,
                    'final_price_item' => $this->course->final_price_item ?? $this->course->price
                ]
            ]
        ];
        $process = CheckoutService::process($data);
        return $process ? redirect()->route('member.index') : back();
    }

    public function render()
    {
        return view('livewire.pages.member.checkout-livewire');
    }
}
