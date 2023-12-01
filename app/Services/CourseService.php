<?php

namespace App\Services;
use App\Models\Chapter;
use App\Models\Course;
use App\Models\OwnedCourse;
use App\Models\TransactionDetail;

class CourseService
{
    public static function deleteCourseById(string $id)
    {
        $course = Course::find($id);
        return $course->delete();
    }

    public static function getById(string $id)
    {
        return Course::findOrFail($id);
    }

    public static function getBySlug(string $slug)
    {
        return Course::where('slug', $slug)->latest()->first();
    }

    public static function addCourseToUser($transactionId, $courseId, $userId)
    {
        $checkIfUserAlreadyPay = TransactionService::getById($transactionId);
        if ($checkIfUserAlreadyPay->status === 'SUCCEEDED') {
            $course = self::getById($courseId);
            $transactionDetail = TransactionDetail::where('transaction_id', $transactionId)->where('item_id', $courseId)->first();
            $ownedCourse = (object) [
                'member_id' => $userId,
                'course_id' => $course->id,
                'title' => $course->title,
                'mentor' => $course->mentor,
                'category' => $course->category,
                'transaction_detail_id' => $transactionDetail->id
            ];
            TransactionService::saveOwnedCourse($ownedCourse);
            return Course::where('id', $courseId)->increment('total_students');
        }
    }

    public static function getPopularCourse()
    {
        return Course::where('status', 'PUBLISHED')
            ->with('mentor')
            ->orderBy('total_students', 'desc')
            ->limit(3)
            ->get();
    }

    public static function syncTotalDuration($courseId)
    {
        $total = Chapter::where('course_id', $courseId)->sum('duration');
        return Course::where('id', $courseId)->update([
            'total_duration' => $total
        ]);
    }

    public static function syncTotalStudent($courseId)
    {
        $total = OwnedCourse::where('course_id', $courseId)->count();
        return Course::where('id', $courseId)->upate([
            'total_students' => $total
        ]);
    }
}
