<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\UserVirtualAccount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use DB;

class UserVirtualAccountController extends Controller
{
    public function callbackUpsertVA(Request $request)
    {
        DB::beginTransaction();
        try {
            $transactionId = $request->external_id;
            $response = json_encode($request->all());

            $checkIfExists = UserVirtualAccount::where('transaction_id', $transactionId)->first();
            if ($checkIfExists !== null) {
                UserVirtualAccount::where('id', $checkIfExists->id)->update([
                    'transaction_id' => $transactionId,
                    'response' => $response
                ]);
                Transaction::where('id', $checkIfExists->transaction_id)->update([
                    'status' => $request->status
                ]);
            } else {
                UserVirtualAccount::create([
                    'transaction_id' => $transactionId,
                    'response' => $response
                ]);
            }
            DB::commit();
            return response([], 200);
        } catch (\Exception $e) {
            Log::error($e);
            DB::rollBack();
            return response($e->getMessage(), 500);
        }
    }
}
