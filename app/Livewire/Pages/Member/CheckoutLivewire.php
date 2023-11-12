<?php

namespace App\Livewire\Pages\Member;

use App\Services\TransactionService;
use App\Services\XenditService;
use Livewire\Component;

class CheckoutLivewire extends Component
{
    public $course;

    public $tax = 0;
    public $totalPrice = 0;
    public $additionalPrice = 0;
    public $disc = 0;
    public $mobileNumber;

    public $selectedPayment = null;

    public function mount()
    {
        $this->updatePrice();
    }

    public function countTax()
    {
        $this->tax = $this->course->price * (11 / 100);
    }

    public function setSelectedPayment($selectedPayment)
    {
        $this->selectedPayment = $selectedPayment;
        $this->updatePrice();
    }

    public function updatePrice()
    {
        $this->countTax();
        $totalPrice = $this->course->price + $this->tax;
        if ($this->selectedPayment == null) {
            $this->totalPrice = $totalPrice;
        } else {
            $this->additionalPrice = XenditService::getAdditionalFee($this->selectedPayment, $this->totalPrice);
            $this->totalPrice = $totalPrice + $this->additionalPrice;
        }
    }

    public function submit()
    {
        if (TransactionService::checkIfUserOwnedTheCourse($this->course->id)) {
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
            'mobile_number' => $this->mobileNumber,
            'items' => [
                (object) [
                    'id' => $this->course->id,
                    'title' => $this->course->title,
                    'mentor' => $this->course->mentor->name,
                    'category' => $this->course->category->name,
                    'name' => $this->course->title,
                    'type' => 'course',
                    'price' => $this->course->price,
                    'disc' => $this->course->discount ?? 0,
                    'final_price_item' => $this->course->final_price_item ?? $this->course->price
                ]
            ]
        ];
        $process = TransactionService::process($data);
        return $process ? redirect()->route('member.index') : back();
    }

    public function render()
    {
        return view('livewire.pages.member.checkout-livewire');
    }
}
