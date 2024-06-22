<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Services\BookService;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pages.book.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.book.create');
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        return view('pages.book.show', compact('book'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book)
    {
        return view('pages.book.edit', compact('book'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $isDeleted = BookService::deleteBookById($id);
        return $isDeleted
            ? redirect()->route('dashboard.book.index')->with('success', 'Book has been deleted')
            : redirect()->back()->with('error', 'Failed to delete book');
    }
}
