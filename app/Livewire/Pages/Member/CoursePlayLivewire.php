<?php

namespace App\Livewire\Pages\Member;

use App\Models\Chapter;
use Livewire\Component;

class CoursePlayLivewire extends Component
{
    public $course;
    public $sections;
    public $activeChapter = null;
    public $selectedChapter;

    public function setActiveChapter($activeChapter)
    {
        $this->activeChapter = $activeChapter;
        $this->getChapterDetail($activeChapter);
    }

    public function getChapterDetail($id)
    {
        $this->selectedChapter = Chapter::find($id);
        $this->dispatch('player-updated', playback_url: $this->selectedChapter->playback_url);
    }

    public function render()
    {
        return view('livewire.pages.member.course-play-livewire');
    }
}
