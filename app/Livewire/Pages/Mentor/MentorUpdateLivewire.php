<?php

namespace App\Livewire\Pages\Mentor;

use App\Models\Mentor;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class MentorUpdateLivewire extends Component
{
    use WithFileUploads;

    public $id;
    public $name;
    public $speciality;
    public $bio;
    public $photo;
    public $currentPhoto;

    protected $rules = [
        'name' => 'required',
        'speciality' => 'required',
        'bio' => 'required',
        'photo' => ['image', 'max:1024', 'nullable']
    ];

    public function mount()
    {
        $mentor = Mentor::find($this->id);
        $this->name = $mentor->name;
        $this->speciality = $mentor->speciality;
        $this->bio = $mentor->bio;
        $this->currentPhoto = $mentor->photo;

    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function submit()
    {
        $this->validate();
        try {
            $photo = $this->photo ? $this->photo->store('photos', 'hosting') : $this->currentPhoto;
            $isUpdated = Mentor::where('id', $this->id)->update([
                'name' => $this->name,
                'speciality' => $this->speciality,
                'bio' => $this->bio,
                'photo' => $photo
            ]);
            if (Storage::disk('hosting')->exists($this->currentPhoto) && $isUpdated && $this->photo) {
                Storage::disk('hosting')->delete($this->currentPhoto);
            }
            return redirect()->route('dashboard.mentor.index')->with('success', 'Mentor updated successfuly');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to update mentor');
        }
    }

    public function render()
    {
        return view('livewire.pages.mentor.mentor-update-livewire');
    }
}
