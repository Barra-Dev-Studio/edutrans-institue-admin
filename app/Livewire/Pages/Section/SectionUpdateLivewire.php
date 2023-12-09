<?php

namespace App\Livewire\Pages\Section;

use App\Livewire\Plugin\TrixLivewire;
use App\Models\Section;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class SectionUpdateLivewire extends Component
{
    use WithFileUploads;

    public $id;
    public $courseId;
    public $title;
    public $content;
    public $photo;
    public $currentPhoto;

    protected $rules = [
        'title' => 'required',
        'content' => 'required',
        'photo' => ['image', 'max:1024', 'nullable']
    ];

    public $listeners = [
        TrixLivewire::EVENT_VALUE_UPDATED => 'updateFromTrix'
    ];

    public function mount()
    {
        $courseSection = Section::find($this->id);
        $this->title = $courseSection->title;
        $this->content = $courseSection->content;
        $this->currentPhoto = $courseSection->photo;
        $this->courseId = $courseSection->course_id;
    }

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
            $photo = $this->photo ? $this->photo->store('sections') : $this->currentPhoto;
            $isUpdated = Section::where('id', $this->id)->update([
                'title' => $this->title,
                'content' => $this->content,
                'photo' => $photo
            ]);
            if (Storage::exists($this->currentPhoto) && $isUpdated && $this->photo) {
                Storage::delete($this->currentPhoto);
            }
            return redirect()->route('dashboard.section.index', $this->courseId)->with('success', 'Course Section updated successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to update course section');
        }
    }

    public function render()
    {
        return view('livewire.pages.section.section-update-livewire');
    }
}
