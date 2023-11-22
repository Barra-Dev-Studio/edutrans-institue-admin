<?php

namespace App\Services;

use App\Models\Post;

class PostService
{
    public static function getBySlug(string $slug)
    {
        return Post::where('slug', $slug)->first();
    }

    public static function getById(string $id)
    {
        return Post::findOrFail($id);
    }

    public static function deleteById(string $id)
    {
        return Post::where('id', $id)->delete();
    }

    public static function getAnotherPost(string $exceptionId)
    {
        return Post::whereNot('id', $exceptionId)->latest()->limit(5)->get();
    }

    public static function addViews(string $id)
    {
        return Post::where('id', $id)->increment('views');
    }
}
