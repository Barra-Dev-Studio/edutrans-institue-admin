<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TransactionDetail extends Model
{
    use HasFactory, HasUuids, SoftDeletes;
    protected $fillable = [
        'transaction_id',
        'item_id',
        'item_type',
        'item_name',
        'price',
        'disc',
        'final_price',
    ];

    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }
}
