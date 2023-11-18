<?php

namespace App\Http\Controllers;

use App\Services\TransactionService;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index($transactionId)
    {
        if (!auth()->check()) {
            return abort(404);
        }

        $transaction = TransactionService::getById($transactionId);
        $data = [
            'SUCCEEDED' => 'pages.payment.success',
            'PENDING' => 'pages.payment.pending',
            'FAILED' => 'pages.payment.failed'
        ];

        return view($data[$transaction->status]);
    }

    public function qris($transactionId)
    {
        if (!auth()->check()) {
            return abort(404);
        }

        $transaction = TransactionService::getById($transactionId);
        $paymentResponse = json_decode($transaction->payment_response);
        $qrStrings = $paymentResponse->data->qr_string;
        $expiredAt = $paymentResponse->data->expires_at;
        $amount = $paymentResponse->data->amount;

        return view('pages.payment.qris', compact('qrStrings','expiredAt','amount'));
    }
}
