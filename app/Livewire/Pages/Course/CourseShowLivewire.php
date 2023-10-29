<?php

namespace App\Livewire\Pages\Course;

use App\Models\Chapter;
use App\Traits\DatatableModalTrait;
use Livewire\Component;

class CourseShowLivewire extends Component
{
    use DatatableModalTrait;

    public $course;
    public $activeTab = 'information';
    public $sections = [];
    public $chapterId = null;
    public $state = 'create';

    public $title;
    public $section;
    public $description;
    public $playbackUrl;
    public $duration;
    public $isPreview = false;

    protected $rules = [
        'title' => 'required',
        'section' => 'required',
        'description' => 'required',
        'playbackUrl' => 'required',
        'duration' => 'required',
        'isPreview' => 'required'
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function mount()
    {
        $this->_fetchSection();
    }

    private function _fetchSection()
    {
        $chapters = Chapter::where('course_id', $this->course->id)->get();
        foreach($chapters as $chapter) {
            $this->sections[$chapter->section][] = $chapter;
        }
    }

    public function setActiveTab($activeTab)
    {
        $this->activeTab = $activeTab;
    }

    public function setIsPreview(bool $isPreview)
    {
        $this->isPreview = $isPreview;
    }

    public function updateChapter(string $chapterId)
    {
        $this->chapterId = $chapterId;
        $chapter = Chapter::find($this->chapterId);
        $this->title = $chapter->title;
        $this->description = $chapter->description;
        $this->section = $chapter->section;
        $this->playbackUrl = $chapter->playback_url;
        $this->duration = $chapter->duration;
        $this->isPreview = $chapter->is_preview;
        $this->state = 'update';
        $this->activeTab = 'managechapter';
    }

    public function submit()
    {
        $this->validate();
        try {
            if ($this->state === 'create') {
                Chapter::create([
                    'title' => $this->title,
                    'description' => $this->description,
                    'section' => $this->section,
                    'duration' => $this->duration,
                    'playback_url' => $this->playbackUrl,
                    'is_preview' => $this->isPreview,
                    'course_id' => $this->course->id,
                ]);
                return redirect()->route('dashboard.course.show', $this->course->id)->with('success', 'Chapter created successfuly');
            } else if ($this->state === 'update') {
                Chapter::where('id', $this->chapterId)->update([
                    'title' => $this->title,
                    'description' => $this->description,
                    'section' => $this->section,
                    'duration' => $this->duration,
                    'playback_url' => $this->playbackUrl,
                    'is_preview' => $this->isPreview,
                ]);
                return redirect()->route('dashboard.course.show', $this->course->id)->with('success', 'Chapter updated successfuly');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to add new chapter');
        }
    }

    public function refreshPage()
    {
        return redirect()->route('dashboard.course.show', $this->course->id);
    }

    public function render()
    {
        return view('livewire.pages.course.course-show-livewire');
    }
}
