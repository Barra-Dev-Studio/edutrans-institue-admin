<?php

namespace App\Services;
use App\Models\Category;

class CategoryService
{
    public static function deleteCategoryById(string $id)
    {
        $category = Category::find($id);
        return $category->delete();
    }
}
