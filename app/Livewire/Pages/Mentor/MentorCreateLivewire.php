<?php

namespace App\Livewire\Pages\Mentor;

use App\Livewire\Plugin\TrixLivewire;
use App\Models\Mentor;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;

class MentorCreateLivewire extends Component
{
    use WithFileUploads;

    public $name;
    public $speciality;
    public $bio;
    public $photo;

    protected $rules = [
        'name' => 'required',
        'speciality' => 'required',
        'bio' => 'required',
        'photo' => ['required', 'image', 'max:1024']
    ];

    public $listeners = [
        TrixLivewire::EVENT_VALUE_UPDATED => 'updateFromTrix'
    ];

    public function updateFromTrix($value)
    {
        $this->bio = $value;
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function submit()
    {
        $this->validate();
        try {
            $photo = $this->photo->store('photos');
            Mentor::create([
                'name' => $this->name,
                'speciality' => $this->speciality,
                'bio' => $this->bio,
                'photo' => $photo
            ]);
            return redirect()->route('dashboard.mentor.index')->with('success', 'Mentor created successfuly');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to add new mentor');
        }
    }

    public function render()
    {
        return view('livewire.pages.mentor.mentor-create-livewire');
    }
}
