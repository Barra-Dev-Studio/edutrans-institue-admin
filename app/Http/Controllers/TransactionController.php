<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Notifications\CoursePaid;
use App\Services\CourseService;
use App\Services\TransactionService;
use Illuminate\Http\Request;
use DB;

class TransactionController extends Controller
{
    public function index()
    {
        $transaction = TransactionService::getBalance();
        $transaction = json_decode($transaction->body());
        return view('pages.transaction.index', compact('transaction'));
    }

    public function show(string $id)
    {
        $transaction = TransactionService::getById($id);
        $paymentResponse = ($transaction->payment_response);
        $callbackResponse = ($transaction->callback_response);
        return view('pages.transaction.show', compact('transaction', 'paymentResponse', 'callbackResponse'));
    }

    public function callback(Request $request)
    {
        DB::beginTransaction();
        try {
            TransactionService::updateCallback($request);
            if ($request->data['status'] === 'SUCCEEDED') {
                $user = User::find($request->data['metadata']['member_id']);
                foreach ($request->data['basket'] as $item) {
                    CourseService::addCourseToUser($request->data['reference_id'], $item['reference_id'], $request->data['metadata']['member_id']);
                    $user->notify(new CoursePaid($item['reference_id'], $request->data['metadata']['member_id']));
                }
                DB::commit();
                return response([], 200);
            } else {
                DB::commit();
                return response([], 400);
            }
        } catch (\Exception $e) {
            DB::rollBack();
            return response($e->getMessage(), 500);
        }
    }

    public function callbackQris(Request $request)
    {
        DB::beginTransaction();
        try {
            TransactionService::updateCallbackQris($request);
            if ($request->data['status'] === 'SUCCEEDED') {
                $user = User::find($request->data['metadata']['member_id']);
                foreach ($request->data['basket'] as $item) {
                    CourseService::addCourseToUser($request->data['reference_id'], $item['reference_id'], $request->data['metadata']['member_id']);
                    $user->notify(new CoursePaid($item['reference_id'], $request->data['metadata']['member_id']));
                }
                DB::commit();
                return response([], 200);
            } else {
                DB::commit();
                return response([], 400);
            }
        } catch (\Exception $e) {
            DB::rollBack();
            return response($e->getMessage(), 500);
        }
    }
}
