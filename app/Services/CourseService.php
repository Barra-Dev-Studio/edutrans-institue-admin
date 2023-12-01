<?php

namespace App\Services;
use App\Models\Chapter;
use App\Models\Course;
use App\Models\OwnedCourse;
use App\Models\TransactionDetail;

class CourseService
{
    public static function deleteCourseById(string $id)
    {
        $course = Course::find($id);
        return $course->delete();
    }

    public static function getById(string $id)
    {
        return Course::findOrFail($id);
    }

    public static function getBySlug(string $slug)
    {
        return Course::where('slug', $slug)->latest()->first();
    }

    public static function getPopularCourse()
    {
        return Course::where('status', 'PUBLISHED')
            ->with('mentor')
            ->orderBy('total_students', 'desc')
            ->limit(3)
            ->get();
    }

    public static function syncTotalDuration($courseId)
    {
        $total = Chapter::where('course_id', $courseId)->sum('duration');
        return Course::where('id', $courseId)->update([
            'total_duration' => $total
        ]);
    }

    public static function syncTotalStudent($courseId)
    {
        $total = OwnedCourse::where('course_id', $courseId)->count();
        return Course::where('id', $courseId)->upate([
            'total_students' => $total
        ]);
    }
}
