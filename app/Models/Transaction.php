<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    use HasFactory, HasUuids, SoftDeletes;
    protected $fillable = [
        'member_id',
        'ref_id',
        'total_item',
        'total_price',
        'total_disc',
        'total_payment',
        'status',
        'payment_response',
        'payment_method',
        'callback_response'
    ];

    public function transactionDetails()
    {
        return $this->hasMany(TransactionDetail::class);
    }

    public function member()
    {
        return $this->belongsTo(User::class, 'member_id', 'id');
    }

    public function paymentMethod()
    {
        return $this->belongsTo(PaymentMethod::class, 'payment_method', 'code');
    }
}
