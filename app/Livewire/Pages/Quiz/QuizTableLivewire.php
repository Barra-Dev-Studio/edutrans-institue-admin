<?php

namespace App\Livewire\Pages\Quiz;

use App\Models\Quiz;
use App\Traits\DatatableModalTrait;
use Livewire\Component;
use Livewire\WithPagination;

class QuizTableLivewire extends Component
{
    use WithPagination;
    use DatatableModalTrait;

    public $showPage = 5;
    public $search = '';
    public $courseId;

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function paginationView()
    {
        return 'vendor.livewire.tailwind';
    }

    public function render()
    {
        return view('livewire.pages.quiz.quiz-table-livewire', [
            'quizzes' => Quiz::where('course_id', $this->courseId)->where('question', 'like', '%' . $this->search . '%')->paginate($this->showPage)
        ]);
    }
}
