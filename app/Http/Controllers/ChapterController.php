<?php

namespace App\Http\Controllers;

use App\Services\ChapterService;
use Illuminate\Http\Request;

class ChapterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $chapter = ChapterService::getById($id);
        return view("pages.chapter.show", compact("chapter"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $isDeleted = ChapterService::deleteChapterById($id);
        return $isDeleted
            ? redirect()->back()->with('success', 'Course has been deleted')
            : redirect()->back()->with('error', 'Failed to delete course');
    }
}
