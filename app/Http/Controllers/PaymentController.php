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
}
