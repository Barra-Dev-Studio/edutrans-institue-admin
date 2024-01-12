<?php

namespace App\Livewire\Pages\Member;

use App\Services\QuizProgressService;
use App\Services\QuizService;
use Livewire\Component;

class QuizPlayLivewire extends Component
{
    public $questions;
    public $ownedCourse;
    public $index = 0;
    public $timer = 0;
    public $selectedAnswer = null;

    public function mount()
    {
        $this->checkValidSession();
        $this->loadQuestions();
    }
    public function loadQuestions()
    {
        $this->questions = QuizService::getFormattedQuizByCourseId($this->ownedCourse->course_id);
        $this->timer = $this->questions[$this->index]['duration'];
    }

    public function nextQuestion()
    {
        $this->checkValidSession();

        if ($this->index + 1 < count($this->questions)) {
            $this->updateProgress();
            $this->index++;
            $this->selectedAnswer = null;
            return $this->timer = $this->questions[$this->index]['duration'];
        }
        return $this->submitProgress();
    }

    public function selectAnswer($index)
    {
        $this->selectedAnswer = $index;
    }

    public function countdown()
    {
        $this->timer--;
        if ($this->timer < 0) {
            $this->nextQuestion();
        }
    }

    public function updateProgress()
    {
        $progress = QuizProgressService::getByOwnedCourseId($this->ownedCourse->id);
        $histories = json_decode($progress->histories);
        $question = $this->questions[$this->index];
        $isPass = $this->isPass($question['answers']);
        $histories[] = [
            'id' => $question['id'],
            'text' => $question['question'],
            'answers' => $question['answers'],
            'selected_answer' => $this->selectedAnswer !== null ? $question['answers'][$this->selectedAnswer] : [],
            'is_pass' => $isPass,
            'score' => $isPass ? $question['score'] : 0
        ];
        QuizProgressService::updateProgressByOwnedCourseId($this->ownedCourse->id, $histories);
    }

    public function isPass($answers)
    {
        if ($this->selectedAnswer === null) {
            return false;
        }

        return $answers[$this->selectedAnswer]->is_correct;
    }

    public function submitProgress()
    {
        $this->updateProgress();
        QuizProgressService::recapProgess($this->ownedCourse->id);
        session()->pull('sessionKey');
        return redirect()->route('member.quiz.result', $this->ownedCourse->id);
    }

    public function checkValidSession()
    {
        $sessionKey = session('sessionKey');
        if (!session()->has('sessionKey') && !uuid_is_valid($sessionKey)) {
            session()->pull('sessionKey');
            return redirect()->route('member.quiz.pre', $this->ownedCourse->id);
        }
        return true;
    }


    public function render()
    {
        return view('livewire.pages.member.quiz-play-livewire');
    }
}
