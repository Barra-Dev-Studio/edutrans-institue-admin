<?php

namespace App\Http\Controllers;

use App\Models\CategoryPost;
use App\Services\CategoryPostService;
use App\Services\CategoryService;
use Illuminate\Http\Request;

class CategoryPostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("pages.categorypost.index");
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("pages.categorypost.create");
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return view("pages.categorypost.show", compact("id"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view("pages.categorypost.edit", compact("id"));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $isDeleted = CategoryPostService::deleteCategoryById($id);
        return $isDeleted
            ? redirect()->route('dashboard.categorypost.index')->with('success', 'Category has been deleted')
            : redirect()->back()->with('error', 'Failed to delete category');
    }
}
