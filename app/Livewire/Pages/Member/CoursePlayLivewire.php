<?php

namespace App\Livewire\Pages\Member;

use App\Models\Chapter;
use App\Models\ChapterProgress;
use App\Models\OwnedCourse;
use Livewire\Component;

class CoursePlayLivewire extends Component
{
    public $course;
    public $sections;
    public $selectedChapter;

    public function setActiveChapter($activeChapter)
    {
        $this->activeChapter = $activeChapter;
        $this->getChapterDetail($activeChapter);
    }

    public function getChapterDetail($id)
    {
        $this->selectedChapter = Chapter::find($id);
    }

    public function checkIfCompleted($chapterId)
    {
        $completedChapter = json_decode($this->course->chapterProgress->chapters_completed);
        foreach($completedChapter as $chapter) {
            if ($chapter->id == $chapterId && $chapter->is_completed) {
                return true;
            }
        }
        return false;
    }

    public function setAsComplete()
    {
        $chapterProgress = $this->course->chapterProgress;
        $chapters = json_decode($chapterProgress->chapters_completed);
        for ($index = 0; $index < count($chapters); $index++) {
            if ($chapters[$index]->id === $this->selectedChapter->id) {
                $chapters[$index]->is_completed = true;
            }
        }

        ChapterProgress::where('id', $chapterProgress->id)->update([
            'chapters_completed' => json_encode($chapters),
            'last_chapter_id' => $this->selectedChapter->id
        ]);
        OwnedCourse::find($this->course->id)->touch();

        return redirect()->route('member.play', [$this->course->id, $this->selectedChapter->id])->with('success', 'Berhasil menyelesaikan chapter ' . $this->selectedChapter->title);
    }

    public function render()
    {
        return view('livewire.pages.member.course-play-livewire');
    }
}
