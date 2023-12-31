<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Services\QuizService;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($courseId)
    {
        return view('pages.quiz.index', compact('courseId'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($courseId)
    {
        return view('pages.quiz.create', compact('courseId'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('pages.quiz.edit', compact('id'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $quiz = QuizService::getById($id);
        $isDeleted = QuizService::deleteById($id);
        return $isDeleted
            ? redirect()->route('dashboard.quiz.index', $quiz->course_id)->with('success', 'Post has been deleted')
            : redirect()->back()->with('error', 'Failed to delete post');
    }
}
