<?php

namespace App\Services;

use App\Models\AppliedVoucher;
use App\Models\Voucher;
use Carbon\Carbon;

class VoucherService
{
    public static function findOrFail(string $id)
    {
        return Voucher::findOrFail($id);
    }

    public static function create(mixed $payload)
    {
        return Voucher::create($payload);
    }

    public static function update(mixed $payload, array $conditions)
    {
        return Voucher::where($conditions)->update($payload);
    }

    public static function deleteById(string $id)
    {
        return Voucher::where('id', $id)->delete();
    }

    public static function reduceQty($voucher)
    {
        return Voucher::where('id', $voucher->id)->decrement('qty');
    }

    public static function calculate($voucher, $totalPrice)
    {
        if ($voucher->disc_off_price > 0) {
            return (object) [
                'disc' => $voucher->disc_off_price,
                'show' => 'Rp' . number_format($voucher->disc_off_price),
                'price' => $totalPrice,
                'total' => $totalPrice - $voucher->disc_off_price
            ];
        }

        if ($voucher->disc_off_percent > 0) {
            return (object) [
                'disc' => ceil($totalPrice * ($voucher->disc_off_percent / 100)),
                'show' => number_format($voucher->disc_off_percent),
                'price' => $totalPrice,
                'total' => $totalPrice - (ceil($totalPrice * ($voucher->disc_off_percent / 100)))
            ];
        }

        return (object) [
            'disc' => 0,
            'show' => '',
            'price' => $totalPrice,
            'total' => $totalPrice
        ];
    }

    public static function apply($voucher, $totalPrice)
    {
        $calculate = self::calculate($voucher, $totalPrice);
        $payload = [
            'user_id' => Auth()->id(),
            'voucher_id' => $voucher->id,
            'disc_off_price' => $voucher->disc_off_price,
            'disc_off_percent' => $voucher->disc_off_percent,
            'total_price' => $totalPrice,
            'total_disc' => $calculate->disc,
        ];

        return AppliedVoucher::create($payload);
    }

    public static function applied($voucher, $transaction)
    {
        return AppliedVoucher::where('user_id', Auth()->id())
            ->where('voucher_id', $voucher->id)
            ->update([
                'transaction_id' => $transaction->id,
                'status' => 'REDEEMED',
            ]);
    }

    public static function validate($voucherCode, $course, $totalPrice)
    {
        $voucher = Voucher::where('code', $voucherCode)->first();

        if ($voucher === null) {
            return (object) [
                'error' => true,
                'message' => 'Tidak ada voucher yang berlaku'
            ];
        }

        if (!$voucher->is_active) {
            return (object) [
                'error' => true,
                'message' => 'Tidak ada voucher yang aktif untuk saat ini'
            ];
        }

        if ($voucher->qty <= 0) {
            return (object) [
                'error' => true,
                'message' => 'Wah sayang sekali, kuota voucher sudah habis'
            ];
        }

        if (!Carbon::now()->between(Carbon::parse($voucher->valid_start), Carbon::parse($voucher->valid_end))) {
            return (object) [
                'error' => true,
                'message' => 'Wah sayang sekali, masa berlaku voucher sudah habis'
            ];
        }

        $rules = json_decode($voucher->rules);

        if ($rules->course === 'specified') {
            $allowedCourses = collect($rules->allowedCourses);
            $isAllowed = $allowedCourses->filter(function ($item) use ($course) {
                return $item->id === $course->id;
            });

            if (count($isAllowed) <= 0) {
                return (object) [
                    'error' => true,
                    'message' => 'Voucher tidak bisa digunakan di produk yang dibeli'
                ];
            }
        }

        if ($rules->member === 'specified') {
            $allowedMembers = collect($rules->allowedMembers);
            $isAllowed = $allowedMembers->filter(function ($item) {
                return $item->id === Auth()->id();
            });

            if (count($isAllowed) <= 0) {
                return (object) [
                    'error' => true,
                    'message' => 'Tidak ada voucher yang berlaku untuk saat ini'
                ];
            }
        }

        if ($rules->minimumTransaction > $totalPrice) {
            return (object) [
                'error' => true,
                'message' => 'Syarat minimum transaksi tidak terpenuhi'
            ];
        }

        $voucher->total_price = $totalPrice;
        $voucher->calculation = self::calculate($voucher, $totalPrice);

        return (object) [
            'error' => false,
            'message' => 'Berhasil menggunakan voucher',
            'voucher' => (object) $voucher->toArray(),
        ];
    }
}
