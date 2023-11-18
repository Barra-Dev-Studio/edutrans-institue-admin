<?php

namespace App\Services;
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
                'mobile_number' => $mobileNumber,
                'success_redirect_url' => env('XENDIT_REDIRECT_URL', '') . '/' . $referenceId,
                'failure_redirect_url' => env('XENDIT_REDIRECT_URL', '') . '/' . $referenceId,
            ],
            'basket' => $baskets,
            'metadata' => [
                'member_id' => auth()->user()->id,
                'name' => auth()->user()->name,
                'email' => auth()->user()->email
            ]
        ];

        $headers = [
            'Content-Type' => 'application/json',
        ];

        $response = Http::withBasicAuth($this->getApiSecretKey(), '')->withHeaders($headers)->post('https://api.xendit.co/ewallets/charges', $body);
        $this->response = $response;
    }

    public static function getAdditionalFee($channelCode, $amount)
    {
        $channelCodes = [
            'ID_OVO' => '0.03',
            'ID_DANA' => '0.03',
            'ID_LINKAJA' => '0.03',
            'ID_SHOPEEPAY' => '0.04',
            'QRIS' => '0.007'
        ];

        return $amount * $channelCodes[$channelCode];
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
}
