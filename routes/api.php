<?php

use App\Http\Controllers\TransactionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('verify.callback')->group(function () {
    Route::post('/payment/callback', [TransactionController::class, 'callback'])->name('payment.callback');
    Route::post('/payment/qris/callback', [TransactionController::class, 'callbackQris'])->name('payment.callback.qris');
    Route::post('/payment/va/callback', [TransactionController::class, 'callbackVA'])->name('payment.callback.va');
});

