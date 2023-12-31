<?php

namespace App\Http\Controllers;

use App\Services\CourseService;
use App\Services\OwnedCourseService;
use App\Services\QuizProgressService;
use Illuminate\Http\Request;

class QuizProgressController extends Controller
{
    public function index($ownedCourseId)
    {
        $ownedCourse = OwnedCourseService::getById($ownedCourseId);
        QuizProgressService::init($ownedCourse);
        return view('pages.member.quiz.index', compact('ownedCourse', ));
    }

    public function result($ownedCourseId)
    {
        $scores = 0;
        $correctAnswers = 0;
        $totalAnswers = 0;
        $quizProgress = QuizProgressService::getByOwnedCourseId($ownedCourseId);
        $ownedCourse = OwnedCourseService::getById($ownedCourseId);
        $histories = json_decode($quizProgress->histories);
        foreach ($histories as $history) {
            $scores += $history->score;
            $totalAnswers++;
            if ($history->is_pass) {
                $correctAnswers += 1;
            }
        }

        return view('pages.member.quiz.result', compact('scores', 'quizProgress', 'ownedCourse', 'correctAnswers', 'totalAnswers'));
    }

    public function pre($ownedCourseId)
    {
        $ownedCourse = OwnedCourseService::getById($ownedCourseId);
        return view('pages.member.quiz.pre', compact('ownedCourse', ));
    }
}
