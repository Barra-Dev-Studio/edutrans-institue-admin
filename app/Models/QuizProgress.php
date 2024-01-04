<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuizProgress extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'member_id',
        'owned_course_id',
        'course_id',
        'histories',
        'start_at',
        'end_at',
        'scores',
        'is_done'
    ];
}
