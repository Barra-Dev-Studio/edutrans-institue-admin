<?php

namespace App\Services;

use App\Models\Book;

class BookService
{
public static function deleteBookById(string $id)
    {
        $course = Book::find($id);
        return $course->delete();
    }

    public static function getById(string $id)
    {
        return Book::findOrFail($id);
    }

    public static function getBySlug(string $slug)
    {
        return Book::where('slug', $slug)->latest()->first();
    }
}
