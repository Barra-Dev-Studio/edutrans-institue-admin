<?php

namespace App\Services;
use App\Models\ChapterProgress;
use App\Models\Course;
use App\Models\OwnedCourse;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use App\Notifications\CoursePaid;
use Illuminate\Support\Facades\Auth;
use DB;
use Illuminate\Support\Str;

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

    public static function updateCallbackQris($data)
    {
        return Transaction::where('id', $data->data['reference_id'])->where('ref_id', $data->data['qr_id'])->update([
            'status' => $data->data['status'],
            'callback_response' => json_encode($data->all())
        ]);
    }

    public static function updateCallbackVA($data)
    {
        $query = Transaction::where('id', $data->external_id)->where('ref_id', $data->callback_virtual_account_id);
        $transaction = $query->first();

        if ((int) $transaction->total_payment === (int) $data->amount) {
            $query->update([
                'status' => 'SUCCEEDED',
                'callback_response' => json_encode($data->all())
            ]);
            return 'SUCCEEDED';
        } else {
            $query->update([
                'callback_response' => json_encode($data->all())
            ]);
            return 'PENDING';
        }
    }

    public static function process($data, $method)
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
            $payment = self::createTransaction($data, $transaction, $method);
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
                            'member_id' => Auth()->id(),
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
            if ($data->total_payment == 0) {
                foreach ($data->items as $item) {
                    auth()->user()->notify(new CoursePaid($item->id, auth()->user()->id));
                }
            }
            return self::getRedirectUrl($payment, $method);
        } catch (\Exception $e) {
            DB::rollBack();
            return false;
        }
    }

    public static function getBalance()
    {
        $xendit = new XenditService();
        $xendit->getBalances();
        return $xendit->getResponse();
    }

    public static function checkIfUserOwnedTheCourse($courseId)
    {
        $ownedCourse = OwnedCourse::where('member_id', Auth::user()->id)->where('course_id', $courseId)->count();
        return $ownedCourse > 0;
    }

    public static function addCourseToUserFromCallback($transactionId, $courseId, $userId)
    {
        $checkIfUserAlreadyPay = self::getById($transactionId);
        if ($checkIfUserAlreadyPay->status === 'SUCCEEDED') {
            $course = Course::where('id', $courseId)->with(['mentor', 'category'])->first();
            $transactionDetail = TransactionDetail::where('transaction_id', $transactionId)->where('item_id', $courseId)->first();
            $ownedCourse = (object) [
                'member_id' => $userId,
                'course_id' => $course->id,
                'title' => $course->title,
                'mentor' => $course->mentor->name,
                'category' => $course->category->name,
                'transaction_detail_id' => $transactionDetail->id
            ];
            self::saveOwnedCourse($ownedCourse);
            return Course::where('id', $courseId)->increment('total_students');
        }
    }

    public static function getTransactionStatistic()
    {
        $statistics = (object) [
            'success' => Transaction::where('status', 'SUCCEEDED')->count(),
            'pending' => Transaction::where('status', 'PENDING')->count(),
            'failed' => Transaction::where('status', 'FAILED')->count(),
            'total' => Transaction::count()
        ];

        return $statistics;
    }

    private static function updateTransaction($transactionId, $response)
    {
        return Transaction::where('id', $transactionId)->update([
            'ref_id' => $response->id,
            'payment_response' => json_encode(['provider' => 'xendit', 'data' => $response]),
            'status' => $response->status,
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
        $ownedCourse = OwnedCourse::create([
            'member_id' => $data->member_id,
            'course_id' => $data->course_id,
            'title' => $data->title,
            'mentor' => $data->mentor,
            'category' => $data->category,
            'transaction_detail_id' => $data->transaction_detail_id,
        ]);
        $courseInformation = Course::with('chapters')->findOrFail($data->course_id);
        $chapters = [];

        foreach($courseInformation->chapters as $chapter) {
            $chapters[] = (object) [
                'id' => $chapter->id,
                'duration' => $chapter->duration,
                'start' => 0,
                'watch' => 0,
                'is_completed' => false
            ];
        }

        return ChapterProgress::create([
            'owned_course_id' => $ownedCourse->id,
            'last_chapter_id' => $courseInformation->chapters[0]->id,
            'total_duration' => $courseInformation->total_duration,
            'chapters_completed' => json_encode($chapters)
        ]);
    }

    private static function createTransaction($data, $transaction, $method)
    {
        if ($data->total_price == 0) {
            return (object) [
                'id' => Str::uuid(),
                'ref_id' => Str::uuid(),
                'status' => 'SUCCEEDED',
                'reference_id' => $transaction->id,
                'price' => 0,
                'channel_code' => 'FREE_ITEM',
                'actions' => (object) [
                    'desktop_web_checkout_url' => '',
                    'mobile_deeplink_checkout_url' => ''
                ]
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
            if ($method === 'EWALLET') {
                $xendit->createEWalletPayment($data->payment_method, $transaction->id, $data->total_price, $items, $data->mobile_number ?? '');
                $response = $xendit->getResponse();
                return json_decode($response->body());
            } else if ($method === 'QRIS') {
                $xendit->createQrisPayment('ID_DANA', $transaction->id, $data->total_price, $items, $data->mobile_number ?? '');
                $response = $xendit->getResponse();
                return json_decode($response->body());
            } else if ($method === 'Virtual Account (VA)') {
                $xendit->createVAPayment($data->payment_method, $transaction->id, $data->total_price, $items);
                $response = $xendit->getResponse();
                return json_decode($response->body());
            }
            return false;
        }
    }

    private static function getRedirectUrl($payment, $method)
    {
        $data = [];
        if ($method === 'EWALLET') {
            $data = [
                'ID_OVO' => route('payment.index', $payment->reference_id),
                'ID_DANA' => $payment->actions->desktop_web_checkout_url ?? '',
                'ID_LINKAJA' => $payment->actions->desktop_web_checkout_url ?? '',
                'ID_SHOPEEPAY' => $payment->actions->mobile_deeplink_checkout_url ?? '',
                'FREE_ITEM' => route('payment.index', $payment->reference_id),
            ];
        } else if ($method === 'QRIS') {
            $data = [
                'ID_DANA' => route('payment.qris', $payment->reference_id),
                'ID_LINKAJA' => route('payment.qris', $payment->reference_id),
            ];
        } else if ($method === 'Virtual Account (VA)') {
            $data = [
                'BCA' => route('payment.va', $payment->external_id),
                'BNI' => route('payment.va', $payment->external_id),
                'BRI' => route('payment.va', $payment->external_id),
                'BSI' => route('payment.va', $payment->external_id),
                'CIMB' => route('payment.va', $payment->external_id),
                'MANDIRI' => route('payment.va', $payment->external_id)
            ];

            return $data[$payment->bank_code] ?? false;
        }

        return $data[$payment->channel_code] ?? false;
    }
}
