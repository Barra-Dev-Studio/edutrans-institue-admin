<?php

namespace App\Services;
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
            return OwnedCourse::updateOrCreate(
                [
                    'member_id' => $userId,
                    'course_id' => $courseId,
                    'transaction_detail_id' => $transactionDetail->id,
                ],
                [
                    'member_id' => $userId,
                    'course_id' => $courseId,
                    'transaction_detail_id' => $transactionDetail->id,
                    'mentor' => $course->mentor->name,
                    'category' => $course->category->name,
                    'title' => $course->title,
                ]
            );
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
}
