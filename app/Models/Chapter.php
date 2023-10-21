<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Chapter extends Model
{
    use HasFactory, HasUuids, SoftDeletes;
    protected $fillable = [
        'course_id',
        'title',
        'description',
        'section',
        'playback_url',
        'duration',
        'is_preview',
    ];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
