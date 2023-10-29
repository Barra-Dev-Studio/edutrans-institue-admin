<?php

namespace App\Http\Controllers;

use App\Services\CourseService;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pages.course.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.course.create');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $course = CourseService::getById($id);
        return view('pages.course.show', compact('course'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('pages.course.edit', compact('id'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id, CourseService $courseService)
    {
        $isDeleted = $courseService::deleteCourseById($id);
        return $isDeleted
            ? redirect()->route('dashboard.course.index')->with('success', 'Course has been deleted')
            : redirect()->back()->with('error', 'Failed to delete course');
    }
}
