<?php

namespace App\Livewire\Pages\Member;

use App\Models\Chapter;
use App\Models\ChapterProgress;
use App\Models\OwnedCourse;
use App\Models\Quiz;
use App\Services\QuizProgressService;
use Livewire\Component;
use Illuminate\Support\Arr;

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
        $this->checkIfChapterAddedToProgess();
        $chapterProgress = $this->course->chapterProgress;
        $chapters = json_decode($chapterProgress->chapters_completed);
        for ($index = 0; $index < count($chapters); $index++) {
            if ($chapters[$index]->id === $this->selectedChapter->id) {
                $chapters[$index]->is_completed = true;
            }
        }

        ChapterProgress::where('id', $chapterProgress->id)->update([
            'chapters_completed' => json_encode($chapters),
            'last_chapter_id' => $this->selectedChapter->id,
            'total_duration' => $chapterProgress->total_duration + $this->selectedChapter->duration
        ]);
        OwnedCourse::find($this->course->id)->touch();

        return redirect()
            ->route('member.play', [$this->course->id, $this->selectedChapter->id])
            ->with('success', 'Berhasil menyelesaikan chapter ' . ((preg_match('/^\d+\.\s(.+)$/', $this->selectedChapter->title, $matches)) ? $matches[1] : ''));
    }

    public function checkIfChapterAddedToProgess()
    {
        $chapterProgress = $this->course->chapterProgress;
        $chapters = json_decode($chapterProgress->chapters_completed);
        $selectedChapterId = $this->selectedChapter->id;
        $chapter = Arr::where($chapters, function ($value, $key) use ($selectedChapterId) {
            return $value->id === $selectedChapterId;
        });

        if (count($chapter) === 0) {
            $chapters[] = [
                'id' => $this->selectedChapter->id,
                'duration' => $this->selectedChapter->duration,
                'start' => 0,
                'watch' => 0,
                'is_completed' => false
            ];
            ChapterProgress::where('id', $chapterProgress->id)->update([
                'chapters_completed' => json_encode($chapters),
            ]);
            $this->course = OwnedCourse::where('course_id', $this->course->course_id)
                ->where('member_id', auth()->id())
                ->with('chapterProgress')->first();
        }

        return true;
    }

    public function checkIfCourseHasQuiz()
    {
        $check = Quiz::where('course_id', $this->course->course->id)->where('status', 'PUBLISHED')->first();
        return $check !== null;
    }

    public function checkIfUserHasCompletedTheQuiz()
    {
        $check = QuizProgressService::getByOwnedCourseId($this->course->id);
        if ($check === null) {
            return false;
        }
        return $check->is_done;
    }

    public function render()
    {
        return view('livewire.pages.member.course-play-livewire');
    }
}
