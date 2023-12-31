<?php

namespace App\Http\Controllers;

use App\Services\CourseService;
use App\Services\PostService;
use Illuminate\Http\Request;
use Jorenvh\Share\ShareFacade as Share;

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
        $courses = CourseService::getPopularCourse();
        PostService::addViews($post->id);

        $shareComponent = Share::page(route('blog.show', $slug), $post->title)
            ->facebook()
            ->twitter()
            ->linkedin()
            ->whatsapp();

        return view('pages.blog.show', compact('post', 'anotherPosts', 'courses', 'shareComponent'));
    }
}
