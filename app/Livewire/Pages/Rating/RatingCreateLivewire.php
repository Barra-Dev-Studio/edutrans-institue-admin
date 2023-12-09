<?php

namespace App\Livewire\Pages\Rating;

use App\Livewire\Plugin\TrixLivewire;
use App\Models\Course;
use App\Models\Rating;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;

class RatingCreateLivewire extends Component
{
    use WithFileUploads;

    public $courseId;
    public $name;
    public $content;
    public $photo;
    public $rate = 0;

    protected $rules = [
        'name' => 'required',
        'content' => 'required',
        'rate' => 'required',
        'photo' => ['image', 'max:1024']
    ];

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
            $photo = ($this->photo) ? $this->photo->store('ratings') : null;
            Rating::create([
                'course_id' => $this->courseId,
                'name' => $this->name,
                'content' => $this->content,
                'photo' => $photo,
                'rate' => $this->rate
            ]);
            Course::where('id', $this->courseId)->increment('total_ratings');
            return redirect()->route('dashboard.rating.index', $this->courseId)->with('success', 'Rating created successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to add new rating');
        }
    }

    public function render()
    {
        return view('livewire.pages.rating.rating-create-livewire');
    }
}
