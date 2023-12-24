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

    public static function getByCourseId(string $courseId, bool $format = false)
    {
        $chapters = Chapter::where('course_id', $courseId)->orderBy('section', 'ASC')->orderBy('title', 'ASC')->get();
        if (!$format) {
            return $chapters;
        }

        $sections = [];
        foreach ($chapters as $chapter) {
            $sections[(preg_match('/^\d+\.\s(.+)$/', $chapter->section, $matches)) ? $matches[1] : 'Section'][] = $chapter;
        }
        return $sections;
    }

    public static function getPreviews($courseId)
    {
        return Chapter::where('course_id', $courseId)
            ->where('is_preview', true)
            ->orderBy('section', 'ASC')
            ->orderBy('title', 'ASC')
            ->get(["id", "playback_url", "title"]);
    }
}
