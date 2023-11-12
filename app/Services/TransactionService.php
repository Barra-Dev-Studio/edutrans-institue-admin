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

    public static function getByRefId($refId)
    {
        $transaction = Transaction::where("ref_id", $refId)->first();
        return $transaction;
    }

    public static function updateCallback($data)
    {
        return Transaction::where('id', $data->data['reference_id'])->where('ref_id', $data->data['id'])->update([
            'status' => $data->data['status'],
            'callback_response' => json_encode($data->all())
        ]);
    }

    public static function process($data)
    {
        DB::beginTransaction();
        try {
            $transactionData = (object) [
                'ref_id' => '',
                'total_item' => count($data->items),
                'total_price' => $data->total_price,
                'total_disc' => $data->total_disc,
                'total_payment' => $data->total_payment,
                'payment_method' => $data->payment_method,
                'status' => 'PENDING',
                'payment_response' => json_encode([])
            ];
            $transaction = self::saveTransaction($transactionData);
            $payment = self::createTransaction($data, $transaction);
            self::updateTransaction($transaction->id, $payment);
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
                if ($data->total_price == 0) {
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

    private static function updateTransaction($transactionId, $response)
    {
        return Transaction::where('id', $transactionId)->update([
            'ref_id' => $response->id,
            'payment_response' => json_encode(['provider' => 'xendit', 'data' => $response]),
        ]);
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

    private static function createTransaction($data, $transaction)
    {
        // TODO: Create payment
        if ($data->total_price == 0) {
            return (object) [
                'ref_id' => '',
                'status' => 'SUCCEEDED',
            ];
        } else {
            $items = [];
            foreach ($data->items as $item) {
                $items[] = (object) [
                    'id' => $item->id,
                    'name' => $item->title,
                    'category' => $item->category,
                    'price' => $item->final_price_item,
                ];
            }

            $xendit = new XenditService();
            $xendit->createEWalletPayment($data->payment_method, $transaction->id, $data->total_price, $items, $data->mobile_number ?? '');
            $response = $xendit->getResponse();
            return json_decode($response->body());
        }
    }
}
