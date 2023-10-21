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
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id, CategoryService $categoryService)
    {
        $isDeleted = $categoryService::deleteCategoryById($id);
        return $isDeleted
            ? redirect()->route('dashboard.category.index')->with('success', 'Category has been deleted')
            : redirect()->back()->with('error', 'Failed to delete category');
    }
}
