<?php

namespace App\Http\Controllers;

use App\Services\TransactionService;
use Carbon\Carbon;
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

        if (Carbon::parse($expiredAt)->isPast()) {
            return abort(404);
        }

        if ($transaction->status == 'SUCCEEDED') {
            return redirect()->route('payment.index', $transaction->id);
        }

        return view('pages.payment.qris', compact('qrStrings','expiredAt','amount'));
    }
    public function va($transactionId)
    {
        if (!auth()->check()) {
            return abort(404);
        }

        $transaction = TransactionService::getById($transactionId);
        $paymentResponse = json_decode($transaction->payment_response);

        $accountNumber = $paymentResponse->data->account_number;
        $expiredAt = $paymentResponse->data->expiration_date;
        $amount = $paymentResponse->data->expected_amount;

        if (Carbon::parse($expiredAt)->isPast()) {
            return abort(404);
        }

        if ($transaction->status == 'SUCCEEDED') {
            return redirect()->route('payment.index', $transaction->id);
        }

        return view('pages.payment.va', compact('accountNumber','expiredAt','amount'));
    }

}
