<?php

namespace App\Http\Controllers;

use App\Services\CourseService;
use App\Services\TransactionService;
use Illuminate\Http\Request;
use DB;

class TransactionController extends Controller
{
    public function callback(Request $request)
    {
        DB::beginTransaction();
        try {
            TransactionService::updateCallback($request);
            if ($request->data['status'] === 'SUCCEEDED')
            {
                foreach ($request->data['basket'] as $item) {
                    CourseService::addCourseToUser($request->data['reference_id'], $item['reference_id'], $request->data['metadata']['member_id']);
                }
            }
            DB::commit();
            return response([], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response($e->getMessage(), 500);
        }
    }

    public function callbackQris(Request $request)
    {
        DB::beginTransaction();
        try {
            TransactionService::updateCallback($request);
            if ($request->data['status'] === 'SUCCEEDED')
            {
                $transaction = TransactionService::getById($request->data['reference_id']);
                foreach ($transaction->transactionDetails as $item) {
                    CourseService::addCourseToUser($request->data['reference_id'], $item->item_id, $request->data['metadata']['member_id']);
                }
            }
            DB::commit();
            return response([], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response($e->getMessage(), 500);
        }
    }
}
