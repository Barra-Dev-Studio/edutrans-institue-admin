<?php

namespace App\Livewire\Pages\Quiz;

use App\Livewire\Plugin\CKEditorLivewire;
use App\Livewire\Plugin\TrixLivewire;
use App\Models\Quiz;
use App\Models\Section;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class QuizUpdateLivewire extends Component
{
    use WithFileUploads;

    public $id;
    public $courseId;
    public $question;
    public $answers;
    public $isCorrects;
    public $duration;
    public $score;
    public $status;

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

    public function mount()
    {
        $quiz = Quiz::where('id', $this->id)->first();
        $this->question = $quiz->question;
        $this->duration = $quiz->duration;
        $this->score = $quiz->score;
        $this->status = $quiz->status;
        $this->courseId = $quiz->course_id;

        $answers = json_decode($quiz->answers);
        foreach ($answers as $answer) {
            $this->answers[] = $answer->text;
            $this->isCorrects[] = $answer->is_correct;
        }
    }

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
            Quiz::where('id', $this->id)->update([
                'question' => $this->question,
                'duration' => $this->duration,
                'score' => $this->score,
                'answers' => $this->generateAnswer(),
                'status' => $this->status,
            ]);
            return redirect()->route('dashboard.quiz.index', $this->courseId)->with('success', 'Course quiz updated successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to update quiz');
        }
    }

    public function render()
    {
        return view('livewire.pages.quiz.quiz-update-livewire');
    }
}
