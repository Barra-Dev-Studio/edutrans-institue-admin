<?php

namespace App\Http\Controllers;

use App\Models\Section;
use App\Services\SectionService;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(string $courseId)
    {
        return view('pages.section.index', compact('courseId'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(string $courseId)
    {
        return view('pages.section.create', compact('courseId'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $section = SectionService::getById($id);
        return view('pages.section.show', compact('section'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('pages.section.edit', compact('id'));
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $section = SectionService::getById($id);
        $isDeleted = SectionService::deleteById($id);
        return $isDeleted
            ? redirect()->route('dashboard.section.index', $section->course_id)->with('success', 'Section has been deleted')
            : redirect()->back()->with('error', 'Failed to delete section');
    }
}
