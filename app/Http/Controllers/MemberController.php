<?php

namespace App\Http\Controllers;

use App\Services\ChapterService;
use App\Services\CourseService;
use App\Services\OwnedCourseService;
use App\Services\TransactionService;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    public function index()
    {
        $lastChapter = OwnedCourseService::getLastChapterProgress();
        $ownedCourse = OwnedCourseService::count();
        return view('pages.member.index', compact('lastChapter', 'ownedCourse'));
    }

    public function transaction()
    {
        return view('pages.member.transaction.index');
    }

    public function play($id, $chapterId = null)
    {
        // Check if course playable
        // If not return 404
        $course = OwnedCourseService::getById($id);
        if (!TransactionService::checkIfUserOwnedTheCourse($course->course_id)) {
            return abort(404);
        }

        $sections = ChapterService::getByCourseId($course->course_id, true);
        $selectedChapter = ChapterService::getById($chapterId == null ? $course->chapterProgress->last_chapter_id : $chapterId);

        return view('pages.member.play', compact('course', 'sections', 'selectedChapter'));
    }

    public function checkout($slug)
    {
        // Check if course buyable and check another price
        // If not return 404
        $course = CourseService::getBySlug($slug);
        if ($course == null) {
            return abort(404);
        }

        $payments = [
            'Virtual Account (VA)' => 1904,
            'QRIS' => 0
        ];

        return view('pages.member.checkout', compact('course', 'payments'));
    }

    public function detailTransaction($id)
    {
        $transaction = TransactionService::getById($id);
        return view('pages.member.transaction.show', compact('transaction'));
    }
}
