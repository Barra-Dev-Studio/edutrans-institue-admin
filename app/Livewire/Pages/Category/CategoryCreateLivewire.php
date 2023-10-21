<?php

namespace App\Livewire\Pages\Category;

use App\Models\Category;
use Livewire\Component;

class CategoryCreateLivewire extends Component
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
            Category::create([
                'name' => $this->name,
                'description' => $this->description,
                'slug' => \Str::slug($this->name),
            ]);
            return redirect()->route('dashboard.category.index')->with('success', 'Category created successfuly');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to add new category');
        }
    }

    public function render()
    {
        return view('livewire.pages.category.category-create-livewire');
    }
}
