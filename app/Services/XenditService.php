<?php

namespace App\Services;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;

class XenditService
{
    protected $currency = 'IDR';
    protected $checkoutMethod = 'ONE_TIME_PAYMENT';
    protected $response;

    public function createEWalletPayment($channelCode, $referenceId, $amount, $items, $mobileNumber = '')
    {
        $baskets = [];
        foreach( $items as $item ) {
            $baskets[] = [
                'reference_id' => $item->id,
                'name' => $item->name,
                'category' => $item->category,
                'currency' => 'IDR',
                'price' => (int) $item->price,
                'quantity' => 1,
                'type' => 'PRODUCT',
            ];
        }

        $body = [
            'reference_id' => $referenceId,
            'currency' => $this->currency,
            'amount' => $amount,
            'checkout_method' => $this->checkoutMethod,
            'channel_code' => $channelCode,
            'channel_properties' => [
                'mobile_number' => $this->formatMobileNumber($mobileNumber),
                'success_redirect_url' => env('XENDIT_REDIRECT_URL', '') . '/' . $referenceId,
                'failure_redirect_url' => env('XENDIT_REDIRECT_URL', '') . '/' . $referenceId,
            ],
            'basket' => $baskets,
            'metadata' => [
                'member_id' => auth()->user()->id,
                'name' => auth()->user()->name,
                'email' => auth()->user()->email,
                'mobile_number' => $this->formatMobileNumber($mobileNumber)
            ]
        ];

        $headers = [
            'Content-Type' => 'application/json',
        ];

        $response = Http::withBasicAuth($this->getApiSecretKey(), '')->withHeaders($headers)->post('https://api.xendit.co/ewallets/charges', $body);
        $this->response = $response;
    }

    public function createQrisPayment($channelCode = 'ID_DANA', $referenceId, $amount, $items, $mobileNumber = '')
    {
        $baskets = [];
        foreach ($items as $item) {
            $baskets[] = [
                'reference_id' => $item->id,
                'name' => $item->name,
                'category' => $item->category,
                'currency' => 'IDR',
                'price' => (int) $item->price,
                'quantity' => 1,
                'type' => 'PRODUCT',
            ];
        }

        $body = [
            'reference_id' => $referenceId,
            'currency' => $this->currency,
            'type' => 'DYNAMIC',
            'amount' => (int) $amount,
            'channel_code' => $channelCode,
            'basket' => $baskets,
            'expires_at' => Carbon::now()->addMinutes(15),
            'metadata' => [
                'member_id' => auth()->user()->id,
                'name' => auth()->user()->name,
                'email' => auth()->user()->email,
                'mobile_number' => $this->formatMobileNumber($mobileNumber),
            ]
        ];

        $headers = [
            'Content-Type' => 'application/json',
            'api-version' => '2022-07-31'
        ];

        $response = Http::withBasicAuth($this->getApiSecretKey(), '')->withHeaders($headers)->post('https://api.xendit.co/qr_codes', $body);
        $this->response = $response;
    }

    public function createVAPayment($bankCode, $referenceId, $amount, $items)
    {
        $body = [
            'external_id' => $referenceId,
            'bank_code' => $bankCode,
            'name' => auth()->user()->name,
            'is_closed' => true,
            'expected_amount' => $amount,
            'expiration_date' => Carbon::now()->addHour(1),
        ];

        $headers = [
            'Content-Type' => 'application/json',
        ];

        $response = Http::withBasicAuth($this->getApiSecretKey(), '')->withHeaders($headers)->post('https://api.xendit.co/callback_virtual_accounts', $body);
        $this->response = $response;
    }

    public function getBalances()
    {
        $headers = [
            'Content-Type' => 'application/json',
        ];

        $response = Http::withBasicAuth($this->getApiSecretKey(), '')->withHeaders($headers)->get('https://api.xendit.co/balance');
        $this->response = $response;
    }

    public static function getAdditionalFee($channelCode, $amount)
    {
        $bankChannelCodes = ['BCA', 'BNI', 'BRI', 'BSI', 'CIMB', 'MANDIRI'];
        $channelCodes = [
            'ID_OVO' => '0.03',
            'ID_DANA' => '0.03',
            'ID_LINKAJA' => '0.03',
            'ID_SHOPEEPAY' => '0.04',
            'QRIS' => '0.007'
        ];

        if (in_array($channelCode, $bankChannelCodes)) {
            return 4000;
        } else {
            return ceil($amount * $channelCodes[$channelCode]);
        }

    }

    public function getResponse()
    {
        return $this->response;
    }

    private function generateAuthenticationToken()
    {
        return base64_encode(env("XENDIT_API_SECRET_KEY") . ":");
    }

    private function getApiSecretKey()
    {
        return env("XENDIT_API_SECRET_KEY", "");
    }

    private function formatMobileNumber($number)
    {
        if ($number == '') {
            return $number;
        }

        $numbers = str_split($number);
        if ($numbers[0] == '0') {
            $numbers[0] = '62';
        }

        return '+' . implode('', $numbers);
    }
}
