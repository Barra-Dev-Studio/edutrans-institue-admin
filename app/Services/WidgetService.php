<?php
namespace App\Services;

use App\Models\Course;
use App\Models\Post;
use App\Models\Transaction;
use App\Models\User;

class WidgetService
{
    public static function getTotalCourse()
    {
        $active = Course::where('status', 'PUBLISHED')->count();
        $total = Course::count();

        return [$active, $total];
    }

    public static function getTotalUser()
    {
        $active = User::whereNotNull('email_verified_at')->role('member')->count();
        $total = User::role('member')->count();

        return [$active, $total];
    }

    public static function getTotalPost()
    {
        $active = Post::where('status', 'PUBLISH')->count();
        $total = Post::count();

        return [$active, $total];
    }

    public static function getTotalTransaction()
    {
        $active = Transaction::where('status', 'SUCCEEDED')->count();
        $total = Transaction::count();

        return [$active, $total];
    }
}
