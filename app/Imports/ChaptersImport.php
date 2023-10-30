<?php

namespace App\Imports;

use App\Models\Chapter;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ChaptersImport implements ToModel, WithHeadingRow
{
    public $courseId;

    public function __construct(string $courseId)
    {
        $this->courseId = $courseId;
    }

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Chapter([
            "title" => $row["chapter_title_please_add_number_sequence_like_1_2_etc"],
            "section" => $row["chapter_section_please_add_number_sequence_like_1_2_etc"],
            "description" => $row["description"],
            "playback_url" => $row["playbackurl"],
            "duration" => $row["duration_minutes"],
            "is_preview" => Str::lower($row["is_preview_type_yes_or_no"]) == "yes",
            "course_id" => $this->courseId
        ]);
    }
}
