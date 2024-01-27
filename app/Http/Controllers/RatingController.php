<?php

namespace App\Http\Controllers;

use App\Models\Rating;
use App\Services\OwnedCourseService;
use App\Services\RatingService;
use Illuminate\Http\Request;

class RatingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(string $courseId)
    {
        return view('pages.rating.index', compact('courseId'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(string $courseId)
    {
        return view('pages.rating.create', compact('courseId'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('pages.rating.edit', compact('id'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $rating = RatingService::getById($id);
        $isDeleted = RatingService::deleteById($id);
        if ($isDeleted) {
            RatingService::decrementByCourseId($rating->course_id);
        }
        return $isDeleted
            ? redirect()->route('dashboard.rating.index', $rating->course_id)->with('success', 'Rating has been deleted')
            : redirect()->back()->with('error', 'Failed to delete rating');
    }

    public function rate(string $ownedCourseId, string $redirectTo = null)
    {
        if (!OwnedCourseService::checkIfCompleteTheCourse($ownedCourseId)) {
            abort(404);
        }

        $ownedCourse = OwnedCourseService::getById($ownedCourseId);

        if (RatingService::checkIfUserRatedTheCourse($ownedCourse->course_id)) {
            return redirect()->route('member.index');
        }

        return view('pages.member.rating.index', compact('ownedCourse', 'redirectTo'));
    }
}
