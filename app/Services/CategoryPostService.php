<?php

namespace App\Services;
use App\Models\Category;
use App\Models\CategoryPost;

class CategoryPostService
{
    public static function deleteCategoryById(string $id)
    {
        $category = CategoryPost::find($id);
        return $category->delete();
    }
}
