<?php

namespace App\Http\Controllers;

use App\Services\ChapterService;
use App\Services\CheckoutService;
use App\Services\CourseService;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    public function index()
    {
        return view('pages.member.index');
    }

    public function transaction()
    {
        $memberId = Auth()->user()->id;
        return view('pages.member.transaction', compact('memberId'));
    }

    public function play($slug)
    {
        // TODO: Check if course playable
        // If not return 404
        $course = CourseService::getBySlug($slug);
        if (!CheckoutService::checkIfUserOwnedTheCourse($course->id)) {
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
}
