<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Certificate extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'member_id',
        'owned_course_id',
        'certificate_number',
        'first_issued_at',
        'last_issued_at',
    ];

    public function member()
    {
        return $this->belongsTo(User::class, 'member_id');
    }

    public function ownedCourse()
    {
        return $this->belongsTo(OwnedCourse::class);
    }
}
