<?php

namespace App\Services;
use App\Models\OwnedCourse;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Illuminate\Support\Facades\Auth;
use DB;

class TransactionService
{
    public static function getById($id)
    {
        $transaction = Transaction::findOrFail($id);
        return $transaction;
    }

    public static function process($data)
    {
        DB::beginTransaction();
        try {
            $response = self::createTransaction($data);
            $transactionData = (object) [
                'ref_id' => $response->ref_id,
                'total_item' => count($data->items),
                'total_price' => $data->total_price,
                'total_disc' => $data->total_disc,
                'total_payment' => $data->total_payment,
                'payment_method' => $data->payment_method,
                'status' => $response->status,
                'payment_response' => json_encode($response)
            ];
            $transaction = self::saveTransaction($transactionData);
            foreach ($data->items as $item) {
                $detail = (object) [
                    'transaction_id' => $transaction->id,
                    'item_id' => $item->id,
                    'item_type' => $item->type,
                    'item_name' => $item->name,
                    'price' => $item->price,
                    'disc' => $item->disc,
                    'final_price' => $item->final_price_item,
                ];
                $transactionDetail = self::saveTransactionDetail($detail);
                if ($item->type === 'course') {
                    $ownedCourse = (object) [
                        'course_id' => $item->id,
                        'title' => $item->title,
                        'mentor' => $item->mentor,
                        'category' => $item->category,
                        'transaction_detail_id' => $transactionDetail->id
                    ];
                    self::saveOwnedCourse($ownedCourse);
                }
            }
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e);
            return false;
        }
    }

    public static function checkIfUserOwnedTheCourse($courseId)
    {
        $ownedCourse = OwnedCourse::where('member_id', Auth::user()->id)->where('course_id', $courseId)->count();
        return $ownedCourse > 0;
    }

    private static function saveTransaction($data)
    {
        return Transaction::create([
            'member_id' => Auth::user()->id,
            'ref_id' => $data->ref_id,
            'total_item' => $data->total_item,
            'total_price' => $data->total_price,
            'total_disc' => $data->total_disc,
            'total_payment' => $data->total_payment,
            'payment_method' => $data->payment_method,
            'status' => $data->status,
            'payment_response' => $data->payment_response
        ]);
    }

    private static function saveTransactionDetail($data)
    {
        return TransactionDetail::create([
            'transaction_id' => $data->transaction_id,
            'item_id' => $data->item_id,
            'item_type' => $data->item_type,
            'item_name' => $data->item_name,
            'price' => $data->price,
            'disc' => $data->disc,
            'final_price' => $data->final_price,
        ]);
    }

    private static function saveOwnedCourse($data)
    {
        return OwnedCourse::create([
            'member_id' => Auth::user()->id,
            'course_id' => $data->course_id,
            'title' => $data->title,
            'mentor' => $data->mentor,
            'category' => $data->category,
            'transaction_detail_id' => $data->transaction_detail_id,
        ]);
    }

    private static function createTransaction($data)
    {
        // TODO: Create payment
        if ($data->total_price == 0) {
            return (object) [
                'ref_id' => 'xxx',
                'status' => 'SUCCESS',
            ];
        }
    }
}
