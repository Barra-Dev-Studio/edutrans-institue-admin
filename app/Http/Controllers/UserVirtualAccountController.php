<?php

namespace App\Http\Controllers;

use App\Models\UserVirtualAccount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class UserVirtualAccountController extends Controller
{
    public function callbackUpsertVA(Request $request)
    {
        try {
            $transactionId = $request->external_id;
            $response = json_encode($request->all());
            UserVirtualAccount::create([
                'transaction_id' => $transactionId,
                'response' => $response
            ]);
            return response([], 200);
        } catch (\Exception $e) {
            Log::error($e);
            return response($e->getMessage(), 500);
        }
    }
}
