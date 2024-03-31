<?php

namespace App\Livewire\Pages\User;

use App\Models\OwnedCourse;
use App\Models\Transaction;
use App\Traits\DatatableLivewire;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use Livewire\WithPagination;

class UserDetailCoursesLivewire extends Component
{
    use WithPagination, DatatableLivewire;
    public string|OwnedCourse $model = OwnedCourse::class;

    public mixed $id;

    public function mount(): void
    {
        $this->action = false;
        $this->columns = [
            'id' => ['type' => 'text', 'label' => 'No'],
            'created_at' => ['type' => 'text', 'label' => 'Date'],
            'title' => ['type' => 'text', 'label' => 'Product name'],
            'mentor' => ['type' => 'text', 'label' => 'Mentor'],
            'category' => ['type' => 'text', 'label' => 'Category'],
        ];
    }
    public function render(): View
    {
        $data = $this->getData(new ($this->model), ['member_id' => $this->id]);
        return view('livewire.pages.user.user-detail-courses-livewire', [
            'data' => $data
        ]);
    }
}
