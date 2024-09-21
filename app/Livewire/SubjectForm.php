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
        'subjects.*.number_optional_questions' => 'nullable|integer|min:0'
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
            // Map existing subjects to the required format
            $this->subjects = $existingSubjects->map(function ($subject) {
                return [
                    'id' => $subject->id,
                    'name' => $subject->name,
                    'description' => $subject->description,
                    'has_optional' => $subject->has_optional,
                    'number_of_questions' => $subject->number_of_questions,
                    'number_optional_questions' => $subject->number_optional_questions,
                ];
            })->toArray();
            $this->isUpdating = true;
        } else {
            // Initialize with empty subjects if none exist
            $numberOfSubjects = $test->number_of_subjects;
            $this->subjects = array_fill(0, $numberOfSubjects, [
                'id' => null,
                'name' => '',
                'description' => '',
                'has_optional' => false,
                'number_of_questions' => 1,
                'number_optional_questions' => 0,
            ]);
            $this->isUpdating = false;
        }
    } else {
        // Reset subjects and updating status if test not found
        $this->subjects = [];
        $this->isUpdating = false;
    }
}


    public function store()
    {
        $validatedData = $this->validate();

        $test = Test::find($this->test_id);
        if (!$test) {
            session()->flash('error', 'Test not found.');
            return;
        }

        $totalSubjectQuestions = array_sum(array_column($validatedData['subjects'], 'number_of_questions'));
        if ($totalSubjectQuestions !== $test->available_questions) {
            session()->flash('message', 'The total number of questions for all subjects must equal the available questions in the test.');
            return;
        }

        $totalOptionalQuestions = array_sum(array_map(function ($subject) {
            return $subject['number_optional_questions'] ?? 0; // Default to 0 if null
        }, $validatedData['subjects']));
        
        if ($totalOptionalQuestions !== $test->optional_questions) {
            session()->flash('message', 'The total number of optional questions for all subjects must equal the optional questions in the test i.e.'.$test->optional_questions);
            return;
        }

        foreach ($validatedData['subjects'] as $subjectData) {
            if (isset($subjectData['id'])) {
                Subject::where('id', $subjectData['id'])->update([
                    'name' => $subjectData['name'],
                    'description' => $subjectData['description'],
                    'has_optional' => $subjectData['has_optional'],
                    'number_of_questions' => $subjectData['number_of_questions'],
                    'number_optional_questions' => $subjectData['number_optional_questions'],
                ]);
            } else {
                Subject::create([
                    'test_id' => $this->test_id,
                    'name' => $subjectData['name'],
                    'description' => $subjectData['description'],
                    'has_optional' => $subjectData['has_optional'],
                    'number_of_questions' => $subjectData['number_of_questions'],
                    'number_optional_questions' => $subjectData['number_optional_questions'],
                ]);
            }
        }

        $this->reset(['test_id', 'subjects']);
        session()->flash('message', $this->isUpdating ? 'Subjects updated successfully.' : 'Subjects created successfully.');
    }

    public function render()
    {
        return view('livewire.subject_form');
    }
}