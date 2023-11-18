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
                DB::commit();
                return response([], 200);
            } else {
                return response([], 400);
            }
        } catch (\Exception $e) {
            DB::rollBack();
            return response($e->getMessage(), 500);
        }
    }
}
