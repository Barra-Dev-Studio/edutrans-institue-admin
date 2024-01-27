<?php

namespace App\Services;

use App\Models\Course;
use App\Models\Rating;

class RatingService
{
    public static function getById(string $id)
    {
        return Rating::findOrFail($id);
    }

    public static function getByCourseId(string $courseId)
    {
        return Rating::where('course_id', $courseId)->latest()->limit(9)->get();
    }

    public static function deleteById(string $id)
    {
        return Rating::where('id', $id)->delete();
    }

    public static function decrementByCourseId($courseId)
    {
        return Course::where('id', $courseId)->decrement('total_ratings');
    }

    public static function checkIfUserRatedTheCourse($courseId)
    {
        return Rating::where('member_id', auth()->id())->where('course_id', $courseId)
                ->first();
    }
}
