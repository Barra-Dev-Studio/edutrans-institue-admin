<?php

namespace App\Services;

use App\Models\Mentor;
use App\Models\OwnedCourse;
use App\Models\Quiz;

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

    public static function checkIfCompleteTheCourse($id)
    {
        $ownedCourse = OwnedCourse::where('member_id', auth()->id())->where('id', $id)
            ->with(['course.chapters', 'chapterProgress'])
            ->latest()->first();

        if ($ownedCourse === null) {
            return false;
        }

        $totalChapter = count($ownedCourse->course->chapters);
        $chapterProgress = $ownedCourse->chapterProgress;
        $completedChapter = collect(json_decode($chapterProgress->chapters_completed))
            ->filter(function ($value) { return $value->is_completed; })->count();

        $courseHasCertificate = $ownedCourse->course->is_certified;

        $checkIfCourseHasQuiz = Quiz::where('course_id', $ownedCourse->course_id)
                ->where('status', 'PUBLISHED')->get();
        if (count($checkIfCourseHasQuiz) > 0) {
            $quiz = QuizProgressService::getByOwnedCourseId($id);
            if ($quiz === null) {
                return false;
            }
            return $totalChapter == $completedChapter && $courseHasCertificate && $quiz->is_done;
        }

        if ($courseHasCertificate) {
            return $totalChapter == $completedChapter && $courseHasCertificate;
        }

        return $totalChapter == $completedChapter;

    }

    public static function checkIfCompleteTheCourseById($id)
    {
        $ownedCourse = OwnedCourse::where('id', $id)
            ->with(['course.chapters', 'chapterProgress'])
            ->latest()->first();

        if ($ownedCourse === null) {
            return false;
        }

        $totalChapter = count($ownedCourse->course->chapters);
        $chapterProgress = $ownedCourse->chapterProgress;
        $completedChapter = collect(json_decode($chapterProgress->chapters_completed))
            ->filter(function ($value) { return $value->is_completed; })->count();

        $courseHasCertificate = $ownedCourse->course->is_certified;

        $checkIfCourseHasQuiz = Quiz::where('course_id', $ownedCourse->course_id)
            ->where('status', 'PUBLISHED')->get();
        if (count($checkIfCourseHasQuiz) > 0) {
            $quiz = QuizProgressService::getByOwnedCourseIdWithoutUser($id);
            if ($quiz === null) {
                return false;
            }
            return $totalChapter == $completedChapter && $courseHasCertificate && $quiz->is_done;
        }

        if ($courseHasCertificate) {
            return $totalChapter == $completedChapter && $courseHasCertificate;
        }

        return $totalChapter == $completedChapter;
    }

}
