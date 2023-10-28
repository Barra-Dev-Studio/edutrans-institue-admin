<?php

namespace App\Services;
use App\Models\Mentor;

class MentorService
{
    public static function deleteMentorById(string $id)
    {
        $mentor = Mentor::where("id", $id)->first();
        return $mentor->delete();
    }

    public static function getById(string $id)
    {
        return Mentor::findOrFail($id);
    }
}
