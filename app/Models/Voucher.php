<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'name',
        'description',
        'banner',
        'code',
        'qty',
        'valid_start',
        'valid_end',
        'disc_off_price',
        'disc_off_percent',
        'is_active',
        'rules'
    ];
}
