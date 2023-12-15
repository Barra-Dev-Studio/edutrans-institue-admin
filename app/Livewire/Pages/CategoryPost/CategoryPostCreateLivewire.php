<?php

namespace App\Livewire\Pages\CategoryPost;

use App\Models\Category;
use App\Models\CategoryPost;
use Livewire\Component;

class CategoryPostCreateLivewire extends Component
{
    public $name;
    public $description;

    protected $rules = [
        'name' => 'required',
        'description' => 'required'
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function submit()
    {
        $this->validate();
        try {
            CategoryPost::create([
                'name' => $this->name,
                'description' => $this->description,
                'slug' => \Str::slug($this->name),
            ]);
            return redirect()->route('dashboard.categorypost.index')->with('success', 'Category created successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to add new category');
        }
    }

    public function render()
    {
        return view('livewire.pages.category-post.category-post-create-livewire');
    }
}
