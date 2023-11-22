<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Services\PostService;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pages.post.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.post.create');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $slug)
    {
        $post = PostService::getBySlug($slug);
        return view('pages.post.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('pages.post.edit', compact('id'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $isDeleted = PostService::deleteById($id);
        return $isDeleted
            ? redirect()->route('dashboard.post.index')->with('success', 'Post has been deleted')
            : redirect()->back()->with('error', 'Failed to delete post');
    }
}
