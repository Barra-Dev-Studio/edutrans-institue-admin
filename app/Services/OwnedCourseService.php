<?php

namespace App\Services;

use App\Models\Mentor;
use App\Models\OwnedCourse;

class OwnedCourseService
{
    public static function get()
    {
        return OwnedCourse::where('member_id', auth()->id())->with(['course', 'chapterProgress'])->latest()->get();
    }

    public static function getById(string $id)
    {
        return OwnedCourse::where('member_id', auth()->id())->where('id', $id)->with(['course', 'chapterProgress'])->latest()->first();
    }

    public static function getByCourseId(string $courseId)
    {
        return OwnedCourse::where('member_id', auth()->id())->where('course_id', $courseId)->with(['course', 'chapterProgress'])->latest()->first();
    }

    public static function getLastChapterProgress()
    {
        $ownedCourse = OwnedCourse::where('member_id', auth()->id())->with(['course', 'chapterProgress.chapter'])->latest()->first();
        return $ownedCourse == null ? null : (object) [
            'course_id' => $ownedCourse->id,
            'chapter_id' => $ownedCourse->chapterProgress->last_chapter_id,
            'chapter_title' => $ownedCourse->chapterProgress->chapter->title,
            'course_title' => $ownedCourse->course->title
        ];
    }

    public static function count()
    {
        return OwnedCourse::where('member_id', auth()->id())->count();
    }
}
