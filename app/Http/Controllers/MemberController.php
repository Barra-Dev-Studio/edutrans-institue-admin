<?php

namespace App\Http\Controllers;

use App\Services\ChapterService;
use App\Services\CourseService;
use App\Services\TransactionService;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    public function index()
    {
        return view('pages.member.index');
    }

    public function transaction()
    {
        return view('pages.member.transaction.index');
    }

    public function play($slug)
    {
        // TODO: Check if course playable
        // If not return 404
        $course = CourseService::getBySlug($slug);
        if (!TransactionService::checkIfUserOwnedTheCourse($course->id)) {
            return abort(404);
        }

        $sections = ChapterService::getByCourseId($course->id, true);

        return view('pages.member.play', compact('course', 'sections'));
    }

    public function checkout($slug)
    {
        // TODO: Check if course buyable and check another price
        // If not return 404
        $course = CourseService::getBySlug($slug);
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
