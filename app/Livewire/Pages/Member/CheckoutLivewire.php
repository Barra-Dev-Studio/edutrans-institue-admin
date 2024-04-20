<?php

namespace App\Livewire\Pages\Member;

use App\Models\PaymentMethod;
use App\Services\TransactionService;
use App\Services\VoucherService;
use App\Services\XenditService;
use Livewire\Component;

class CheckoutLivewire extends Component
{
    public $course;
    public $paymentMethods;

    public $tax = 0;
    public $totalPrice = 0;
    public $additionalPrice = 0;
    public $disc = 0;
    public $mobileNumber;
    public $voucherCode = null;

    public $selectedPayment = null;
    public $selectedPaymentShow = null;
    public $selectedVoucher = null;

    protected $bankChannelCodes = ['BCA', 'BNI', 'BRI', 'BSI', 'CIMB', 'MANDIRI'];

    public function mount()
    {
        $this->updatePrice();
        $this->getPaymentMethods();
    }

    public function updateVoucher()
    {
        $totalPrice = $this->totalPrice;

        if ($this->selectedPayment != null) {
            $totalPrice -= $this->additionalPrice;
        }

        $selectedVoucher = VoucherService::validate($this->voucherCode, $this->course, $totalPrice);

        if (!$selectedVoucher->error) {
            VoucherService::apply($selectedVoucher->voucher, $totalPrice);
            $this->disc = $selectedVoucher->voucher->calculation?->disc ?? 0;
        }

        $this->selectedVoucher = $selectedVoucher;
    }

    public function countTax()
    {
        $this->tax = $this->course->price * (11 / 100);
    }

    public function setSelectedPayment($selectedPayment)
    {
        $this->selectedPayment = $selectedPayment;
        $this->selectedPaymentShow = PaymentMethod::where('code', $selectedPayment)->where('is_active', true)->first();
        $this->updatePrice();
    }

    public function updatePrice()
    {
        $totalPrice = $this->course->discount_price > 0 ? $this->course->discount_price : $this->course->price;
        if ($this->selectedPayment == null) {
            $this->totalPrice = $totalPrice;
        } else {
            $this->additionalPrice = XenditService::getAdditionalFee($this->selectedPayment, $this->totalPrice);
            $this->totalPrice = $totalPrice + $this->additionalPrice;
        }
    }

    public function getPaymentMethods()
    {
        $paymentMethods = [];
        $data = PaymentMethod::where('is_active', true)->get();
        foreach ($data as $payment) {
            $paymentMethods[$payment->type][] = $payment;
        }
        $this->paymentMethods = $paymentMethods;
    }

    public function submit()
    {
        if (TransactionService::checkIfUserOwnedTheCourse($this->course->id)) {
            return redirect()->route("member.play", $this->course->slug)->with('success', 'Kamu telah memiliki katalog kelas ini');
        }

        if ($this->selectedPayment == null || !auth()->check()) {
            return back();
        }

        if (!$this->mobileNumber || $this->mobileNumber === '') {
            return back()->with('error', 'Pastikan nomor HP sudah terisi dengan baik');
        }

        $totalPayment = $this->totalPrice - ($this->disc);
        $data = (object) [
            'total_price' => $this->totalPrice,
            'total_payment' => $totalPayment,
            'total_disc' => $this->disc ,
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
                    'final_price_item' => $this->course->discount_price > 0
                            ? $this->course->discount_price
                            : $this->course->price
                ]
            ]
        ];

        $method = $this->getPaymentMethod();
        $voucher = null;

        if (isset($this->selectedVoucher->error) && !$this->selectedVoucher->error) {
            $voucher = $this->selectedVoucher?->voucher;
        }

        $process = TransactionService::process($data, $method, $voucher);

        return $process ? redirect($process) : back()->with('error', 'Terjadi kesalahan di sisi kami, silakan hubungi kamu untuk lebih lanjut');
    }

    protected function getPaymentMethod()
    {
        $method = '';
        if ($this->selectedPayment === 'QRIS') {
            $method = 'QRIS';
        } else if (in_array($this->selectedPayment, $this->bankChannelCodes)) {
            $method = 'Virtual Account (VA)';
        } else {
            $method = 'EWALLET';
        }

        return $method;
    }

    public function render()
    {
        return view('livewire.pages.member.checkout-livewire');
    }
}
