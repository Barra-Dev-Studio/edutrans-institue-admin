<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Services\CategoryService;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("pages.category.index");
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("pages.category.create");
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return view("pages.category.show", compact("id"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view("pages.category.edit", compact("id"));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $isDeleted = CategoryService::deleteCategoryById($id);
        return $isDeleted
            ? redirect()->route('dashboard.category.index')->with('success', 'Category has been deleted')
            : redirect()->back()->with('error', 'Failed to delete category');
    }
}
