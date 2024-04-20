<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppliedVoucher extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'user_id',
        'voucher_id',
        'transaction_id',
        'disc_off_price',
        'disc_off_percent',
        'total_price',
        'total_disc',
        'status',
    ];
}
