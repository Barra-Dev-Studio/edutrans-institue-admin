<?php

namespace App\Http\Controllers;

use App\Models\Mentor;
use App\Services\MentorService;
use Illuminate\Http\Request;

class MentorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("pages.mentor.index");
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("pages.mentor.create");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id, MentorService $mentorService)
    {
        $mentor = $mentorService::getById($id);
        return view("pages.mentor.show", compact("mentor"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view("pages.mentor.edit", compact("id"));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id, MentorService $mentorService)
    {
        $isDeleted = $mentorService::deleteMentorById($id);
        return $isDeleted
            ? redirect()->route('dashboard.mentor.index')->with('success', 'Mentor has been deleted')
            : redirect()->back()->with('error', 'Failed to delete mentor');
    }
}
