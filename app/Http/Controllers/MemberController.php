<?php

namespace App\Http\Controllers;

use App\Services\ChapterService;
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
        $sections = ChapterService::getByCourseId($course->id, true);

        return view('pages.member.play', compact('course', 'sections'));
    }
}
