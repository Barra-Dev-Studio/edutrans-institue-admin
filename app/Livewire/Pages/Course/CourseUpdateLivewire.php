<?php

namespace App\Livewire\Pages\Course;

use App\Livewire\Plugin\TrixLivewire;
use App\Models\Category;
use App\Models\Course;
use App\Models\Mentor;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;

class CourseUpdateLivewire extends Component
{
    use WithFileUploads;
    public $id;
    public $currentThumbnail;

    // form
    public $thumbnail;
    public $title;
    public $slug;
    public $description;
    public $notes;
    public $category;
    public $price;
    public $discountPrice;
    public $mentor;
    public $totalViews = 0;
    public $totalShares = 0;
    public $totalStudents = 0;
    public $totalDuration = 0;
    public $totalRatings = 0;
    public $isCertified = false;
    public $status = "DRAFT";

    public $activeTab = 'thumbnail';
    public $categories = [];
    public $mentors = [];
    public $selectedCategory = null;
    public $selectedMentor = null;

    protected $rules = [
        'thumbnail' => ['nullable', 'image', 'max:1024'],
        'title' => ['required'],
        'slug' => ['required'],
        'description' => ['required'],
        'notes' => ['required'],
        'category' => ['required'],
        'price' => ['required'],
        'discountPrice' => ['required'],
        'mentor' => ['required'],
        'totalViews' => ['required'],
        'totalShares' => ['required'],
        'totalStudents' => ['required'],
        'totalDuration' => ['required'],
        'totalRatings' => ['required'],
        'isCertified' => ['required'],
        'status' => ['required'],
    ];

    public $listeners = [
        TrixLivewire::EVENT_VALUE_UPDATED => 'updateFromTrix'
    ];

    public function updateFromTrix($value)
    {
        $this->description = $value;
    }

    public function mount()
    {
        $course = Course::findOrFail($this->id);
        $this->categories = $this->_getCategories();
        $this->mentors = $this->_getMentors();

        $this->title = $course->title;
        $this->slug = $course->slug;
        $this->description = $course->description;
        $this->isCertified = $course->is_certified;
        $this->status = $course->status;
        $this->notes = $course->note;
        $this->price = $course->price;
        $this->discountPrice = $course->discount_price;
        $this->mentor = $course->mentor_id;
        $this->category = $course->category_id;
        $this->totalViews = $course->total_views;
        $this->totalShares = $course->total_shares;
        $this->totalDuration = $course->total_duration;
        $this->totalStudents = $course->total_students;
        $this->totalRatings = $course->total_ratings;
        $this->currentThumbnail = $course->thumbnail;

        $this->selectedCategory = Category::find($course->category_id);
        $this->selectedMentor = Mentor::find($course->mentor_id);
    }

    public function setSelectedCategory()
    {
        $this->selectedCategory = $this->category != '-1' ? Category::findOrFail($this->category) : null;
    }

    public function setSelectedMentor()
    {
        $this->selectedMentor = $this->mentor != '-1' ? Mentor::findOrFail($this->mentor) : null;
    }

    public function setCertified($isCertified)
    {
        $this->isCertified = $isCertified;
    }

    public function setStatus($status)
    {
        $this->status = $status;
    }

    public function updateSlug()
    {
        $this->slug = Str::slug($this->title);
    }

    private function _getCategories()
    {
        return Category::orderBy('name')->get();
    }

    private function _getMentors()
    {
        return Mentor::orderBy('name')->get();
    }

    public function setActiveTab($activeTab)
    {
        $this->activeTab = $activeTab;
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function submit()
    {
        $this->validate();
        try {
            $thumbnail = $this->thumbnail ? $this->thumbnail->store('thumbnails') : $this->currentThumbnail;
            $isUpdated = Course::find($this->id)->update([
                'title' => $this->title,
                'slug' => $this->slug,
                'description' => $this->description,
                'note' => $this->notes,
                'category_id' => $this->category,
                'mentor_id' => $this->mentor,
                'price' => $this->price,
                'discount_price' => $this->discountPrice,
                'total_views' => $this->totalViews,
                'total_shares' => $this->totalShares,
                'total_students' => $this->totalStudents,
                'total_duration' => $this->totalDuration,
                'total_ratings' => $this->totalRatings,
                'is_certified' => $this->isCertified,
                'status' => $this->status,
                'thumbnail' => $thumbnail
            ]);
            if ($this->thumbnail && Storage::exists($this->currentThumbnail) && $isUpdated) {
                Storage::delete($this->currentThumbnail);
            }
            return redirect()->route('dashboard.course.show', $this->id)->with('success', 'Course updated successfuly');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to update course');
        }
    }

    public function render()
    {
        return view('livewire.pages.course.course-update-livewire');
    }
}
