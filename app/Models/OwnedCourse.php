<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OwnedCourse extends Model
{
    use HasFactory, HasUuids, SoftDeletes;
    protected $fillable = [
        'member_id',
        'course_id',
        'transaction_detail_id',
        'mentor',
        'category',
        'title',
    ];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function transactionDetail()
    {
        return $this->belongsTo(TransactionDetail::class);
    }

    public function chapterProgress()
    {
        return $this->hasOne(ChapterProgress::class);
    }
}
