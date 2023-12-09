<?php

namespace App\Livewire\Pages\Course;

use App\Livewire\Plugin\TrixLivewire;
use App\Models\Category;
use App\Models\Course;
use App\Models\Mentor;
use App\Services\CourseService;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;

class CourseCreateLivewire extends Component
{
    use WithFileUploads;

    // form
    public $thumbnail;
    public $title;
    public $slug;
    public $description;
    public $notes;
    public $category;
    public $price;
    public $discountPrice = 0;
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
        'thumbnail' => ['required', 'image', 'max:1024'],
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
        $this->categories = $this->_getCategories();
        $this->mentors = $this->_getMentors();
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
            $thumbnail = $this->thumbnail->store('thumbnails');
            $course = Course::create([
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
            return redirect()->route('dashboard.course.show', $course->id)->with('success', 'Course created successfuly');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to add new course');
        }
    }

    public function render()
    {
        return view('livewire.pages.course.course-create-livewire');
    }
}
