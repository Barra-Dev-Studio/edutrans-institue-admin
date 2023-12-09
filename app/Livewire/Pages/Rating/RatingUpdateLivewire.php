<?php

namespace App\Livewire\Pages\Rating;

use App\Livewire\Plugin\TrixLivewire;
use App\Models\Rating;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;

class RatingUpdateLivewire extends Component
{
    use WithFileUploads;

    public $id;
    public $courseId;
    public $name;
    public $content;
    public $photo;
    public $currentPhoto;
    public $rate = 0;

    protected $rules = [
        'name' => 'required',
        'content' => 'required',
        'rate' => 'required',
        'photo' => ['image', 'max:1024', 'nullable']
    ];

    public function mount()
    {
        $rating = Rating::find($this->id);
        $this->name = $rating->name;
        $this->content = $rating->content;
        $this->currentPhoto = $rating->photo;
        $this->courseId = $rating->course_id;
        $this->rate = $rating->rate;
    }

    #[On('rate-updated')]
    public function updateRating($rating)
    {
        $this->rate = $rating;
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function submit()
    {
        $this->validate();
        try {
            $photo = $this->photo ? $this->photo->store('ratings') : $this->currentPhoto;
            $isUpdated = Rating::where('id', $this->id)->update([
                'name' => $this->name,
                'content' => $this->content,
                'photo' => $photo,
                'rate' => $this->rate
            ]);
            if (Storage::exists($this->currentPhoto) && $isUpdated && $this->photo) {
                Storage::delete($this->currentPhoto);
            }
            return redirect()->route('dashboard.rating.index', $this->courseId)->with('success', 'Rating updated successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to update rating');
        }
    }

    public function render()
    {
        return view('livewire.pages.rating.rating-update-livewire');
    }
}
