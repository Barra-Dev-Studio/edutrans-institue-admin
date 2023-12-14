<?php

namespace App\Livewire\Pages\CategoryPost;

use App\Models\Category;
use App\Models\CategoryPost;
use Livewire\Component;

class CategoryPostUpdateLivewire extends Component
{
    public $id;
    public $name;
    public $description;

    protected $rules = [
        'name' => 'required',
        'description' => 'required'
    ];

    public function mount()
    {
        $category = CategoryPost::find($this->id);
        $this->name = $category->name;
        $this->description = $category->description;

    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function submit()
    {
        $this->validate();
        try {
            CategoryPost::where('id', $this->id)->update([
                'name' => $this->name,
                'description' => $this->description,
                'slug' => \Str::slug($this->name),
            ]);
            return redirect()->route('dashboard.categorypost.index')->with('success', 'Category updated successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to update category');
        }
    }

    public function render()
    {
        return view('livewire.pages.categorypost.categorypost-update-livewire');
    }
}
