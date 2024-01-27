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
    public $photo = '';
    public $rate = 0;
    public $redirectTo = null;

    protected $rules = [
        'name' => 'required',
        'content' => 'required',
        'rate' => 'required',
    ];

    public function mount()
    {
        $this->name = auth()->user()->can('access-member') ? auth()->user()->name : '';
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
            Rating::create([
                'course_id' => $this->courseId,
                'name' => $this->name,
                'content' => $this->content,
                'photo' => $this->photo,
                'rate' => $this->rate,
                'member_id' => auth()->id()
            ]);
            Course::where('id', $this->courseId)->increment('total_ratings');
            if (auth()->user()->can('access-admin')) {
                return redirect()->route('dashboard.rating.index', $this->courseId)->with('success', 'Rating added successfully');
            } else {
                if ($this->redirectTo === 'certificate') {
                    return redirect()->route('member.certificate')->with('success', 'Rating added successfully. Thank you');
                }

                return redirect()->route('member.index');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to add new rating. Please try again');
        }
    }

    public function render()
    {
        return view('livewire.pages.rating.rating-create-livewire');
    }
}
