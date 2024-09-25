<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Subject;
use App\Models\Test;

class SubjectForm extends Component
{
    public $test_id;
    public $tests = [];
    public $subjects = [];
    public $isUpdating = false;

    protected $rules = [
        'test_id' => 'required|exists:tests,id',
        'subjects.*.id' => 'nullable|exists:subjects,id',
        'subjects.*.name' => 'required|string|max:255',
        'subjects.*.description' => 'nullable|string',
        'subjects.*.has_optional' => 'boolean',
        'subjects.*.number_of_questions' => 'required|integer|min:1',
        'subjects.*.number_optional_questions' => 'nullable|integer|min:0',
        'subjects.*.question_type' => 'required',
        'subjects.*.total_marks' => 'required'
    ];

    public function mount()
    {
        $this->tests = Test::all();
    }

    public function updatedTestId($testId)
    {
        $test = Test::find($testId);

        if ($test) {
            $existingSubjects = $test->subjects;

            if ($existingSubjects && $existingSubjects->count() > 0) {
                $this->subjects = $existingSubjects->map(function ($subject) {
                    return [
                        'id' => $subject->id,
                        'name' => $subject->name,
                        'description' => $subject->description,
                        'has_optional' => $subject->has_optional,
                        'number_of_questions' => $subject->number_of_questions,
                        'number_optional_questions' => $subject->number_optional_questions,
                        'question_type' => $subject->question_type,
                        'total_marks' => $subject->total_marks,
                    ];
                })->toArray();
                $this->isUpdating = true;
            } else {
                $numberOfSubjects = $test->number_of_subjects;
                $validTypes = ['multiple_choice', 'true_false', 'short_answer', 'essay'];
            
                $this->subjects = array_fill(0, $numberOfSubjects, [
                    'id' => null,
                    'name' => '',
                    'description' => '',
                    'has_optional' => false,
                    'number_of_questions' => 1,
                    'number_optional_questions' => 0,
                    'total_marks' => 0,
                    'question_type' => in_array($test->question_type, $validTypes) ? $test->question_type : '',
                ]);
                
                $this->isUpdating = false;
            }
            
        } else {
            $this->subjects = [];
            $this->isUpdating = false;
        }
    }

    public function store()
    {
        $validatedData = $this->validate();

        $test = Test::find($this->test_id);
        if (!$test) {
            $this->showToast('error', 'Test not found.');
            return;
        }

        $totalSubjectQuestions = array_sum(array_column($validatedData['subjects'], 'number_of_questions'));
        if ($totalSubjectQuestions !== $test->available_questions) {
            $this->showToast('error', 'The total number of questions for all subjects must equal the available questions in the test.');
            return;
        }
        $totalSubjectQuestions = array_sum(array_column($validatedData['subjects'], 'number_of_questions'));
        if ($totalSubjectQuestions !== $test->available_questions) {
            $this->showToast('error', 'The total number of questions for all subjects must equal the available questions in the test.');
            return;
        }

        $totalSubjectMarks = array_sum(array_column($validatedData['subjects'], 'total_marks'));
        if ($totalSubjectMarks !== $test->total_marks) {
            $this->showToast('error', 'The total number of marks for all subjects must equal the total marks in the test.');
            return;
        }

        $totalOptionalQuestions = array_sum(array_map(function ($subject) {
            return $subject['number_optional_questions'] ?? 0;
        }, $validatedData['subjects']));
        
        if ($totalOptionalQuestions !== $test->optional_questions) {
            $this->showToast('error', 'The total number of optional questions for all subjects must equal the optional questions in the test i.e.' . $test->optional_questions);
            return;
        }

        try {
            foreach ($validatedData['subjects'] as $subjectData) {
                if (isset($subjectData['id'])) {
                    Subject::where('id', $subjectData['id'])->update([
                        'name' => $subjectData['name'],
                        'description' => $subjectData['description'],
                        'has_optional' => $subjectData['has_optional'],
                        'number_of_questions' => $subjectData['number_of_questions'],
                        'number_optional_questions' => $subjectData['number_optional_questions'],
                        'question_type' => $subjectData['question_type'],
                        'total_marks' => $subjectData['total_marks'],
                    ]);
                } else {
                    Subject::create([
                        'test_id' => $this->test_id,
                        'name' => $subjectData['name'],
                        'description' => $subjectData['description'],
                        'has_optional' => $subjectData['has_optional'],
                        'number_of_questions' => $subjectData['number_of_questions'],
                        'number_optional_questions' => $subjectData['number_optional_questions'],
                        'question_type' => $subjectData['question_type'],
                        'total_marks' => $subjectData['total_marks'],
                    ]);
                }
            }

            $this->reset(['test_id', 'subjects']);
            $this->showToast('success', $this->isUpdating ? 'Subjects updated successfully.' : 'Subjects created successfully.');
        } catch (\Exception $e) {
            $this->showToast('error', 'An error occurred while saving the subjects. Please try again. Error: ' . $e->getMessage());
        }
        
    }

    private function showToast($icon, $title)
    {
        $this->dispatch('swal:toast', [
            'icon' => $icon,
            'title' => $title,
            'timer' => 3000,
            'position' => 'top-end',
        ]);
    }

    public function render()
    {
        return view('livewire.subject_form')->extends('layout.app');;
    }
}