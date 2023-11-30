<?php

namespace App\Http\Controllers;

use App\Services\ChapterService;
use App\Services\CourseService;
use Illuminate\Http\Request;

class GuestController extends Controller
{
    public function courseDetail($slug)
    {
        $course = CourseService::getBySlug($slug);
        $chapters = ChapterService::getByCourseId($course->id, true);
        $previews = ChapterService::getPreviews($course->id);
        return view("pages.course.detail", compact("course", "chapters", "previews"));
    }
}
