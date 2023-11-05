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

    public static function getById(string $id)
    {
        return Course::findOrFail($id);
    }

    public static function getBySlug(string $slug)
    {
        return Course::where('slug', $slug)->latest()->first();
    }
}
