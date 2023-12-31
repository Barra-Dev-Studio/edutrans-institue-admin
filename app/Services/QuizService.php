<?php

namespace App\Services;

use App\Models\Quiz;

class QuizService
{
    public static function getById($id)
    {
        return Quiz::findOrFail($id);
    }
    public static function deleteById($id)
    {
        return Quiz::where('id', $id)->delete();
    }

    public static function getByCourseId($courseId)
    {
        return Quiz::where('course_id', $courseId)->get();
    }

    public static function getFormattedQuizByCourseId($courseId)
    {
        $quizzes = Quiz::where('course_id', $courseId)->inRandomOrder()->get();
        foreach ($quizzes as $quiz) {
            $answers = json_decode($quizzes->answers);
            $quiz->answers = shuffle($answers);
        }

        return $quizzes;
    }
}
