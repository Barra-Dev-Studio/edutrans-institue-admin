<?php

namespace App\Livewire\Pages\Category;

use App\Models\Category;
use Livewire\Component;

class CategoryUpdateLivewire extends Component
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
        $category = Category::find($this->id);
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
            Category::where('id', $this->id)->update([
                'name' => $this->name,
                'description' => $this->description,
                'slug' => \Str::slug($this->name),
            ]);
            return redirect()->route('dashboard.category.index')->with('success', 'Category updated successfuly');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to update category');
        }
    }

    public function render()
    {
        return view('livewire.pages.category.category-update-livewire');
    }
}
