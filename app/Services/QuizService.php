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
        $quizzes = Quiz::where('course_id', $courseId)->oldest()->get();
        $formattedQuiz = [];
        foreach ($quizzes as $quiz) {
            $answers = json_decode($quiz->answers);
            shuffle($answers);
            $formattedQuiz[] = [
                'id' => $quiz->id,
                'question' => $quiz->question,
                'answers' => $answers,
                'duration' => $quiz->duration,
                'score' => $quiz->score,
            ];
        }

        return $formattedQuiz;
    }

    public static function getSumScores($courseId)
    {
        return (int) Quiz::where('course_id', $courseId)->sum('score');
    }

}
