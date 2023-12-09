<?php

namespace App\Services;

use App\Models\Section;

class SectionService
{
    public static function getById($id)
    {
        return Section::findOrFail($id);
    }

    public static function deleteById($id)
    {
        return Section::where('id', $id)->delete();
    }

    public  static function getByCourseId($courseId)
    {
        return Section::where('course_id', $courseId)->get();
    }
}
