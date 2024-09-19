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

    protected $rules = [
        'test_id' => 'required|exists:tests,id',
        'subjects.*.name' => 'required|string|max:255',
        'subjects.*.description' => 'nullable|string',
        'subjects.*.has_optional' => 'boolean',
        'subjects.*.number_of_questions' => 'required|integer|min:1',
    ];

    public function mount()
    {
        $this->tests = Test::all();
    }

    public function updatedTestId($testId)
    {
        $test = Test::find($testId);

        if ($test) {
            $numberOfSubjects = $test->number_of_subjects; // Adjust this as per your actual field

            // Initialize subjects array with empty subjects
            $this->subjects = array_fill(0, $numberOfSubjects, [
                'name' => '',
                'description' => '',
                'has_optional' => false,
                'number_of_questions' => 1,
            ]);
        } else {
            $this->subjects = [];
        }
    }

    public function store()
{
    // Validate the input data
    $validatedData = $this->validate();

    // Fetch the selected test
    $test = Test::find($this->test_id);
    if (!$test) {
        session()->flash('error', 'Test not found.');
        return;
    }

    // Calculate the total number of questions for the subjects being created
    $totalSubjectQuestions = array_sum(array_column($validatedData['subjects'], 'number_of_questions'));

    // Check if the sum of questions for all subjects is equal to the available questions in the test
    if ($totalSubjectQuestions !== $test->available_questions) {
        session()->flash('message', 'The total number of questions for all subjects must equal the available questions in the test.');
        return;
    }

    // Proceed with creating subjects if the conditions are met
    foreach ($validatedData['subjects'] as $subjectData) {
        Subject::create([
            'test_id' => $this->test_id,
            'name' => $subjectData['name'],
            'description' => $subjectData['description'],
            'has_optional' => $subjectData['has_optional'],
            'number_of_questions' => $subjectData['number_of_questions'],
        ]);
    }

    // Reset the form and flash success message
    $this->reset(['test_id', 'subjects']);
    session()->flash('message', 'Subjects created successfully.');
}


    public function render()
    {
        return view('livewire.subject_form');
    }
}
?>