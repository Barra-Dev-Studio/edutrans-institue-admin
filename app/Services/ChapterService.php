<?php

namespace App\Services;
use App\Models\Chapter;

class ChapterService
{
    public static function deleteChapterById(string $id)
    {
        $chapter = Chapter::find($id);
        return $chapter->delete();
    }

    public static function getById(string $id)
    {
        return Chapter::findOrFail($id);
    }
}
