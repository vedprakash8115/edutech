<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Test;
use App\Models\Question;
use App\Models\Result;
use App\Models\Subject;
use Illuminate\Support\Facades\Auth;

class MockTest extends Component
{
    public $tests;
    public $selectedTestId;
    public $test;
    public $subjects;
    public $selectedSubject;
    public $questions;
    public $currentQuestionIndex = 0;
    public $userAnswers = [];
    public $timeRemaining;
    public $testCompleted = false;
    public $questionsPerPage = 1;
    public $currentPage = 1;
    public $testStarted = false;

    public function mount()
    {
        $this->tests = Test::all();
    }

    public function updatedSelectedTestId()
    {
        $this->test = Test::findOrFail($this->selectedTestId);
        $this->subjects = $this->test->subjects;
        $this->selectedSubject = $this->subjects->first()->id;
        $this->loadQuestions();
        $this->timeRemaining = $this->test->duration * 60;
        $this->testStarted = true;
    }

    public function updatedSelectedSubject()
    {
        $this->loadQuestions();
        $this->currentQuestionIndex = 0;
        $this->currentPage = 1;
    }

    public function loadQuestions()
    {
        $this->questions = Question::where('test_id', $this->test->id)
            ->where('subject_id', $this->selectedSubject)
            ->with('options')
            ->get();
    }

    public function render()
    {
        return view('livewire.mock-test')->extends('layout.app');;
    }

    public function nextQuestion()
    {
        if ($this->currentQuestionIndex < $this->questions->count() - 1) {
            $this->currentQuestionIndex++;
            $this->currentPage = floor($this->currentQuestionIndex / $this->questionsPerPage) + 1;
        }
    }

    public function previousQuestion()
    {
        if ($this->currentQuestionIndex > 0) {
            $this->currentQuestionIndex--;
            $this->currentPage = floor($this->currentQuestionIndex / $this->questionsPerPage) + 1;
        }
    }

    public function saveAnswer($questionId, $answer)
    {
        $this->userAnswers[$questionId] = $answer;
    }

    public function submitTest()
    {
        $score = 0;
        $correctAnswers = 0;
        $incorrectAnswers = 0;
        $unattempted = 0;

        foreach ($this->questions as $question) {
            if (isset($this->userAnswers[$question->id])) {
                if ($question->question_type === 'multiple_choice' || $question->question_type === 'true_false') {
                    $correctOption = $question->options()->where('is_correct', true)->first();
                    if ($this->userAnswers[$question->id] == $correctOption->id) {
                        $score += $question->marks;
                        $correctAnswers++;
                    } else {
                        $incorrectAnswers++;
                    }
                } else {
                    // For short_answer and essay, we'll need manual grading
                    $unattempted++;
                }
            } else {
                $unattempted++;
            }
        }

        Result::create([
            'user_id' => Auth::id(),
            'test_id' => $this->test->id,
            'score' => $score,
            'total_questions' => $this->questions->count(),
            'correct_answers' => $correctAnswers,
            'incorrect_answers' => $incorrectAnswers,
            'unattempted' => $unattempted,
            'start_time' => now()->subSeconds($this->test->duration * 60 - $this->timeRemaining),
            'end_time' => now(),
        ]);

        $this->testCompleted = true;
    }

    public function getResult()
    {
        return Result::where('user_id', Auth::id())
            ->where('test_id', $this->test->id)
            ->latest()
            ->first();
    }
    public function goToPage($page)
    {
        $this->currentPage = $page;
        $this->currentQuestionIndex = ($page - 1) * $this->questionsPerPage;
    }

    public function getCurrentQuestion()
    {
        return $this->questions[$this->currentQuestionIndex] ?? null;
    }
}