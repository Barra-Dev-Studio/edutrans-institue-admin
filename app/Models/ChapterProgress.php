<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ChapterProgress extends Model
{
    use HasFactory, HasUuids, SoftDeletes;
    protected $fillable = [
        'owned_course_id',
        'last_chapter_id',
        'total_duration',
        'chapters_completed'
    ];

    public function ownedCourse()
    {
        return $this->belongsTo(OwnedCourse::class);
    }

    public function lastChapter()
    {
        return $this->belongsTo(Chapter::class, 'last_chapter_id');
    }
}
