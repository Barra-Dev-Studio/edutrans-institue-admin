<?php

namespace App\Livewire\Pages\Section;

use App\Livewire\Plugin\TrixLivewire;
use App\Models\Section;
use Livewire\Component;
use Livewire\WithFileUploads;

class SectionCreateLivewire extends Component
{
    use WithFileUploads;

    public $courseId;
    public $title;
    public $content;
    public $photo;

    protected $rules = [
        'courseId' => 'required',
        'title' => 'required',
        'content' => 'required',
        'photo' => ['image', 'max:1024']
    ];

    public $listeners = [
        TrixLivewire::EVENT_VALUE_UPDATED => 'updateFromTrix'
    ];

    public function updateFromTrix($value)
    {
        $this->content = $value;
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function submit()
    {
        $this->validate();
        try {
            $photo = ($this->photo) ? $this->photo->store('sections') : null;
            Section::create([
                'course_id' => $this->courseId,
                'title' => $this->title,
                'content' => $this->content,
                'photo' => $photo
            ]);
            return redirect()->route('dashboard.section.index', $this->courseId)->with('success', 'Course section created successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to add new course section');
        }
    }

    public function render()
    {
        return view('livewire.pages.section.section-create-livewire');
    }
}
