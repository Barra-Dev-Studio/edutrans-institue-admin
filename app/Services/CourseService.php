<?php

namespace App\Services;
use App\Models\Course;

class CourseService
{
    public static function deleteCourseById(string $id)
    {
        $course = Course::find($id);
        return $course->delete();
    }
}
