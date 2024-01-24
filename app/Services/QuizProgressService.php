<?php

namespace App\Services;

use App\Models\Quiz;
use App\Models\QuizProgress;
use Carbon\Carbon;

class QuizProgressService
{
    public static function getByCourseId($courseId)
    {
        return QuizProgress::where('member_id', auth()->id())->where('course_id', $courseId)->latest()->first();
    }

    public static function getByOwnedCourseId($ownedCourseId)
    {
        return QuizProgress::where('member_id', auth()->id())->where('owned_course_id', $ownedCourseId)->latest()->first();
    }

    public static function init($ownedCourse)
    {
        QuizProgress::where('member_id', auth()->id())
                ->where('course_id', $ownedCourse->course_id)
                ->where('owned_course_id', $ownedCourse->id)
                ->delete();

        return QuizProgress::create([
            'member_id' => auth()->id(),
            'owned_course_id' => $ownedCourse->id,
            'course_id' => $ownedCourse->course_id,
            'histories' => json_encode([]),
            'start_at' => Carbon::now(),
            'end_at' => null,
            'scores' => 0,
            'is_done' => false
        ]);
    }

    public static function updateProgressByOwnedCourseId($ownedCourseId, $histories)
    {
        return QuizProgress::where('member_id', auth()->id())->where('owned_course_id', $ownedCourseId)
                ->update([
                    'histories' => json_encode($histories)
                ]);
    }

    public static function recapProgress($ownedCourse)
    {
        $scores = 0;
        $data = self::getByOwnedCourseId($ownedCourse->id);
        $histories = json_decode($data->histories);
        foreach ($histories as $history) {
            if ($history->is_pass) {
                $scores += $history->score;
            }
        }

        $actualScores = QuizService::getSumScores($ownedCourse->course_id);

        $isDone = $scores >= floor($actualScores * 0.8);
        return QuizProgress::where('member_id', auth()->id())->where('owned_course_id', $ownedCourse->id)
            ->update([
                'end_at' => Carbon::now(),
                'is_done' => $isDone,
                'scores' => $scores
            ]);
    }
}
