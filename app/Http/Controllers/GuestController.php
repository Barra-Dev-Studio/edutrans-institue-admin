<?php

namespace App\Http\Controllers;

use App\Services\ChapterService;
use App\Services\CourseService;
use App\Services\RatingService;
use App\Services\SectionService;
use Illuminate\Http\Request;

class GuestController extends Controller
{
    public function courseDetail($slug)
    {
        $course = CourseService::getBySlug($slug);
        if (!$course || $course->status !== 'PUBLISHED') {
            return abort(404);
        }

        $chapters = ChapterService::getByCourseId($course->id, true);
        $previews = ChapterService::getPreviews($course->id);
        $sections = SectionService::getByCourseId($course->id);
        $ratings = RatingService::getByCourseId($course->id);
        return view("pages.course.detail", compact("course", "chapters", "previews", "sections", 'ratings'));
    }
}
