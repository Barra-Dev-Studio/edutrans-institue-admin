<?php

namespace App\Http\Controllers;

use App\Services\PostService;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        $blog = PostService::count();
        if (!$blog) {
            return abort(404);
        }
    
        return view('pages.blog.index');
    }

    public function show(string $slug)
    {
        $post = PostService::getBySlug($slug);

        if (!$post || $post->status !== 'PUBLISH') {
            return abort(404);
        }

        $anotherPosts = PostService::getAnotherPost($post->id);
        PostService::addViews($post->id);
        return view('pages.blog.show', compact('post', 'anotherPosts'));
    }
}
