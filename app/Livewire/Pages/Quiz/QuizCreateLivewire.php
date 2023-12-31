<?php

namespace App\Livewire\Pages\Quiz;

use App\Livewire\Plugin\CKEditorLivewire;
use App\Models\Quiz;
use Livewire\Component;

class QuizCreateLivewire extends Component
{
    public $courseId;
    public $question;
    public $answers = [''];
    public $isCorrects = [0];
    public $duration;
    public $score;
    public $status = 'PUBLISHED';

    public $isCorrectValues = [
        ['id' => 0, 'name' => 'Incorrect'],
        ['id' => 1, 'name' => 'Correct'],
    ];

    public $statusValues = [
        ['id' => 'PUBLISHED', 'name' => 'PUBLISH'],
        ['id' => 'DRAFT', 'name' => 'DRAFT'],
    ];

    protected $rules = [
        'courseId' => 'required',
        'question' => 'required',
        'duration' => 'required',
        'score' => 'required',
        'status' => 'required'
    ];

    public $listeners = [
        CKEditorLivewire::EVENT_VALUE_UPDATED=> 'updateFromCKEditor'
    ];

    public function updateFromCKEditor($value)
    {
        $this->question = $value;
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function addAnswer()
    {
        $this->answers[] = [''];
        $this->isCorrects[] = 0;
    }

    public function removeAnswer($index)
    {
        unset($this->answers[$index]);
        unset($this->isCorrects[$index]);
        $this->answers = array_values($this->answers);
        $this->isCorrects = array_values($this->isCorrects);
    }

    public function generateAnswer()
    {
        $answers = [];
        for ($index = 0; $index < count($this->answers); $index++) {
            $answers[] = [
                'text' => $this->answers[$index],
                'is_correct' => $this->isCorrects[$index]
            ];
        }

        return json_encode($answers);
    }

    public function submit()
    {
        $this->validate();
        try {
            Quiz::create([
                'course_id' => $this->courseId,
                'question' => $this->question,
                'duration' => $this->duration,
                'score' => $this->score,
                'answers' => $this->generateAnswer(),
                'status' => $this->status,
            ]);
            return redirect()->route('dashboard.quiz.index', $this->courseId)->with('success', 'Course quiz created successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to add new course quiz');
        }
    }

    public function render()
    {
        return view('livewire.pages.quiz.quiz-create-livewire');
    }
}
